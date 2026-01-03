<?php

namespace App\View\Components\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $label,
        $name,
        $value,
        $placeholder,
        $required,
        $rows,
        $edit,
        $detail,
        $readonly,
        $disabled,
        $maxlength,
        $autocomplete,
        $pattern;

    public function __construct(
        $label,
        $name,
        $value = '',
        $placeholder = '',
        $required = false,
        $rows = 3,
        $edit = false,
        $detail = false,
        $readonly = false,
        $disabled = false,
        $maxlength = null,
        $autocomplete = null,
        $pattern = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->rows = $rows;
        $this->edit = $edit;
        $this->detail = $detail;
        $this->readonly = $readonly || $detail;
        $this->disabled = $disabled || $detail;
        $this->maxlength = $maxlength;
        $this->autocomplete = $autocomplete;
        $this->pattern = $pattern;
    }

    public function render(): View|Closure|string
    {
        return view('components.fields.textarea');
    }
}
