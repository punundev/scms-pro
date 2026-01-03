<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\CourseOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Exam';
  }


  // public function index(Request $request)
  // {
  //   $courseOfferingId = $request->input('course_offering_id');

  //   if (!$courseOfferingId) {
  //     return redirect()->back()->with('error', 'Course offering ID is required.');
  //   }

  //   $search = $request->input('search');
  //   $perPage = $request->input('per_page', 10);
  //   $courses = CourseOffering::findOrFail($courseOfferingId);

  //   $exams = Exam::withTrashed()
  //     ->where('course_offering_id', $courseOfferingId)
  //     ->with([
  //       'courseOffering' => fn($q) => $q->withTrashed()
  //     ])
  //     ->when($search, function ($query) use ($search) {
  //       return $query->where(function ($q) use ($search) {
  //         $q->where('type', 'like', "%{$search}%")
  //           ->orWhere('description', 'like', "%{$search}%")
  //           ->orWhereHas('courseOffering.subject', function ($s) use ($search) {
  //             $s->where('name', 'like', "%{$search}%");
  //           });
  //       });
  //     })
  //     ->orderBy('date', 'desc')
  //     ->paginate($perPage)
  //     ->appends([
  //       'search'   => $search,
  //       'per_page' => $perPage,
  //       'course_offering_id' => $courseOfferingId,
  //     ]);

  //   return view('admin.exams.index', compact('exams', 'courseOfferingId', 'courses'));
  // }


  public function index(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if (!$courseOfferingId) {
      return redirect()->back()->with('error', 'Course offering ID is required.');
    }

    $search = $request->input('search');
    $courses = CourseOffering::findOrFail($courseOfferingId);

    $exams = Exam::withTrashed()
      ->where('course_offering_id', $courseOfferingId)
      ->with([
        'courseOffering' => fn($q) => $q->withTrashed()
      ])
      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('type', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhereHas('courseOffering.subject', function ($s) use ($search) {
              $s->where('name', 'like', "%{$search}%");
            });
        });
      })
      ->orderBy('date', 'desc')
      ->get(); // ✅ no pagination

    return view('admin.exams.index', compact('exams', 'courseOfferingId', 'courses'));
  }


  public function create(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');

    $courseOffering = CourseOffering::with(['subject', 'teacher', 'classroom'])
      ->find($courseOfferingId);

    if (!$courseOffering) {
      return redirect()->route('admin.course_offerings.index')
        ->with('error', 'Invalid course offering.');
    }

    return view('admin.exams.create', compact('courseOffering', 'courseOfferingId'));
  }

  public function store(ExamRequest $request)
  {
    try {
      $data = $request->validated();
      $data['course_offering_id'] = $request->input('course_offering_id');

      Exam::create($data);

      return redirect()
        ->route('admin.exams.index', ['course_offering_id' => $data['course_offering_id']])
        ->with('success', 'Exam created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating exam: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error creating exam.')->withInput();
    }
  }

  public function show(Request $request, Exam $exam)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if ($exam->course_offering_id != $courseOfferingId) {
      return redirect()->back()->with('error', 'Access denied for this exam.');
    }

    $exam->load(['courseOffering', 'scores']);

    return view('admin.exams.show', compact('exam', 'courseOfferingId'));
  }

  public function edit(Request $request, Exam $exam)
  {
    $courseOfferingId = $request->input('course_offering_id');

    if ($exam->course_offering_id != $courseOfferingId) {
      return redirect()->back()->with('error', 'Access denied for this exam.');
    }

    $courseOffering = CourseOffering::with(['subject', 'teacher', 'classroom'])
      ->find($courseOfferingId);

    return view('admin.exams.edit', compact('exam', 'courseOffering', 'courseOfferingId'));
  }

  public function update(ExamRequest $request, Exam $exam)
  {
    try {
      if ($exam->course_offering_id != $request->input('course_offering_id')) {
        return redirect()->back()->with('error', 'Invalid course offering for update.');
      }

      $exam->update($request->validated());

      return redirect()
        ->route('admin.exams.index', [
          'course_offering_id' => $exam->course_offering_id
        ])
        ->with('success', 'Exam updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating Exam: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error updating exam.')->withInput();
    }
  }

  public function destroy(Request $request, Exam $exam)
  {
    try {
      $courseOfferingId = $request->input('course_offering_id');

      if ($exam->course_offering_id != $courseOfferingId) {
        return redirect()->back()->with('error', 'Invalid delete action.');
      }

      $exam->delete();

      return redirect()
        ->route('admin.exams.index', ['course_offering_id' => $courseOfferingId])
        ->with('success', 'Exam deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Exam: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting exam: ' . $e->getMessage());
    }
  }
}
