<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class btnclose extends Component
{
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function render(): View|Closure|string
    {
        return view('components.button.btnclose');
    }
}
