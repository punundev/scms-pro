<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Role';
  }


  public function index()
  {
    $roles = Role::withCount('permissions')->paginate(10);
    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();
    return view('admin.roles.create', compact('permissions'));
  }

  public function store(RoleRequest $request)
  {
    $role = Role::create([
      'name' => $request->name,
      'guard_name' => 'web',
    ]);

    $permissions = Permission::whereIn('id', $request->permissions ?? [])->get();
    $role->syncPermissions($permissions);

    return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
  }




  public function edit(Role $role)
  {
    $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
  }

  public function update(Request $request, Role $role)
  {
    $request->validate([
      'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id'
    ]);

    $role->update([
      'name' => $request->name,
    ]);

    $permissions = Permission::whereIn('id', $request->permissions ?? [])->get();
    $role->syncPermissions($permissions);

    return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
  }

  public function destroy(Role $role)
  {
    $role->delete();

    return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
  }
}
