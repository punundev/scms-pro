<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination extends Component
{
  public $paginator;

  public function __construct(LengthAwarePaginator $paginator)
  {
    $this->paginator = $paginator;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.pagination');
  }
}
