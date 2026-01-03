<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetTokenRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'email' => 'required|email|exists:users,email',
      'token' => 'required|string',
    ];
  }

  public function messages(): array
  {
    return [
      'email.required' => 'Email is required.',
      'email.email' => 'Email must be valid.',
      'email.exists' => 'Email does not exist in our records.',
      'token.required' => 'Token is required.',
    ];
  }
}
