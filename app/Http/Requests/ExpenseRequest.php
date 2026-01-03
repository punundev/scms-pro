<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseRequest extends FormRequest
{
  public function authorize(): bool
  {
    return Auth::check();
  }

  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'description' => ['nullable', 'string', 'max:1000'],
      'amount' => ['required', 'numeric', 'min:0.01'],
      'date' => ['required', 'date'],
      'expense_category_id' => ['required', 'exists:expense_categories,id'],
      'approved_by' => ['nullable', 'exists:users,id'],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'amount' => str_replace(',', '', $this->input('amount')),
    ]);
  }
}
