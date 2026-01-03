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
use Illuminate\Support\Facades\DB;

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

    $teachers = User::role('teacher')
      ->when($search, function ($query) use ($search) {
        return $query->where(function ($q) use ($search) {
          $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('specialization', 'like', "%{$search}%");
        });
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends(['search' => $search, 'per_page' => $perPage]);

    return view('admin.teachers.index', compact('teachers'));
  }

  public function create()
  {
    return view('admin.teachers.create');
  }

  public function store(StoreTeacherRequest $request)
  {
    DB::beginTransaction();
    try {
      $validated = $request->validated();

      ExpenseCategory::firstOrCreate(
        ['name' => 'Payroll'],
        ['description' => 'Automatically generated fee category for payroll teachers.']
      );

      if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $photoName = time() . '_at_' . $avatar->getClientOriginalName();
        $avatar->move(public_path('uploads/teacher'), $photoName);
        $validated['avatar'] = 'uploads/teacher/' . $photoName;
      }

      if ($request->hasFile('cv')) {
        $cv = $request->file('cv');
        $cvName = time() . '_cv_' . $cv->getClientOriginalName();
        $cv->move(public_path('uploads/cv'), $cvName);
        $validated['cv'] = 'uploads/cv/' . $cvName;
      }

      $validated['password'] = Hash::make($request->input('password', 'password'));

      $teacher = User::create($validated);
      $teacher->assignRole('teacher');

      DB::commit();
      return redirect()->route('admin.teachers.index')
        ->with('success', 'Teacher created successfully 🎅!');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Teacher Store Error: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error creating teacher: ' . $e->getMessage());
    }
  }

  public function show(User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      abort(404);
    }
    return view('admin.teachers.show', compact('teacher'));
  }

  public function edit(User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      abort(404);
    }
    return view('admin.teachers.edit', compact('teacher'));
  }

  public function update(UpdateTeacherRequest $request, User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      return redirect()->route('admin.teachers.index')->with('error', 'User is not a teacher');
    }

    DB::beginTransaction();
    try {
      $data = $request->validated();

      if ($request->hasFile('avatar')) {
        if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
          unlink(public_path($teacher->avatar));
        }
        $avatar = $request->file('avatar');
        $photoName = time() . '_ed_' . $avatar->getClientOriginalName();
        $avatar->move(public_path('uploads/teacher'), $photoName);
        $data['avatar'] = 'uploads/teacher/' . $photoName;
      }

      if ($request->hasFile('cv')) {
        if ($teacher->cv && file_exists(public_path($teacher->cv))) {
          unlink(public_path($teacher->cv));
        }
        $cv = $request->file('cv');
        $cvName = time() . '_ed_cv_' . $cv->getClientOriginalName();
        $cv->move(public_path('uploads/cv'), $cvName);
        $data['cv'] = 'uploads/cv/' . $cvName;
      }

      if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
      } else {
        unset($data['password']);
      }

      $teacher->update($data);

      DB::commit();
      return redirect()->route('admin.teachers.index')
        ->with('success', 'Teacher updated successfully 🎅');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Teacher Update Error: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error updating teacher');
    }
  }

  public function destroy(User $teacher)
  {
    if (!$teacher->hasRole('teacher')) {
      return back()->with('error', 'User is not a teacher');
    }

    if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
      unlink(public_path($teacher->avatar));
    }

    if ($teacher->cv && file_exists(public_path($teacher->cv))) {
      unlink(public_path($teacher->cv));
    }

    $teacher->delete();

    return redirect()->route('admin.teachers.index')
      ->with('success', 'Teacher deleted successfully');
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->input('ids');
    if (empty($ids)) {
      return back()->with('error', 'No teachers selected');
    }

    $teachers = User::role('teacher')->whereIn('id', $ids)->get();
    foreach ($teachers as $teacher) {
      if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
        unlink(public_path($teacher->avatar));
      }
      if ($teacher->cv && file_exists(public_path($teacher->cv))) {
        unlink(public_path($teacher->cv));
      }
      $teacher->delete();
    }

    return back()->with('success', count($teachers) . ' teachers deleted successfully');
  }
}
