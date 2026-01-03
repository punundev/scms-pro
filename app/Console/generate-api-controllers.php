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

$controllerDir = __DIR__ . '/app/Http/Controllers/Api';

if (!is_dir($controllerDir)) {
  mkdir($controllerDir, 0755, true);
}

foreach ($tables as $table) {
  $modelName = Str::studly(Str::singular($table));
  $controllerName = $modelName . 'Controller';
  $requestName = $modelName . 'Request';
  $resourceName = $modelName . 'Resource';
  $filePath = $controllerDir . '/' . $controllerName . '.php';

  $content = <<<PHP
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\\$modelName;
use App\Http\Requests\\$requestName;
use App\Http\Resources\\$resourceName;
use Illuminate\Http\Request;

class $controllerName extends Controller
{
    public function index()
    {
        \$items = $modelName::all();
        return $resourceName::collection(\$items);
    }

    public function store($requestName \$request)
    {
        \$item = $modelName::create(\$request->validated());
        return new $resourceName(\$item);
    }

    public function show(\$id)
    {
        \$item = $modelName::findOrFail(\$id);
        return new $resourceName(\$item);
    }

    public function update($requestName \$request, \$id)
    {
        \$item = $modelName::findOrFail(\$id);
        \$item->update(\$request->validated());
        return new $resourceName(\$item);
    }

    public function destroy(\$id)
    {
        \$item = $modelName::findOrFail(\$id);
        \$item->delete();
        return response()->json(['message' => '$modelName deleted successfully']);
    }
}
PHP;

  file_put_contents($filePath, $content);
  echo "Created $controllerName\n";
}
