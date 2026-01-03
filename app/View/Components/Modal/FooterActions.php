<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterActions extends Component
{
  public $class,  $create, $edit, $detail, $delete;

  public function __construct(
    string $class = '',
    bool $create = false,
    bool $edit = false,
    bool $detail = false,
    bool $delete = false,

  ) {
    $this->class = $class;
    $this->create = $create;
    $this->edit = $edit;
    $this->detail = $detail;
    $this->delete = $delete;
  }
  public function render(): View|Closure|string
  {
    return view('components.modal.footer-actions');
  }
}
