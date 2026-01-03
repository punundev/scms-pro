<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $studentId = $this->route('student') ? $this->route('student')->id : null;

    $rules = [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($studentId)],

      'password' => ['nullable', 'string', 'min:8', 'confirmed'],

      'phone' => ['nullable', 'string', 'max:20'],
      'address' => ['nullable', 'string', 'max:500'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', 'string', Rule::in(['male', 'female', 'other'])],
      'admission_date' => ['nullable', 'date'],
      'nationality' => ['nullable', 'string', 'max:50'],
      'religion' => ['nullable', 'string', 'max:50'],
      'occupation' => ['nullable', 'string', 'max:100'],
      'company' => ['nullable', 'string', 'max:100'],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
    ];


    return $rules;
  }
}
