<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EnrollmentReportExport implements FromView, ShouldAutoSize
{
  protected $data;

  public function __construct($data)
  {
    $this->data = is_a($data, \Illuminate\Pagination\LengthAwarePaginator::class)
      ? $data->getCollection()
      : $data;
  }

  public function view(): View
  {
    return view('exports.enrollment_report', [
      'data' => $this->data
    ]);
  }
}
