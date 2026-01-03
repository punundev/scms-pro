<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Attendance;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Attendance';
  }


  public function index(Request $request)
  {
    $courseOfferingId = $request->input('course_offering_id');
    $search = $request->input('search');
    $courseOffering = CourseOffering::with('students')->findOrFail($courseOfferingId);

    $date = $request->input('date', now()->toDateString());

    if ($date < $courseOffering->join_start->toDateString()) {
      $date = $courseOffering->join_start->toDateString();
    }

    if ($date > $courseOffering->join_end->toDateString()) {
      $date = $courseOffering->join_end->toDateString();
    }

    $studentsQuery = $courseOffering->students();

    if ($studentsQuery->count() === 0) {
      return redirect()
        ->route('admin.enrollments.create', ['course_offering_id' => $courseOfferingId])
        ->with('error', 'You need to enroll student first.');
    }

    if ($search) {
      $studentsQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    $students = $studentsQuery->with([
      'attendances' => function ($q) use ($courseOfferingId, $date) {
        $q->where('course_offering_id', $courseOfferingId)
          ->where('date', $date);
      }
    ])->get();

    return view('admin.attendance.index', compact(
      'students',
      'courseOffering',
      'date'
    ));
  }


  public function exportCourseAttendance($courseOfferingId)
  {
    $course = CourseOffering::findOrFail($courseOfferingId);
    $fileName = 'Attendance_' . $course->subject->name . '_' . $course->time_slot . '.xlsx';

    return Excel::download(new AttendanceExport($courseOfferingId), $fileName);
  }



  public function show($courseOfferingId, $studentId)
  {
    $courseOffering = CourseOffering::findOrFail($courseOfferingId);
    $student = User::findOrFail($studentId);

    $attendances = Attendance::where('student_id', $studentId)
      ->where('course_offering_id', $courseOfferingId)
      ->orderBy('date', 'desc')
      ->get();

    $enrollment = Enrollment::where('student_id', $studentId)
      ->where('course_offering_id', $courseOfferingId)
      ->first();


    return view('admin.attendance.show', compact('student', 'courseOffering', 'attendances', 'enrollment'));
  }

  public function saveAll(Request $request)
  {
    $courseOfferingId = $request->course_offering_id;
    $date = $request->date ?? date('Y-m-d');

    $courseOffering = CourseOffering::with('students')->findOrFail($courseOfferingId);

    foreach ($courseOffering->students as $student) {
      $status = $request->input("status_{$student->id}", 'absence');
      $remarks = $request->input("remarks_{$student->id}");

      Attendance::updateOrCreate(
        [
          'student_id' => $student->id,
          'course_offering_id' => $courseOfferingId,
          'date' => $date,
        ],
        [
          'classroom_id' => $courseOffering->classroom_id,
          'status' => $status,
          'remarks' => $remarks,
        ]
      );
    }

    $this->recalculateAttendanceGrade($courseOfferingId);

    return back()->with('success', 'Attendance saved successfully!');
  }

  private function recalculateAttendanceGrade(int $courseOfferingId): void
  {
    $attendances = Attendance::where('course_offering_id', $courseOfferingId)
      ->get()
      ->groupBy('student_id');

    foreach ($attendances as $studentId => $records) {

      $totalDays = $records->count();

      if ($totalDays === 0) {
        $attendanceGrade = 0;
      } else {

        $actualSum = $records->sum(function ($attendance) {
          return match ($attendance->status) {
            'attending'  => 1,
            'permission' => 0.5,
            default      => 0,
          };
        });

        // 🎯 EXACT numpy formula
        $attendanceGrade = ($actualSum / $totalDays) * 10;
      }

      Enrollment::where('course_offering_id', $courseOfferingId)
        ->where('student_id', $studentId)
        ->update([
          'attendance_grade' => round($attendanceGrade, 2),
        ]);
    }
  }
}