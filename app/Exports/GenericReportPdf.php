<?php

namespace App\Exports;

use Barryvdh\DomPDF\Facade\Pdf;

class GenericReportPdf
{
  protected $data;
  protected $columns;

  public function __construct($data, array $columns)
  {
    $this->data = collect($data);
    $this->columns = $columns;
  }

  public function download($filename = 'report.pdf')
  {
    $pdf = Pdf::loadView('exports.generic_pdf', [
      'data' => $this->data,
      'columns' => $this->columns
    ])->setPaper('A4', 'portrait');

    return $pdf->download($filename);
  }
}
