<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\CourseOffering;

class EnrollmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    // Get route parameters
    $studentId = $this->route('student_id');
    $courseOfferingId = $this->route('course_offering_id');

    return [
      'student_id' => [
        'required',
        'exists:users,id',
        function ($attr, $value, $fail) {
          $user = User::find($value);
          if (!$user || !$user->hasRole('student')) {
            $fail('Only students can enroll in a course.');
          }
        },
        // Unique rule considering student_id + course_offering_id
        Rule::unique('enrollments')
          ->where(fn($query) => $query->where('course_offering_id', $this->course_offering_id))
          ->ignore($studentId, 'student_id'), // ignore the current student
      ],

      'course_offering_id' => [
        'required',
        'exists:course_offerings,id',
        function ($attr, $value, $fail) {
          if (!$this->student_id) return;
          $course = CourseOffering::find($value);
          if ($course && $course->teacher_id == $this->student_id) {
            $fail('Teacher cannot enroll in their own course.');
          }
        },
      ],

      'status' => [
        'required',
        'in:studying,suspended,dropped,completed',
      ],

      'remarks' => ['nullable', 'string', 'max:500'],
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'student_id.exists' => 'Selected student does not exist.',
      'course_offering_id.required' => 'Course offering is required.',
      'course_offering_id.exists' => 'Selected course offering does not exist.',
      'status.required' => 'Status is required.',
      'status.in' => 'Invalid student status.',
      'remarks.max' => 'Remarks must not exceed 500 characters.',
      'student_id.unique' => 'This student is already enrolled in this course.',
    ];
  }
}
