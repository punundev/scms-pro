<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Expense;

class ExpenseCreated extends Notification
{
  use Queueable;

  public $expense;

  public function __construct(Expense $expense)
  {
    $this->expense = $expense;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    return [
      'title' => 'New Expense Submitted',
      'body' => 'A new expense of $' . number_format($this->expense->amount, 2) . ' was submitted for category: ' . $this->expense->category->name,
      'link' => route('admin.expenses.show', $this->expense->id),
    ];
  }
}
