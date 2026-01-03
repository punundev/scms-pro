<?php

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
  public function __construct() {}

  public function render(): View|Closure|string
  {
    return view('components.page.alert');
  }
}
