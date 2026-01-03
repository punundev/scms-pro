<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'user_id' => 'nullable|exists:users,id',
      'ip_address' => 'nullable|ip',
      'user_agent' => 'nullable|string',
      'payload' => 'required|string',
      'last_activity' => 'required|integer',
    ];
  }
}
