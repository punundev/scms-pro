<?php

namespace App\Exports;

use App\Models\Enrollment;
use App\Models\CourseOffering;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportCourseScore implements FromView, WithColumnWidths, WithStyles
{
  protected $courseOfferingId;

  public function __construct($courseOfferingId)
  {
    $this->courseOfferingId = $courseOfferingId;
  }

  public function view(): View
  {
    $course = CourseOffering::with(['subject', 'teacher', 'classroom'])
      ->findOrFail($this->courseOfferingId);

    // Get all enrollments for this specific course offering
    $enrollments = Enrollment::with('student')
      ->where('course_offering_id', $this->courseOfferingId)
      ->get()
      ->sortBy(function ($enrollment) {
        return $enrollment->student->name;
      });

    return view('exports.course_score_sheet', [
      'course' => $course,
      'enrollments' => $enrollments,
    ]);
  }

  public function columnWidths(): array
  {
    return [
      'A' => 5,   // No
      'B' => 35,  // Name
      'C' => 6,   // Sex
      'D' => 12,  // Attendance
      'E' => 10,  // Listening
      'F' => 10,  // Reading
      'G' => 10,  // Writing
      'H' => 10,  // Speaking
      'I' => 12,  // Midterm
      'J' => 12,  // Final
      'K' => 10,  // Total
      'L' => 8,   // Grade
    ];
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true, 'size' => 16]],
      'A' => ['alignment' => ['horizontal' => 'center']],
      'C' => ['alignment' => ['horizontal' => 'center']],
      'K' => ['font' => ['bold' => true]], // Bold the total column
      'L' => ['alignment' => ['horizontal' => 'center'], 'font' => ['bold' => true]],
    ];
  }
}
