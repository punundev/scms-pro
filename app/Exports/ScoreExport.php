<?php

namespace App\Exports;

use App\Models\Score;
use App\Models\Exam;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScoreExport implements FromView, WithColumnWidths, WithStyles
{
  protected $examId;

  public function __construct($examId)
  {
    $this->examId = $examId;
  }

  public function view(): View
  {
    $exam = Exam::with(['courseOffering.subject', 'courseOffering.teacher', 'courseOffering.classroom'])
      ->findOrFail($this->examId);

    $scores = Score::with('student')
      ->where('exam_id', $this->examId)
      ->orderBy('student_id')
      ->get();

    return view('exports.score_sheet', [
      'exam' => $exam,
      'scores' => $scores
    ]);
  }

  public function columnWidths(): array
  {
    return [
      'A' => 6,
      'B' => 15,
      'C' => 35,
      'D' => 10,
      'E' => 12,
      'F' => 10,
      'G' => 30,
    ];
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true, 'size' => 16]],
      'E' => ['alignment' => ['horizontal' => 'center']],
      'F' => ['alignment' => ['horizontal' => 'center']],
    ];
  }
}
