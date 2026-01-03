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

$resourceDir = __DIR__ . '/app/Http/Resources';

if (!is_dir($resourceDir)) {
  mkdir($resourceDir, 0755, true);
}

foreach ($tables as $table) {
  $className = Str::studly(Str::singular($table)) . 'Resource';
  $modelName = Str::studly(Str::singular($table));
  $filePath = $resourceDir . '/' . $className . '.php';

  $content = <<<PHP
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class $className extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \\Illuminate\Http\Request  \$request
     * @return array
     */
    public function toArray(\$request): array
    {
        return parent::toArray(\$request);
    }
}
PHP;

  file_put_contents($filePath, $content);
  echo "Created $className\n";
}
