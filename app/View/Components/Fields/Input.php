<?php

namespace App\View\Components\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label,
        $name,
        $edit,
        $detail,
        $type,
        $value,
        $placeholder,
        $required,
        $min,
        $max,
        $step,
        $maxlength,
        $readonly,
        $disabled,
        $autocomplete,
        $pattern,
        $oninput,
        $title;

    public function __construct(
        $label,
        $name,
        $edit = false,
        $detail = false,
        $type = 'text',
        $min = null,
        $max = null,
        $value = '',
        $placeholder = '',
        $required = false,
        $step = null,
        $maxlength = null,
        $readonly = false,
        $disabled = false,
        $autocomplete = null,
        $pattern = null,
        $oninput = null,
        $title = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->edit = $edit;
        $this->detail = $detail;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->maxlength = $maxlength;
        $this->readonly = $readonly || $detail;
        $this->disabled = $disabled || $detail;
        $this->autocomplete = $autocomplete;
        $this->pattern = $pattern;
        $this->oninput = $oninput;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fields.input');
    }
}
