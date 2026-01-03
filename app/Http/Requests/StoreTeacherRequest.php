<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher');
        return [
            // Personal Information
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->$teacherId),
            ],
            'phone' => ['required', 'regex:/^(?:\+855|0)\s?(?:\d{2,3})(?:\s?\d{3})(?:\s?\d{3})$/', 'max:20'],
            'gender' => ['required', 'in:male,female,other'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            // Professional Information
            // 'department_id' => ['required', 'exists:departments,id'],
            'joining_date' => ['required', 'date'],
            'qualification' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'integer', 'min:0', 'max:60'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'salary' => [
                'nullable',
                'numeric',        // must be a number
                'min:0',          // minimum 
                'regex:/^\d{1,8}(\.\d{1,2})?$/'
            ],
            'address' => ['required', 'string', 'max:500'],
            // Files
            'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'cv' => ['sometimes', 'nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The teacher name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.required' => 'Phone number is required.',
            'gender.required' => 'Please select gender.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before_or_equal' => 'Date of birth cannot be in the future.',
            // 'department_id.required' => 'Please select a department.',
            // 'department_id.exists' => 'The selected department is invalid.',
            'joining_date.required' => 'Joining date is required.',
            'qualification.required' => 'Qualification is required.',
            'experience.required' => 'Experience is required.',
            'experience.integer' => 'Experience must be a whole number.',
            'experience.min' => 'Experience cannot be negative.',
            'experience.max' => 'Experience seems too high.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
            'address.required' => 'Address is required.',
            'avatar.image' => 'The avatar must be a valid image.',
            'avatar.mimes' => 'The avatar must be a JPEG, PNG, JPG, GIF, or WEBP image.',
            'avatar.max' => 'The avatar must not exceed 2MB.',
            'cv.file' => 'The CV must be a valid file.',
            'cv.mimes' => 'The CV must be a PDF, DOC, or DOCX file.',
            'cv.max' => 'The CV must not exceed 5MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'full name',
            'email' => 'email address',
            'phone' => 'phone number',
            'date_of_birth' => 'date of birth',
            // 'department_id' => 'department',
            'joining_date' => 'joining date',
        ];
    }
}
