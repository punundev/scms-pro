<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Payment;

class PaymentReceived extends Notification
{
  use Queueable;

  public $payment;

  public function __construct(Payment $payment)
  {
    $this->payment = $payment;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $receiver = $this->payment->receiver?->name ?? 'Unknown';

    return [
      'title' => 'New Payment Received (' . $receiver . ')',
      'body'  => 'Payment of $' . number_format($this->payment->amount, 2) .
        ' was received for Fee #' . $this->payment->fee_id,
      'link'  => route('admin.fees.show', $this->payment->fee_id),
    ];
  }
}
