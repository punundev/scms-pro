<?php

namespace App\View\Components\Photos;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class upload2 extends Component
{
  public $class;
  public $name;
  public $icon;
  public $rounded;
  // ADDED: Property to hold the current image URL for edit pages
  public $currentImageUrl;
  // ADDED: Property to signal if a remove button should be shown (for edit pages)
  public $canRemove;
  // ADDED: Property for the Alpine remove action
  public $removeAction;

  public function __construct(
    string $name = "",
    string $class = "",
    string $icon = 'ri-account-circle-fill',
    string $rounded = 'rounded-full',
    // ADDED: Accept current image URL
    ?string $currentImageUrl = null,
    // ADDED: Accept canRemove flag
    bool $canRemove = false,
    string $removeAction = ''
  ) {
    $this->name = $name;
    $this->class = $class;
    $this->icon = $icon;
    $this->rounded = $rounded;
    $this->currentImageUrl = $currentImageUrl; // Set the property
    $this->canRemove = $canRemove;
    $this->removeAction = $removeAction;
  }

  public function render(): View|Closure|string
  {
    return view('components.photos.upload2');
  }
}
