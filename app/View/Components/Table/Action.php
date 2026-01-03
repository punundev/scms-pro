<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
  public $id, $checkbox;

  public function __construct($id,  bool $checkbox = true)
  {
    $this->id = $id;
    $this->checkbox = $checkbox;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.action');
  }
}
