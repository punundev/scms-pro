<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CourseOffering;
use App\Models\User;

class CourseOfferingRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'subject_id' => ['required', 'exists:subjects,id'],

      'teacher_id' => [
        'nullable',
        'exists:users,id',
        function ($attribute, $value, $fail) {
          if ($value && !User::find($value)?->hasRole('teacher')) {
            $fail('Selected user is not a teacher.');
            return;
          }

          if ($this->hasOverlap('teacher_id', $value)) {
            $fail('This teacher already has a course at that time.');
          }
        },
      ],

      'classroom_id' => [
        'nullable',
        'exists:classrooms,id',
        function ($attribute, $value, $fail) {
          if ($this->hasOverlap('classroom_id', $value)) {
            $fail('This classroom is already used at that time.');
          }
        },
      ],

      'time_slot' => ['required', 'in:morning,afternoon,evening'],
      'schedule'  => ['required', 'in:mon-wed,mon-fri,wed-fri,sat-sun'],

      'start_time' => ['nullable', 'date_format:H:i'],
      'end_time'   => ['nullable', 'date_format:H:i', 'after:start_time'],

      'join_start' => ['required', 'date'],
      'join_end'   => ['required', 'date', 'after_or_equal:join_start'],

      'fee' => ['required', 'numeric', 'min:0'],
      'payment_type' => ['required', 'in:course,monthly'],
      'is_final_only' => ['boolean'],
    ];
  }

  protected function hasOverlap(string $column, $value): bool
  {
    if (!$value) return false;

    $courseId = $this->route('course_offering');

    return CourseOffering::where($column, $value)
      ->where('schedule', $this->schedule)
      ->where('time_slot', $this->time_slot)
      ->whereNull('deleted_at')
      ->when($courseId, fn($q) => $q->where('id', '!=', $courseId))
      ->where(function ($q) {
        $q->whereBetween('join_start', [$this->join_start, $this->join_end])
          ->orWhereBetween('join_end', [$this->join_start, $this->join_end])
          ->orWhere(function ($q) {
            $q->where('join_start', '<=', $this->join_start)
              ->where('join_end', '>=', $this->join_end);
          });
      })
      ->exists();
  }

  protected function prepareForValidation()
  {
    $this->merge([
      'is_final_only' => $this->boolean('is_final_only'),
    ]);
  }
}
