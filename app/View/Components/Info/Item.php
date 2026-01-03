<?php

namespace App\View\Components\Info;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
  public string $id;
  public string $name;
  public string $label;
  public string $icon;
  public string $labelcolor;
  public string $color;
  public string $position;

  public function __construct(
    string $name = '',
    string $id = '',
    string $label = '',
    string $icon = '',
    string $labelcolor = '',
    string $color = '',
    string $position = 'left'
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->label = $label;
    $this->icon = $icon;
    $this->color = $color;
    $this->labelcolor = $labelcolor;
    $this->position = $position;
  }

  public function render(): View|Closure|string
  {
    return view('components.info.item');
  }
}
