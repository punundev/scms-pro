<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Fee;

class FeePaidNotification extends Notification
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
    return [
      'title' => "Fee Paid: \${$this->fee->amount}",
      'body'  => "Payment for {$this->fee->feeType?->name} by {$this->fee->student?->name} has been recorded.",
      'link'  => route('admin.fees.show', $this->fee->id),
      'date'  => optional($this->fee->paid_date)->format('M d, Y'),
    ];
  }
}
