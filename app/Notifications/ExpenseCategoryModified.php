<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\ExpenseCategory;

class ExpenseCategoryModified extends Notification
{
  use Queueable;

  public $expenseCategory;
  public $action;

  public function __construct(ExpenseCategory $expenseCategory, string $action)
  {
    $this->expenseCategory = $expenseCategory;
    $this->action = $action;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $title = 'Expense Category ' . ucfirst($this->action);
    $body = 'The expense category "' . $this->expenseCategory->name . '" has been ' . $this->action . '.';
    $link = null;

    if ($this->action !== 'deleted') {
      $link = route('admin.expense_categories.show', $this->expenseCategory->id);
    }

    return [
      'title' => $title,
      'body' => $body,
      'link' => $link,
      'category_id' => $this->expenseCategory->id,
      'action' => $this->action,
    ];
  }
}
