<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseOfferingRequest;
use App\Models\CourseOffering;
use App\Models\Subject;
use App\Models\User;
use App\Models\Classroom;
use App\Notifications\CourseAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseOfferingController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Course-Offering';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 6);

    $user = Auth::user();

    $courseOfferings = CourseOffering::withTrashed()
      // ->with(['subject', 'teacher', 'classroom', 'attendances', 'exams'])
      ->with([
        'subject' => fn($q) => $q->withTrashed(),
        'teacher' => fn($q) => $q->withTrashed(),
        'classroom' => fn($q) => $q->withTrashed(),
        'attendances' => fn($q) => $q->withTrashed(),
        'exams' => fn($q) => $q->withTrashed(),
      ])

      ->when($user->hasRole('teacher'), function ($query) use ($user) {
        $query->where('teacher_id', $user->id);
      })

      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('time_slot', 'like', "%{$search}%")
            ->orWhere('fee', 'like', "%{$search}%")
            ->orWhere('payment_type', 'like', "%{$search}%")
            ->orWhereHas('subject', function ($q2) use ($search) {
              $q2->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('teacher', function ($q3) use ($search) {
              $q3->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('classroom', function ($q4) use ($search) {
              $q4->where('name', 'like', "%{$search}%");
            });
        });
      })

      ->orderByRaw('join_end < NOW(), join_end DESC')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.course_offerings.index', compact('courseOfferings'));
  }

  public function create()
  {
    $subjects = Subject::orderBy('name')->get(['id', 'name', 'code']);

    $teachers = User::role('teacher')
      ->orderBy('name')
      ->get(['id', 'name', 'specialization']);

    $classrooms = Classroom::orderBy('name')->get(['id', 'name']);

    if ($classrooms->isEmpty()) {
      return redirect()->route('admin.classrooms.create')->with('error', 'No classrooms found. Please create a classroom first.');
    }

    if ($subjects->isEmpty()) {
      return redirect()->route('admin.subjects.create')->with('error', 'No subjects found. Please create a subject first.');
    }

    if ($teachers->isEmpty()) {
      return redirect()->route('admin.teachers.index')->with('error', 'No teachers found. Please create a teacher first.');
    }



    return view('admin.course_offerings.create', compact('subjects', 'teachers', 'classrooms'));
  }

  public function store(CourseOfferingRequest $request)
  {
    try {
      $offering = CourseOffering::create($request->validated());

      if ($offering->teacher) {
        $offering->teacher->notify(new CourseAssigned($offering));
      }

      return redirect()->route('admin.course_offerings.index')->with('success', 'Course Offering created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Course Offering: ' . $e->getMessage());
      return redirect()->route('admin.course_offerings.create')->with('error', 'Error creating course offering.')->withInput();
    }
  }

  public function show(CourseOffering $courseOffering)
  {
    // $courseOffering->load(['subject', 'teacher', 'classroom', 'students']);
    $courseOffering->load([
      'subject'   => fn($q) => $q->withTrashed(),
      'teacher'   => fn($q) => $q->withTrashed(),
      'classroom' => fn($q) => $q->withTrashed(),
      'students'  => fn($q) => $q->withTrashed(),
    ]);


    return view('admin.course_offerings.show', compact('courseOffering'));
  }

  public function edit(CourseOffering $courseOffering)
  {
    $subjects = Subject::orderBy('name')->get(['id', 'name', 'code']);
    $teachers = User::role('teacher')
      ->orderBy('name')
      ->get(['id', 'name', 'specialization']);
    $classrooms = Classroom::orderBy('name')->get(['id', 'name']);

    if ($subjects->isEmpty()) {
      return redirect()->route('admin.subjects.create')->with('error', 'No subjects found. Please create a subject first.');
    }

    if ($teachers->isEmpty()) {
      return redirect()->route('admin.teachers.create')->with('error', 'No teachers found. Please create a teacher first.');
    }

    if ($classrooms->isEmpty()) {
      return redirect()->route('admin.classrooms.create')->with('error', 'No classrooms found. Please create a classroom first.');
    }

    return view('admin.course_offerings.edit', compact('courseOffering', 'subjects', 'teachers', 'classrooms'));
  }

  public function update(CourseOfferingRequest $request, CourseOffering $courseOffering)
  {
    try {
      $courseOffering->update($request->validated());
      return redirect()->route('admin.course_offerings.index')->with('success', 'Course Offering updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating Course Offering: ' . $e->getMessage());
      return redirect()->route('admin.course_offerings.edit', $courseOffering)->with('error', 'Error updating course offering.')->withInput();
    }
  }

  public function destroy(CourseOffering $courseOffering)
  {
    try {
      $courseOffering->delete();
      return redirect()->route('admin.course_offerings.index')->with('success', 'Course Offering deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Course Offering: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting course offering: ' . $e->getMessage());
    }
  }

  public function restore($id)
  {
    try {
      $course = CourseOffering::onlyTrashed()->findOrFail($id);
      $course->restore();

      return redirect()
        ->route('admin.course_offerings.index')
        ->with('success', 'course offering restored successfully');
    } catch (\Exception $e) {
      Log::error('Error restoring course offering: ' . $e->getMessage());

      return redirect()
        ->back()
        ->with('error', 'Error restoring course offering');
    }
  }
}
