<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class GenericReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
  protected $data;
  protected $mapping;

  public function __construct($data, array $mapping)
  {
    $this->data = is_a($data, \Illuminate\Pagination\LengthAwarePaginator::class)
      ? $data->getCollection()
      : collect($data);

    $this->mapping = $mapping;
  }

  public function collection()
  {
    return $this->data;
  }

  public function headings(): array
  {
    return array_keys($this->mapping);
  }

  public function map($row): array
  {
    $result = [];
    foreach ($this->mapping as $header => $field) {
      $result[] = data_get($row, $field, '—');
    }
    return $result;
  }
}
