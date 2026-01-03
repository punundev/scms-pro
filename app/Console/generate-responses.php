<?php

use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';

$tables = [
  'classrooms',
  'departments',
  'users',
  'password_reset_tokens',
  'sessions',
  'subjects',
  'student_course',
  'expense_categories',
  'expenses',
  'attendances',
  'exams',
  'fee_types',
  'fees',
  'payments',
  'scores',
  'teacher_subject',
  'schedules',
];

$responseDir = __DIR__ . '/app/Http/Responses';

if (!is_dir($responseDir)) {
  mkdir($responseDir, 0755, true);
}

foreach ($tables as $table) {
  $className = Str::studly(Str::singular($table)) . 'Response';
  $filePath = $responseDir . '/' . $className . '.php';

  $content = <<<PHP
<?php

namespace App\Http\Responses;

class $className
{
    public static function success(\$data = null, string \$message = null): array
    {
        return [
            'success' => true,
            'message' => \$message ?? '{$className} operation successful',
            'data' => \$data,
        ];
    }

    public static function error(string \$message = null, \$data = null): array
    {
        return [
            'success' => false,
            'message' => \$message ?? '{$className} operation failed',
            'data' => \$data,
        ];
    }
}
PHP;

  file_put_contents($filePath, $content);
  echo "Created $className\n";
}
