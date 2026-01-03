<?php

namespace App\View\Components\Photos;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class upload extends Component
{
    public $name, $label, $id, $edit;
    public function __construct(
        $name,
        $label = null,
        $id = null,
        $edit = false,
    ) {
        $this->name = $name;
        $this->edit = $edit;
        $this->label = $label ?? ucfirst($name);
        $this->id = $id ?? $name;
    }
    public function render(): View|Closure|string
    {
        return view('components.photos.upload');
    }
}
