<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      // Personal Information
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'phone' => ['required', 'string', 'max:20'],
      'gender' => ['required', 'in:male,female,other'],
      'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
      'admission_date' => ['required', 'date'],

      // Contact Information
      'address' => ['required', 'string', 'max:500'],
      'nationality' => ['nullable', 'string', 'max:100'],
      'religion' => ['nullable', 'string', 'max:100'],

      // Medical Information

      // Profile Image
      'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'The student name is required.',
      'email.required' => 'Email address is required.',
      'email.email' => 'Please enter a valid email address.',
      'email.unique' => 'This email is already registered.',
      'phone.required' => 'Phone number is required.',
      'phone.regex' => 'Please enter a valid phone number.',
      'gender.required' => 'Please select gender.',
      'date_of_birth.required' => 'Date of birth is required.',
      'date_of_birth.before_or_equal' => 'Date of birth cannot be in the future.',
      'admission_date.required' => 'Admission date is required.',
      'address.required' => 'Address is required.',
      'avatar.image' => 'The avatar must be a valid image.',
      'avatar.mimes' => 'The avatar must be a JPEG, PNG, JPG, GIF, or WEBP image.',
      'avatar.max' => 'The avatar must not exceed 2MB.',
    ];
  }

  public function attributes(): array
  {
    return [
      'name' => 'full name',
      'email' => 'email address',
      'phone' => 'phone number',
      'date_of_birth' => 'date of birth',
      'admission_date' => 'admission date',
    ];
  }
}
