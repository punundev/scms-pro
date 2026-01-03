<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cell extends Component
{
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }
    public function render(): View|Closure|string
    {
        return view('components.table.cell');
    }
}
