<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotFoundData extends Component
{
    public $title, $iconPath;

    public function __construct(String $title = "", $iconPath = "")
    {
        $this->title = $title;
        $this->iconPath = $iconPath;
    }
    public function render(): View|Closure|string
    {
        return view('components.not-found-data');
    }
}
