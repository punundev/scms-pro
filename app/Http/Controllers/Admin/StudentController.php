<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests\StudentRequest;
use App\Models\CourseOffering;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Enrollment;
use App\Models\User;
use App\Notifications\NewCourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class StudentController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Student';
  }

  // public function index(Request $request)
  // {
  //   $studentRole = Role::where('name', 'student')->first();

  //   if (!$studentRole) {
  //     $students = User::where('id', 0);
  //     return view('admin.students.index', ['students' => $students->paginate(6)]);
  //   }

  //   $query = User::role('student')
  //     ->orderBy('created_at', 'desc')
  //     ->withCount(['fees', 'attendances', 'courseOfferings']);

  //   if ($search = $request->input('search')) {
  //     $query->where(function ($q) use ($search) {
  //       $q->where('name', 'like', '%' . $search . '%')
  //         ->orWhere('email', 'like', '%' . $search . '%');
  //     });
  //   }

  //   $students = $query->paginate(6);

  //   return view('admin.students.index', compact('students'));
  // }


  public function index(Request $request)
  {
    $user = Auth::user();

    $query = User::role('student')
      ->withCount(['fees', 'attendances', 'courseOfferings'])
      ->orderBy('created_at', 'desc');

    if ($user->hasRole('teacher')) {
      $courseIds = $user->teachingCourses()->pluck('id')->toArray();

      $studentIds = \App\Models\Enrollment::whereIn('course_offering_id', $courseIds)
        ->pluck('student_id')
        ->unique()
        ->toArray();

      $query->whereIn('id', $studentIds);
    }

    if ($search = $request->input('search')) {
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    $students = $query->paginate(6);

    return view('admin.students.index', compact('students'));
  }

  public function feesIndex(User $student)
  {
    $fees = $student->fees()
      ->with(['feeType', 'creator'])
      ->latest()
      ->paginate(15);

    return view('admin.students.fees.index', compact('student', 'fees'));
  }

  public function coursesIndex(User $student)
  {
    $enrollments = $student->enrollments()
      ->with([
        'courseOffering' => function ($query) {
          $query->with(['subject', 'teacher', 'classroom']);
        }
      ])
      ->paginate(15);

    return view('admin.students.enrollments.index', compact('student', 'enrollments'));
  }

  public function create()
  {
    return view('admin.students.create');
  }

  public function createFee(User $student)
  {
    $feeTypes = FeeType::all();

    return view('admin.students.fees.create', compact('student', 'feeTypes'));
  }

  public function createEnrollment(User $student)
  {
    $enrolledIds = $student->courseOfferings()->pluck('course_offering_id');

    $availableCourses = CourseOffering::with(['subject:id,name', 'teacher:id,name'])
      ->whereNotIn('id', $enrolledIds)
      ->orderBy('created_at', 'desc')
      ->get();

    if ($availableCourses->isEmpty()) {
      return redirect()->route('admin.students.enrollments.index', $student->id)
        ->with('error', 'This student is already enrolled in all available courses.');
    }

    return view('admin.students.enrollments.create', compact('student', 'availableCourses'));
  }

  public function store(StudentRequest $request)
  {
    DB::beginTransaction();
    try {
      $data = $request->validated();
      $defaultPassword = 'password';

      $avatarPath = public_path('uploads/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      $data['avatar'] = null;
      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'uploads/avatars/' . $avatarName;
      }

      $student = User::create(array_merge($data, [
        'password' => bcrypt($defaultPassword),
        'avatar' => $data['avatar'],
      ]));

      $student->assignRole('student');

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student created successfully. Default password is: ' . $defaultPassword);
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error creating student: ' . $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Failed to create student: ' . $e->getMessage());
    }
  }

  public function storeEnrollment(EnrollmentRequest $request, User $student)
  {
    $data = $request->validated();
    $data['student_id'] = $student->id;

    $data['status'] = 'studying';

    if ($data['payment_status'] === 'waived') {
      $data['payment_status'] = 'free';
    }

    $exists = Enrollment::where('student_id', $student->id)
      ->where('course_offering_id', $data['course_offering_id'])
      ->exists();

    if ($exists) {
      return back()
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    try {
      $enrollment = Enrollment::create($data);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new NewCourseEnrollment($enrollment));

      return redirect()
        ->route('admin.students.enrollments.index', $student)
        ->with('success', 'Enrollment created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Enrollment: ' . $e->getMessage());

      return back()
        ->with('error', 'Error creating enrollment.' . $e->getMessage())
        ->withInput();
    }
  }

  public function storeFee(Request $request, User $student)
  {
    $validated = $request->validate([
      'fee_type_id' => 'required|exists:fee_types,id',
      'amount' => 'required|numeric|min:0.01',
      'due_date' => 'required|date',
      'status' => 'required|in:Draft,Due,Partial,Paid',
      'description' => 'nullable|string|max:255',
    ]);

    try {
      Fee::create([
        'student_id' => $student->id,
        'fee_type_id' => $validated['fee_type_id'],
        'amount' => $validated['amount'],
        'due_date' => $validated['due_date'],
        'status' => $validated['status'],
        'description' => $validated['description'],
        'created_by_id' => Auth::id(),
      ]);

      return redirect()->route('admin.students.fees.index', $student)
        ->with('success', 'New fee record successfully created.');
    } catch (\Exception $e) {
      return back()->withInput()->withErrors(['fee_creation' => 'Failed to create fee record. ' . $e->getMessage()]);
    }
  }

  public function show(User $student)
  {

    $student->loadCount(['fees', 'attendances', 'scores'])
      ->load([
        'courseOfferings' => function ($query) {
          $query->with(['subject', 'teacher']);
        },
        'fees.feeType',
        'scores.exam.courseOffering.subject',
        'attendances.courseOffering.subject',
      ]);

    return view('admin.students.show', compact('student'));
  }

  public function edit(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    return view('admin.students.edit', compact('student'));
  }

  public function update(StudentRequest $request, User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    DB::beginTransaction();
    try {
      $data = $request->validated();

      if ($request->hasFile('avatar')) {
        if ($student->avatar && file_exists(public_path($student->avatar))) {
          unlink(public_path($student->avatar));
        }

        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();
        $avatarPath = public_path('uploads/avatars');

        if (!file_exists($avatarPath)) {
          mkdir($avatarPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'uploads/avatars/' . $avatarName;
      } elseif ($request->input('clear_avatar')) {
        if ($student->avatar && file_exists(public_path($student->avatar))) {
          unlink(public_path($student->avatar));
        }
        $data['avatar'] = null;
      } else {

        unset($data['avatar']);
      }

      if (isset($data['password']) && !empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
      } else {
        unset($data['password']);
      }

      $student->update($data);

      DB::commit();
      return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error updating student: ' . $e->getMessage());
      return redirect()->back()->withInput()->with('error', 'Failed to update student: ' . $e->getMessage());
    }
  }

  public function destroy(User $student)
  {
    if (!$student->hasRole('student')) {
      return redirect()->route('admin.students.index')->with('error', 'User is not a student.');
    }

    if ($student->avatar && file_exists(public_path($student->avatar))) {
      unlink(public_path($student->avatar));
    }

    $student->delete();

    return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
  }
}
