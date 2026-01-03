<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CropModal extends Component
{
  public function __construct() {}

  public function render(): View|Closure|string
  {
    return view('components.modal.crop-modal');
  }
}
