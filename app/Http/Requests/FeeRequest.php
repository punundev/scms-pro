<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Enrollment;
use App\Models\User;


class FeeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  // public function rules(): array
  // {
  //   return [
  //     'student_id' => 'required|exists:users,id',
  //     'fee_type_id' => 'required|exists:fee_types,id',
  //     'enrollment_id' => 'required|exists:enrollments,id',
  //     'amount' => 'required|numeric|min:0',
  //     'due_date' => 'nullable|date',
  //     'payment_date' => 'nullable|date',
  //     'payment_method' => 'nullable|string|max:100',
  //     'transaction_id' => 'nullable|string|max:255',
  //     'received_by' => 'nullable|exists:users,id',
  //     'remarks' => 'nullable|string',
  //   ];
  // }

  public function rules(): array
  {
    $feeId = $this->route('fee'); // null on create

    return [
      'student_id' => [
        'required',
        'exists:users,id',

        // student must match enrollment
        function ($attr, $value, $fail) {
          if (!$this->enrollment_id) return;

          $enrollment = Enrollment::find($this->enrollment_id);

          if ($enrollment && $enrollment->student_id != $value) {
            $fail('Student does not match the enrollment.');
          }
        },
      ],

      'enrollment_id' => ['required', 'exists:enrollments,id'],

      'fee_type_id' => [
        'required',
        'exists:fee_types,id',

        // prevent duplicate fee type per enrollment
        Rule::unique('fees')
          ->ignore($feeId)
          ->where(
            fn($q) => $q
              ->where('enrollment_id', $this->enrollment_id)
              ->whereNull('deleted_at')
          ),
      ],

      'amount' => ['required', 'numeric', 'min:0'],

      'due_date' => ['nullable', 'date'],
      'payment_date' => ['nullable', 'date', 'after_or_equal:due_date'],

      'payment_method' => ['nullable', 'string', 'max:100'],
      'transaction_id' => ['nullable', 'string', 'max:255'],

      'received_by' => [
        'nullable',
        'exists:users,id',

        // optional role check
        function ($attr, $value, $fail) {
          $user = User::find($value);
          if ($user && !$user->hasAnyRole(['admin', 'staff', 'cashier'])) {
            $fail('Receiver must be an authorized staff member.');
          }
        },
      ],

      'remarks' => ['nullable', 'string'],
    ];
  }



  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'fee_type_id.required' => 'Fee type is required.',
      'enrollment_id.required' => 'Enrollment is required.',
      'amount.required' => 'Amount is required.',
      'fee_type_id.unique' => 'This fee type already exists for this enrollment.',
      'payment_date.after_or_equal' => 'Payment date cannot be before due date.',
    ];
  }
}
