<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'teacher_id' => 'required|exists:users,id',
      'subject_id' => 'required|exists:subjects,id',
      'classroom_id' => 'required|exists:classrooms,id',
      'weekday' => 'required|string|max:20',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i|after:start_time',
    ];
  }

  public function messages(): array
  {
    return [
      'teacher_id.required' => 'Teacher is required.',
      'subject_id.required' => 'Subject is required.',
      'classroom_id.required' => 'Classroom is required.',
      'weekday.required' => 'Weekday is required.',
      'start_time.required' => 'Start time is required.',
      'start_time.date_format' => 'Start time must be in H:i format.',
      'end_time.required' => 'End time is required.',
      'end_time.date_format' => 'End time must be in H:i format.',
      'end_time.after' => 'End time must be after start time.',
    ];
  }
}
