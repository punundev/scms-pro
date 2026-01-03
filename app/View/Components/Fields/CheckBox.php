<?php

namespace App\View\Components\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBox extends Component
{
  public
    $id,
    $name,
    $class,
    $value,
    $required,
    $readonly,
    $disabled,
    $checked;

  public function __construct(
    $id = null,
    $name,
    $class = '',
    $detail = false,
    $value = null,
    $required = false,
    $readonly = false,
    $disabled = false,
    $checked = false,
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->checked = $checked;
    $this->class = $class;
    $this->value = $value;
    $this->required = $required;
    $this->readonly = $readonly || $detail;
    $this->disabled = $disabled || $detail;
  }
  public function render(): View|Closure|string
  {
    return view('components.fields.checkbox');
  }
}
