<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Exam;
use App\Models\Enrollment;
use App\Models\User;



class ScoreRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $scoreId = $this->route('score'); // null on create

    return [
      'student_id' => [
        'required',
        'exists:users,id',

        // must be student
        function ($attr, $value, $fail) {
          $user = User::find($value);
          if (!$user || !$user->hasRole('student')) {
            $fail('Only students can receive scores.');
          }
        },

        // prevent duplicate score
        Rule::unique('scores')
          ->ignore($scoreId)
          ->where(
            fn($q) => $q
              ->where('exam_id', $this->exam_id)
              ->whereNull('deleted_at')
          ),
      ],

      'exam_id' => [
        'required',
        'exists:exams,id',

        // student must be enrolled in exam's course
        function ($attr, $value, $fail) {
          if (!$this->student_id) return;

          $exam = Exam::find($value);
          if (!$exam) return;

          $enrolled = Enrollment::where('student_id', $this->student_id)
            ->where('course_offering_id', $exam->course_offering_id)
            ->exists();

          if (!$enrolled) {
            $fail('Student is not enrolled in this course.');
          }
        },
      ],

      'score' => [
        'required',
        'integer',
        'min:0',

        // score <= total_marks
        function ($attr, $value, $fail) {
          if (!$this->exam_id) return;

          $exam = Exam::find($this->exam_id);
          if ($exam && $value > $exam->total_marks) {
            $fail('Score cannot exceed total marks.');
          }
        },
      ],

      'grade' => ['nullable', 'string', 'max:5'],
      'remarks' => ['nullable', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.unique' => 'This student already has a score for this exam.',
      'score.min' => 'Score cannot be negative.',
    ];
  }
}
