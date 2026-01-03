<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\CourseOffering;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromView, WithColumnWidths, WithStyles, WithEvents
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

    $dates = Attendance::where('course_offering_id', $this->courseOfferingId)
      ->orderBy('date', 'asc')
      ->pluck('date')
      ->unique()
      ->map(fn($d) => \Carbon\Carbon::parse($d))
      ->values();

    $records = Attendance::with('student')
      ->where('course_offering_id', $this->courseOfferingId)
      ->get()
      ->groupBy('student_id');

    return view('exports.attendance_sheet', [
      'course' => $course,
      'records' => $records,
      'dates' => $dates,
    ]);
  }

  public function columnWidths(): array
  {
    return [
      'A' => 5,
      'B' => 30,
      'C' => 6,
    ];
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true, 'size' => 16]],
      'A' => ['alignment' => ['horizontal' => 'center']],
      'C' => ['alignment' => ['horizontal' => 'center']],
    ];
  }

  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $event->sheet->getDelegate()->freezePane('D8');
      },
    ];
  }
}
