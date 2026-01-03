<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseCategoryRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255|unique:expense_categories,name,' . $this->route('expense_category'),
      'description' => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Expense category name is required.',
      'name.unique' => 'This category already exists.',
    ];
  }
}
