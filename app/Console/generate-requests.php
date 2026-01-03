<?php

use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';

$tables = [
  'classrooms' => ['name', 'room_number', 'capacity'],
  'departments' => ['name', 'description'],
  'users' => ['name', 'email', 'password', 'phone', 'address', 'date_of_birth', 'gender', 'department_id', 'joining_date', 'qualification', 'experience', 'specialization', 'salary', 'cv', 'blood_group', 'nationality', 'religion', 'admission_date', 'occupation', 'company', 'avatar'],
  'password_reset_tokens' => ['email', 'token'],
  'sessions' => ['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'],
  'subjects' => ['name', 'code', 'department_id', 'description', 'credit_hours'],
  'student_course' => ['student_id', 'subject_id', 'grade_final'],
  'expense_categories' => ['name', 'description'],
  'expenses' => ['title', 'description', 'amount', 'date', 'expense_category_id', 'approved_by'],
  'attendances' => ['student_id', 'classroom_id', 'subject_id', 'date', 'status', 'remarks'],
  'exams' => ['name', 'description', 'subject_id', 'date', 'total_marks', 'passing_marks'],
  'fee_types' => ['name', 'description'],
  'fees' => ['student_id', 'fee_type_id', 'amount', 'due_date', 'status', 'remarks'],
  'payments' => ['amount', 'payment_date', 'payment_method', 'transaction_id', 'remarks', 'received_by', 'student_id', 'fee_id'],
  'scores' => ['student_id', 'exam_id', 'subject_id', 'semester', 'score', 'grade', 'remarks'],
  'teacher_subject' => ['teacher_id', 'subject_id'],
  'schedules' => ['teacher_id', 'subject_id', 'classroom_id', 'weekday', 'start_time', 'end_time'],
];

$requestDir = __DIR__ . '/app/Http/Requests';

if (!is_dir($requestDir)) {
  mkdir($requestDir, 0755, true);
}

foreach ($tables as $table => $fields) {
  $className = Str::studly(Str::singular($table)) . 'Request';
  $filePath = $requestDir . '/' . $className . '.php';

  $rules = [];
  foreach ($fields as $field) {
    if (Str::endsWith($field, '_id')) {
      $rules[] = "            '$field' => 'required|exists:" . Str::plural(str_replace('_id', '', $field)) . ",id',";
    } elseif (in_array($field, ['email'])) {
      $rules[] = "            '$field' => 'required|email|unique:$table,$field,' . \$this->route('$table'),";
    } elseif (in_array($field, ['password'])) {
      $rules[] = "            '$field' => \$this->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',";
    } elseif (in_array($field, ['amount', 'salary', 'grade_final', 'score'])) {
      $rules[] = "            '$field' => 'nullable|numeric|min:0',";
    } elseif (in_array($field, ['date', 'due_date', 'joining_date', 'admission_date', 'payment_date', 'date_of_birth'])) {
      $rules[] = "            '$field' => 'nullable|date',";
    } else {
      $rules[] = "            '$field' => 'nullable|string|max:255',";
    }
  }

  $rulesString = implode("\n", $rules);

  $content = <<<PHP
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class $className extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
$rulesString
        ];
    }
}
PHP;

  file_put_contents($filePath, $content);
  echo "Created $className\n";
}
