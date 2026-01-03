<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Fee;

class FeeAssigned extends Notification
{
  use Queueable;

  public Fee $fee;

  public function __construct(Fee $fee)
  {
    $this->fee = $fee;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $feeTypeName = $this->fee->feeType->name ?? 'Fee';

    return [
      'title' => "New {$feeTypeName} Assigned",
      'body' => "You have been assigned a new fee of $" . number_format($this->fee->amount, 2) . " (Due: {$this->fee->due_date->format('M d, Y')}).",
      'link' => route('admin.fees.show', $this->fee->id),
      'status' => $this->fee->status,
    ];
  }
}
