<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
  public $headers,$checkbox;

  public function __construct(
    array $headers = [],bool $checkbox = true
  ) {
    $this->headers = $headers;
    $this->checkbox = $checkbox;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.table');
  }
}
