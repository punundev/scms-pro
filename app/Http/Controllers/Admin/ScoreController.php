<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportCourseScore;
use App\Exports\ScoreExport;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Score;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ScoreController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Score';
  }

  public function index(Request $request)
  {
    $examId = $request->input('exam_id');
    $search = $request->input('search');
    $exam = Exam::with('courseOffering.students')->findOrFail($examId);

    $studentsQuery = $exam->courseOffering->students();

    if ($studentsQuery->count() === 0) {
      return redirect()
        ->route('admin.enrollments.create', ['course_offering_id' => $exam->courseOffering->id])
        ->with('error', 'You need to enroll student first.');
    }

    if ($search) {
      $studentsQuery = $studentsQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    $students = $studentsQuery->with([
      'scores' => function ($q) use ($examId) {
        $q->where('exam_id', $examId);
      }
    ])->get();

    return view('admin.scores.index', compact('students', 'exam'));
  }

  public function show($courseOfferingId, $studentId)
  {
    $courseOffering = CourseOffering::findOrFail($courseOfferingId);
    $student = User::findOrFail($studentId);

    $enrollment = Enrollment::where('student_id', $studentId)
      ->where('course_offering_id', $courseOfferingId)
      ->firstOrFail();

    return view('admin.scores.show', compact('student', 'courseOffering', 'enrollment'));
  }

  public function exportCourseScores($courseOfferingId)
  {
    $course = CourseOffering::findOrFail($courseOfferingId);
    $fileName = 'Score_Report_' . $course->subject->name . '_' . str_replace(' ', '_', $course->time_slot) . '.xlsx';

    return Excel::download(new ExportCourseScore($courseOfferingId), $fileName);
  }

  public function exportExamScores($examId)
  {
    $exam = Exam::with('courseOffering')->findOrFail($examId);

    $fileName = 'Scores_' . $exam->title . '_' . $exam->courseOffering->subject->name . '.xlsx';

    return Excel::download(new ScoreExport($examId), $fileName);
  }

  public function saveAll(Request $request)
  {
    $examId = $request->exam_id;
    $exam = Exam::with('courseOffering.students')->findOrFail($examId);

    foreach ($exam->courseOffering->students as $student) {
      $scoreValue = $request->input("score_{$student->id}", 0);
      $remarks = $request->input("remarks_{$student->id}");

      if ($scoreValue >= 90) $grade = 'A+';
      elseif ($scoreValue >= 80) $grade = 'A';
      elseif ($scoreValue >= 70) $grade = 'B+';
      elseif ($scoreValue >= 60) $grade = 'B';
      elseif ($scoreValue >= 50) $grade = 'C+';
      elseif ($scoreValue >= 40) $grade = 'C';
      elseif ($scoreValue >= 30) $grade = 'D';
      else $grade = 'F';

      $score =  Score::updateOrCreate(
        ['student_id' => $student->id, 'exam_id' => $examId],
        [
          'score'   => $scoreValue,
          'grade'   => $grade,
          'remarks' => $remarks,
        ]
      );

      $this->updateEnrollmentGrade($score);
    }

    return back()->with('success', 'All scores saved successfully!');
  }

  private function scaleScore(float $score, float $totalMarks, float $maxGrade): float
  {
    if ($totalMarks <= 0) return 0;
    return round(($score / $totalMarks) * $maxGrade, 2);
  }

  public function updateEnrollmentGrade(Score $score)
  {
    // $exam = $score->exam()->first();
    $exam = $score->exam()->with('courseOffering')->first();
    if (!$exam || !$exam->courseOffering) return;

    $enrollment = Enrollment::where('course_offering_id', $exam->course_offering_id)
      ->where('student_id', $score->student_id)
      ->first();

    if (!$enrollment) return;
    $isFinalOnly = $exam->courseOffering->is_final_only;

    switch ($exam->type) {
      case 'listening':
        $enrollment->listening_grade = $this->scaleScore($score->score, $exam->total_marks, 10);
        break;
      case 'writing':
        $enrollment->writing_grade = $this->scaleScore($score->score, $exam->total_marks, 10);
        break;
      case 'reading':
        $enrollment->reading_grade = $this->scaleScore($score->score, $exam->total_marks, 10);
        break;
      case 'speaking':
        $enrollment->speaking_grade = $this->scaleScore($score->score, $exam->total_marks, 10);
        break;
      case 'midterm':
        $enrollment->midterm_grade = $this->scaleScore($score->score, $exam->total_marks, 20);
        break;
      case 'final':
        // $enrollment->final_grade = $this->scaleScore($score->score, $exam->total_marks, 30);
        $maxGrade = $isFinalOnly ? 90 : 30;
        $enrollment->final_grade = $this->scaleScore($score->score, $exam->total_marks, $maxGrade);
        break;
    }

    $enrollment->save();
  }
}
