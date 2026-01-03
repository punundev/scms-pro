<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EnrollmentRequest;
use App\Models\Enrollment;
use App\Models\CourseOffering;
use App\Models\User;
use App\Notifications\NewCourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class EnrollmentController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Enrollment';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Course Offering ID is required.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $query = Enrollment::query()
      ->with(['student:id,name', 'courseOffering.subject:id,name', 'fee'])
      ->where('course_offering_id', $courseOfferingId);

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('status', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q2) use ($search) {
            $q2->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('courseOffering.subject', function ($q3) use ($search) {
            $q3->where('name', 'like', "%{$search}%");
          });
      });
    }

    $enrollments = $query->orderBy('created_at', 'desc')->get();

    return view('admin.enrollments.index', compact('enrollments', 'courseOffering'));
  }


  public function create(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if (! $courseOfferingId) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Course Offering ID is required.');
    }

    $courseOffering = CourseOffering::with('subject:id,name')->findOrFail($courseOfferingId);

    $enrolledStudentIds = Enrollment::where('course_offering_id', $courseOfferingId)
      ->pluck('student_id');

    $students = User::role('student')
      ->whereNotIn('id', $enrolledStudentIds)
      ->orderBy('name')
      ->get(['id', 'name']);

    if ($students->isEmpty()) {
      return redirect()->route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId])
        ->with('error', 'All students are already enrolled in this course.');
    }

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.enrollments.create', compact(
      'students',
      'courseOffering',
      'statuses',
      'paymentStatuses',
      'courseOfferingId'
    ));
  }

  public function store(EnrollmentRequest $request)
  {
    $data = $request->validated();

    $exists = Enrollment::where('student_id', $data['student_id'])
      ->where('course_offering_id', $data['course_offering_id'])
      ->exists();

    if ($exists) {
      return back()
        ->with('error', 'This student is already enrolled in this course offering.')
        ->withInput();
    }

    DB::beginTransaction();

    try {
      $enrollment = Enrollment::create([
        'student_id'        => $data['student_id'],
        'course_offering_id' => $data['course_offering_id'],
        'status'            => $data['status'] ?? 'active',
        'remarks'           => $data['remarks'] ?? null,
      ]);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new NewCourseEnrollment($enrollment));

      $type_id = $enrollment->fee->feeType->id;

      DB::commit();

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $type_id])
        ->with('success', 'Enrollment & fee created successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error creating enrollment: ' . $e->getMessage());

      return back()->with('error', 'Error creating enrollment.' . $e->getMessage())->withInput();
    }
  }


  public function edit($student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $student = User::select('id', 'name')->findOrFail($student_id);

    $courseOffering = CourseOffering::with('subject:id,name')
      ->findOrFail($course_offering_id);

    $statuses = ['studying', 'suspended', 'dropped', 'completed'];
    $paymentStatuses = ['pending', 'paid', 'overdue', 'free'];

    return view('admin.enrollments.edit', compact(
      'enrollment',
      'student',
      'courseOffering',
      'statuses',
      'paymentStatuses'
    ));
  }

  // public function update(EnrollmentRequest $request, $student_id, $course_offering_id)
  // {
  //   $enrollment = Enrollment::where('student_id', $student_id)
  //     ->where('course_offering_id', $course_offering_id)
  //     ->firstOrFail();

  //   $safe = collect($request->validated())->except(['student_id', 'course_offering_id'])->toArray();

  //   try {
  //     $enrollment->update($safe);

  //     return redirect()->route('admin.enrollments.index', ['course_offering_id' => $course_offering_id])
  //       ->with('success', 'Enrollment updated successfully');
  //   } catch (\Exception $e) {
  //     dd('Error updating Enrollment: ' . $e->getMessage());
  //     return redirect()->back()->with('error', 'Error updating enrollment.')->withInput();
  //   }
  // }

  public function update(EnrollmentRequest $request, $student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    // Only update fields allowed
    $safe = collect($request->validated())
      ->except(['student_id', 'course_offering_id'])
      ->toArray();

    try {
      $enrollment->update($safe);

      return redirect()->route('admin.enrollments.index', [
        'course_offering_id' => $course_offering_id
      ])->with('success', 'Enrollment updated successfully.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error updating enrollment: ' . $e->getMessage())
        ->withInput();
    }
  }

  public function destroy($student_id, $course_offering_id)
  {
    $enrollment = Enrollment::where('student_id', $student_id)
      ->where('course_offering_id', $course_offering_id)
      ->firstOrFail();

    $courseOfferingId = $enrollment->course_offering_id;

    try {
      $enrollment->delete();

      return redirect()->route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId])
        ->with('success', 'Enrollment deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Enrollment: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting enrollment.');
    }
  }
}
