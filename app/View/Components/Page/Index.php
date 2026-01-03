<?php

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
  public $title,
    $iconSvgPath,
    $btnText,
    $showSearch,
    $showReset,
    $showViewToggle,
    $btnCreate,
    $href,
    $btnLink;

  public function __construct(
    string $title,
    string $iconSvgPath,
    string $btnText = 'Create New',
    bool $showSearch = true,
    bool $showReset = true,
    bool $showViewToggle = true,
    bool $btnCreate = false,
    string $href = '',
    bool $btnLink = false
  ) {
    $this->title = $title;
    $this->iconSvgPath = $iconSvgPath;
    $this->btnText = $btnText;
    $this->showSearch = $showSearch;
    $this->showReset = $showReset;
    $this->showViewToggle = $showViewToggle;
    $this->btnCreate = $btnCreate;
    $this->href = $href;
    $this->btnLink = $btnLink;
  }


  public function render(): View|Closure|string
  {
    return view('components.page.index');
  }
}
