<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

abstract class BaseController extends Controller
{
  private string $model;

  public function __construct()
  {
    $this->model = $this->normalizeModel($this->ModelPermissionName());
  }


  abstract protected function ModelPermissionName(): string;

  protected function applyPermissions(): void
  {
    $model = Str::singular($this->model);

    $this->middleware("permission:view_$model")->only(['index', 'show']);
    $this->middleware("permission:create_$model")->only(['create', 'store']);
    $this->middleware("permission:update_$model")->only(['edit', 'update']);
    $this->middleware("permission:delete_$model")->only(['destroy']);
  }


  protected function normalizeModel(string $name): string
  {
    $name = preg_replace('/[^A-Za-z0-9]+/', ' ', $name);
    $name = Str::lower(trim($name));

    return Str::of($name)->replace(' ', '-');
  }
}
