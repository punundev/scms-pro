<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $studentId = $this->route('student')->id;

    return [
      'name' => 'required|string|max:255',
      'email' => ['required', 'email', Rule::unique('users')->ignore($studentId)],
      'phone' => 'required|string|max:20',
      'gender' => 'required|in:male,female,other',
      'date_of_birth' => 'required|date',
      'address' => 'nullable|string',
      'nationality' => 'nullable|string|max:100',
      'religion' => 'nullable|string|max:100',
      'admission_date' => 'required|date',
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
  }
}
