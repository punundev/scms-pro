<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $userId = $this->route('user') ? $this->route('user')->id : null;

    $rules = [
      'name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('users', 'email')->ignore($userId),
      ],
      'type' => ['required', 'array'],
      'type.*' => ['required', 'string', Rule::exists('roles', 'name')],

      'phone' => ['nullable', 'string', 'max:255'],
      'address' => ['nullable', 'string'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
      'nationality' => ['nullable', 'string', 'max:255'],
      'religion' => ['nullable', 'string', 'max:255'],
      'joining_date' => ['nullable', 'date'],
      'qualification' => ['nullable', 'string', 'max:255'],
      'experience' => ['nullable', 'numeric', 'min:0'],
      'specialization' => ['nullable', 'string', 'max:255'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
      'admission_date' => ['nullable', 'date'],
      'occupation' => ['nullable', 'string', 'max:255'],
      'company' => ['nullable', 'string', 'max:255'],
    ];

    if ($this->isMethod('POST')) {
      $rules['password'] = ['required', 'string', 'min:8'];
    } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
      $rules['password'] = ['nullable', 'string', 'min:8'];
    }

    return $rules;
  }

  public function messages(): array
  {
    return [
      'type.required' => 'The user role(s) are required.',
      'type.array' => 'The user role(s) must be provided as a list.',
      'type.*.exists' => 'One or more selected roles are invalid.',
      'avatar.max' => 'The avatar image must not be greater than 2MB.',
      'cv.max' => 'The CV file must not be greater than 5MB.',
    ];
  }
}
