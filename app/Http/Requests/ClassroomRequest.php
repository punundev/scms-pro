<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'room_number' => [
        'required',
        'string',
        'max:50',
        Rule::unique('classrooms', 'room_number')->ignore($this->classroom?->id),
      ],
      'capacity' => 'required|integer|min:1',
    ];
  }


  public function messages(): array
  {
    return [
      'name.required' => 'Classroom name is required.',
      'room_number.required' => 'Room number is required.',
      'room_number.unique' => 'This room number already exists.',
      'capacity.required' => 'Capacity is required.',
      'capacity.integer' => 'Capacity must be an integer.',
      'capacity.min' => 'Capacity must be at least 1.',
    ];
  }
}
