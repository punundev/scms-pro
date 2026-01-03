<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tr extends Component
{
    public $class;

    public function __construct(string $class = '')
    {
        $this->class = $class;
    }
    public function render(): View|Closure|string
    {
        return view('components.table.tr');
    }
}
