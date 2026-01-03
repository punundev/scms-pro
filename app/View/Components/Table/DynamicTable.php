<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DynamicTable extends Component
{
  public $headers, $tdclass,
    $items,
    $emptyMessage,
    $actions,
    $checkbox,
    $endpoint,
    $actionItems;
  public function __construct(
    array $headers,
    $tdclass = null,
    $items = [],
    string $emptyMessage = 'No records found',
    bool $checkbox = true,
    $actions = true,
    $endpoint = '',
  ) {
    $this->headers = $headers;
    $this->tdclass = $tdclass;
    $this->items = $items;
    $this->emptyMessage = $emptyMessage;
    $this->checkbox = $checkbox;
    $this->endpoint = $endpoint;
    $this->actions = $actions;
    if (is_bool($actions)) {
      $this->actions = $actions;
      $this->actionItems = $actions ? ['edit', 'detail', 'delete'] : [];
    } else {
      $this->actions = !empty($actions);
      $this->actionItems = is_array($actions) ? $actions : [];
    }
  }
  public function render(): View|Closure|string
  {
    return view('components.table.dynamic-table');
  }

  public static function getDisplayValue($item, $key)
  {
    if (method_exists($item, $key) || isset($item->{$key})) {
      return $item->{$key} ?? 'N/A';
    }
    if (in_array($key, ['role', 'type']) && method_exists($item, 'getRoleNames')) {
      return $item->getRoleNames()->first() ?? 'N/A';
    }

    return 'N/A';
  }
}
