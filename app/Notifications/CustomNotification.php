<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification
{
  use Queueable;

  public function __construct(
    public string $title,
    public string $body,
  ) {}

  public function via($notifiable)
  {
    return ['database'];
  }

  public function toDatabase($notifiable)
  {
    return [
      'title' => $this->title,
      'body' => $this->body
    ];
  }
}
