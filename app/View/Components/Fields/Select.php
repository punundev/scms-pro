<?php

namespace App\View\Components\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
class Select extends Component
{

    public $name, $label, $options, $value, $required, $searchable, $id, $placeholder, $edit;
    public function __construct(
        $name,
        $label = null,
        $options = [],
        $value = null,
        $required = false,
        $searchable = false,
        $id = null,
        $placeholder = 'Select...',
        $edit = false,
    ) {
        $this->name = $name;
        $this->edit = $edit;
        $this->label = $label ?? ucfirst($name);
        $this->options = $options;
        $this->value = $value;
        $this->required = $required;
        $this->searchable = $searchable;
        $this->id = $id ?? $name;
        $this->placeholder = $placeholder;
        if ($options instanceof Collection || is_array($options)) {
            $this->options = $options;
        } else {
            $this->options = collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fields.select');
    }
}
