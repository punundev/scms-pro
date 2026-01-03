<?php

namespace App\View\Components\modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmDelete extends Component
{
  public $title;
  public function __construct(string $title = '')
  {
    $this->title = $title;
  }
  public function render(): View|Closure|string
  {
    return view('components.modal.confirmdelete');
  }
}
