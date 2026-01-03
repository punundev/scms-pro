<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\CourseOffering;

class CourseAssigned extends Notification
{
  use Queueable;

  public CourseOffering $offering;

  public function __construct(CourseOffering $offering)
  {
    $this->offering = $offering;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $subjectName = $this->offering->subject?->name ?? 'A Subject';
    $classroomName = $this->offering->classroom?->name ?? 'TBD';

    return [
      'title' => "New Course Assigned: {$subjectName}",
      'body' => "You have been assigned to teach {$subjectName} in room {$classroomName}. Schedule: {$this->offering->schedule} ({$this->offering->start_time} - {$this->offering->end_time}).",
      'link' => route('admin.course_offerings.show', $this->offering->id),
      'start_date' => $this->offering->join_start,
    ];
  }
}
