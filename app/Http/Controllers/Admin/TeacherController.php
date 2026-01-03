<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class TeacherController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Teacher';
  }
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);
    $viewType = $request->input('view', 'table');
    $teachers = User::role('teacher')

      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('qualification', 'like', "%{$search}%")
          ->orWhere('specialization', 'like', "%{$search}%")
          ->orWhere('joining_date', 'like', "%{$search}%")
          ->orWhere('salary', 'like', "%{$search}%")
          ->orWhere('phone', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
        'view' => $viewType
      ]);

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.teachers.partials.table', compact('teachers'))->render(),
        'cards' => view('admin.teachers.partials.cardlist', compact('teachers'))->render(),
        'pagination' => $teachers->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html,
        'view' => $viewType
      ]);
    }

    return view('admin.teachers.index', compact('teachers'));
  }

  public function store(StoreTeacherRequest $request)
  {
    try {
      Log::info('Store Teacher Request Data:', $request->all());

      $validated = $request->validated();
      Log::info('Validated Data:', $validated);

      $category = ExpenseCategory::firstOrCreate(
        ['name' => 'Payroll'],
        ['description' => 'Automatically generated fee category for payroll teachers.']
      );

      // Handle photo upload
      $teacherPhotoPath = public_path('uploads/teacher');
      if (!file_exists($teacherPhotoPath)) {
        mkdir($teacherPhotoPath, 0755, true);
      }

      if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $photoName = time() . '-' . date('d-m-Y') . '_add_' . $avatar->getClientOriginalName();
        $avatar->move($teacherPhotoPath, $photoName);
        $validated['avatar'] = 'uploads/teacher/' . $photoName;
      }
      // Handle CV upload
      $cvPath = public_path('uploads/cv');
      if (!file_exists($cvPath)) {
        mkdir($cvPath, 0755, true);
      }

      if ($request->hasFile('cv')) {
        $cv = $request->file('cv');
        $cvName = time() . '-' . date('d-m-Y') . '_add_' . $cv->getClientOriginalName();
        $cv->move($cvPath, $cvName);
        $validated['cv'] = 'uploads/cv/' . $cvName;
      }

      // Set default password if not provided
      if (!isset($validated['password']) || empty($validated['password'])) {
        $validated['password'] = 'password'; // Default password
      }
      $validated['password'] = Hash::make($validated['password']);

      // Create user
      $teacher = User::create($validated);
      $teacher->assignRole('teacher');

      return response()->json([
        'success' => true,
        'message' => 'Teacher created successfully 🎅!',
        'teacher' => $teacher
      ]);
    } catch (\Exception $e) {
      Log::error('Teacher Store Error: ' . $e->getMessage());
      Log::error('Stack Trace: ' . $e->getTraceAsString());

      return response()->json([
        'success' => false,
        'message' => 'Error creating teacher: ' . $e->getMessage()
      ], 500);
    }
  }

  public function show(User $teacher)
  {
    // Ensure we're only showing teachers
    if (!$teacher->hasRole('teacher')) {
      return response()->json([
        'success' => false,
        'message' => 'User is not a teacher'
      ], 404);
    }
    return response()->json([
      'success' => true,
      'teacher' => $teacher
    ]);
  }

  public function update(UpdateTeacherRequest $request, User $teacher)
  {
    try {
      // Ensure we're only updating teachers
      if (!$teacher->hasRole('teacher')) {
        return response()->json([
          'success' => false,
          'message' => 'User is not a teacher'
        ], 404);
      }

      $data = $request->validated();

      // Handle photo upload
      if ($request->hasFile('avatar')) {
        // Delete old photo if exists
        if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
          unlink(public_path($teacher->avatar));
        }

        $avatar = $request->file('avatar');
        $photoName = time() . '-' . date('d-m-Y') . '_ed_' . $avatar->getClientOriginalName();
        $photoPath = public_path('uploads/teacher');
        $avatar->move($photoPath, $photoName);
        $data['avatar'] = 'uploads/teacher/' . $photoName;
      }

      // Handle CV upload
      if ($request->hasFile('cv')) {
        // Delete old CV if exists
        if ($teacher->cv && file_exists(public_path($teacher->cv))) {
          unlink(public_path($teacher->cv));
        }
        $cv = $request->file('cv');
        $cvName = time() . '-' . date('d-m-Y') . '_ed_' . $cv->getClientOriginalName();
        $cvPath = public_path('uploads/cv');
        $cv->move($cvPath, $cvName);
        $data['cv'] = 'uploads/cv/' . $cvName;
      }

      // Update password if provided
      if (isset($data['password']) && !empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
      } else {
        unset($data['password']);
      }

      $teacher->update($data);

      return response()->json([
        'success' => true,
        'message' => 'Teacher updated successfully 🎅',
        'teacher' => $teacher
      ]);
    } catch (\Exception $e) {
      Log::error('Teacher Update Error: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error updating teacher: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy(User $teacher)
  {
    try {
      // Ensure we're only deleting teachers
      if (!$teacher->hasRole('teacher')) {
        return response()->json([
          'success' => false,
          'message' => 'User is not a teacher'
        ], 404);
      }

      // Delete associated files
      if ($teacher->avatar) {
        $photoPath = public_path($teacher->avatar);
        if (file_exists($photoPath)) {
          unlink($photoPath);
        }
      }
      if ($teacher->cv) {
        $cvPath = public_path($teacher->cv);
        if (file_exists($cvPath)) {
          unlink($cvPath);
        }
      }

      $teacher->delete();

      return response()->json([
        'success' => true,
        'message' => 'Teacher deleted successfully'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error deleting teacher: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No teachers selected'
      ], 400);
    }

    try {
      $teachers = User::role('teacher')->whereIn('id', $ids)->get();

      foreach ($teachers as $teacher) {
        // Delete associated files
        if ($teacher->avatar) {
          $photoPath = public_path($teacher->avatar);
          if (file_exists($photoPath)) {
            unlink($photoPath);
          }
        }
        if ($teacher->cv) {
          $cvPath = public_path($teacher->cv);
          if (file_exists($cvPath)) {
            unlink($cvPath);
          }
        }
        $teacher->delete();
      }

      return response()->json([
        'success' => true,
        'message' => count($teachers) . ' teachers deleted successfully'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error deleting teachers: ' . $e->getMessage()
      ], 500);
    }
  }

  public function getBulkData(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No teachers selected'
      ], 400);
    }

    if (count($ids) > 5) {
      return response()->json([
        'success' => false,
        'message' => 'You can only edit up to 5 teachers at a time'
      ], 400);
    }

    try {
      $teachers = User::role('teacher')->whereIn('id', $ids)->get();
      return response()->json([
        'success' => true,
        'data' => $teachers
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error fetching teachers: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkUpdate(Request $request)
  {
    $request->validate([
      'teachers' => 'required|array',
      'teachers.*.id' => 'required|exists:users,id',
    ]);

    $updatedCount = 0;

    foreach ($request->input('teachers') as $teacherData) {
      $validator = Validator::make($teacherData, [
        'id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $teacherData['id'],
        'gender' => 'required|in:male,female',
        'date_of_birth' => 'required|date',
        'joining_date' => 'required|date',
        'qualification' => 'required|string|max:255',
        'experience' => 'nullable|string',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'specialization' => 'nullable|string',
        'salary' => 'nullable|numeric|min:0',
        'blood_group' => 'nullable|string|max:10',
        'nationality' => 'nullable|string|max:255',
        'religion' => 'nullable|string|max:255',
      ]);

      if ($validator->fails()) {
        Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
        continue;
      }

      try {
        $teacher = User::findOrFail($teacherData['id']);
        // Ensure we're only updating teachers
        if ($teacher->hasRole('teacher')) {
          $teacher->update($validator->validated());
          $updatedCount++;
        }
      } catch (\Exception $e) {
        Log::error("Error updating teacher: " . $e->getMessage());
      }
    }

    return response()->json([
      'success' => true,
      'message' => "Successfully updated $updatedCount teachers",
      'redirect' => route('admin.teachers.index')
    ]);
  }
}
