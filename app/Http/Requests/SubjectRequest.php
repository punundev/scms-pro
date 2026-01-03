<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'code' => [
        'required',
        'string',
        'max:50',
        Rule::unique('subjects', 'code')->ignore($this->subject?->id),
      ],
      'department_id' => 'nullable|exists:departments,id',
      'description' => 'nullable|string',
      'credit_hours' => 'required|integer|min:1',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Subject name is required.',
      'code.required' => 'Subject code is required.',
      'code.unique' => 'This subject code already exists.',
      'credit_hours.required' => 'Credit hours are required.',
      'credit_hours.integer' => 'Credit hours must be an integer.',
      'credit_hours.min' => 'Credit hours must be at least 1.',
    ];
  }
}
