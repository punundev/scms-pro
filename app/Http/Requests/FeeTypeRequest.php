<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeTypeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255|unique:fee_types,name,' . $this->route('fee_type'),
      'description' => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Fee type name is required.',
      'name.unique' => 'This fee type already exists.',
    ];
  }
}
