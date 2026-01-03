<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  // public function rules()
  // {
  //   return [
  //     'type' => [
  //       'required',
  //       'string',
  //       Rule::in([
  //         'midterm',
  //         'final',
  //         'speaking',
  //         'listening',
  //         'reading',
  //         'writing',
  //       ]),
  //     ],
  //     'description' => ['nullable', 'string'],
  //     'course_offering_id' => [
  //       'required',
  //       'integer',
  //       Rule::exists('course_offerings', 'id'),
  //     ],
  //     'date' => ['required', 'date'],
  //     'total_marks' => ['required', 'integer', 'min:1'],
  //     'passing_marks' => ['required', 'integer', 'min:0', 'lte:total_marks'],
  //   ];
  // }

  public function rules()
  {
    $examId = $this->route('exam'); // null on create

    return [
      'type' => [
        'required',
        Rule::in([
          'midterm',
          'final',
          'speaking',
          'listening',
          'reading',
          'writing',
        ]),

        // prevent duplicate exam type per course
        Rule::unique('exams')
          ->ignore($examId)
          ->where(
            fn($q) => $q
              ->where('course_offering_id', $this->course_offering_id)
              ->whereNull('deleted_at')
          ),
      ],

      'course_offering_id' => [
        'required',
        'exists:course_offerings,id',
      ],

      'description' => ['nullable', 'string'],
      'date' => ['required', 'date'],
      'total_marks' => ['required', 'integer', 'min:1'],
      'passing_marks' => ['required', 'integer', 'min:0', 'lte:total_marks'],
    ];
  }

  public function messages()
  {
    return [
      'type.unique' => 'This exam type already exists for this course.',
      'type.in' => 'Invalid exam type.',
    ];
  }
}
