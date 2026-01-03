<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $btnType;
    public $id;
    public $type;

    public function __construct($btnType = 'primary', $id = null, $type = 'button')
    {
        $this->btnType = $btnType;
        $this->id = $id;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.button.button');
    }
}
