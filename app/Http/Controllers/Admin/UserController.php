<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'User';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 6);
    $roleFilter = $request->input('role_filter');

    $roles = Role::all();


    $users = User::with(['roles'])
      ->when($search, function ($query) use ($search) {
        return $query->where(function ($q) use ($search) {
          $q->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere(
              'phone',
              'like',
              "%{$search}%"
            );
        });
      })
      ->when($roleFilter, function ($query) use ($roleFilter) {
        return $query->role($roleFilter);
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
        'role_filter' => $roleFilter,
      ]);


    return view('admin.users.index', compact('users', 'roles', 'roleFilter',));
  }

  public function create()
  {
    $roles = Role::all();
    return view('admin.users.create', compact('roles'));
  }

  public function store(UserRequest $request)
  {
    $validatedData = $request->validated();
    $roles = $validatedData['type'];

    try {
      $avatarPath = public_path('uploads/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      $validatedData['avatar'] = null;
      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $validatedData['avatar'] = 'uploads/avatars/' . $avatarName;
      }

      $user = User::create(array_merge($validatedData, [
        'password' => Hash::make($validatedData['password']),
        'avatar' => $validatedData['avatar'],
      ]));

      $user->assignRole($roles);

      return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating user: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error creating user: ' . $e->getMessage());
    }
  }

  public function show(User $user)
  {
    $user->load([
      'roles',

      'courseOfferings.subject',
      'fees.feeType',
      'scores.exam',
      'attendances.courseOffering.subject',

      'teachingCourses.subject',
      'teachingCourses.students',
    ]);

    $user->loadCount([
      'fees',
      'attendances',
      'courseOfferings',
      'teachingCourses',
      'approvedExpenses',
    ]);

    $allRoles = Role::all();

    $taughtStudentsCount = 0;
    if ($user->hasRole('teacher')) {
      $studentIds = collect();

      foreach ($user->teachingCourses as $courseOffering) {
        $courseOffering->students->pluck('id')->each(function ($id) use ($studentIds) {
          $studentIds->push($id);
        });
      }
      $taughtStudentsCount = $studentIds->unique()->count();
    }

    return view('admin.users.show', compact('user', 'taughtStudentsCount', 'allRoles'));
  }

  public function edit(User $user)
  {
    $user->load('roles');
    $roles = Role::all();
    return view('admin.users.edit', compact('user', 'roles'));
  }

  public function update(UserRequest $request, User $user)
  {
    $validatedData = $request->validated();
    $roles = $validatedData['type'];

    try {
      $data = $request->only([
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'nationality',
        'religion',
        'joining_date',
        'qualification',
        'experience',
        'specialization',
        'salary',
        'admission_date',
        'occupation',
        'company',
      ]);
      if ($request->hasFile('avatar')) {
        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
        }

        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();
        $avatarPath = public_path('uploads/avatars');

        if (!file_exists($avatarPath)) {
          mkdir($avatarPath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        $data['avatar'] = 'uploads/avatars/' . $avatarName;
      } elseif ($request->input('clear_avatar')) {
        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
        }
        $data['avatar'] = null;
      }

      if ($request->filled('password')) {
        $data['password'] = Hash::make($validatedData['password']);
      }

      $user->update($data);
      $user->syncRoles($roles);
      if ($user->student && ($validatedData['type'] === 'student')) {
        $studentData = [
          'name' => $user->name,
          'email' => $user->email,
          'phone' => $user->phone,
          'gender' => $user->gender,
          'dob' => $user->date_of_birth,
          'photo' => $user->avatar,
        ];
        if (isset($data['avatar'])) {
          $studentData['photo'] = $data['avatar'];
        }
        if ($user->student) {
          $user->student->update($studentData);
        }
      }

      return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    } catch (\Exception $e) {
      Log::error('Error updating user: ' . $e->getMessage());
      return back()->withInput()->with('error', 'Error updating user: ' . $e->getMessage());
    }
  }

  public function changePassword(Request $request, User $user)
  {
    $request->validate([
      'password' => ['required', 'string', 'min:8'],
    ]);

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()
      ->with('success', 'Password for ' . $user->name .  ' has been successfully changed to: ' . $request->password);
  }

  public function changeRole(Request $request, User $user)
  {
    $request->validate([
      'role_names' => ['required', 'array'],
      'role_names.*' => ['required', 'string', 'exists:roles,name'],
    ]);

    $newRoles = $request->role_names;

    $user->syncRoles($newRoles);

    $roleList = implode(', ', array_map('ucfirst', $newRoles));

    return redirect()->back()
      ->with('success', $user->name . ' roles successfully changed to: ' . $roleList);
  }
  public function destroy(User $user)
  {
    try {
      if (Auth::id() === $user->id) {
        return response()->json([
          'success' => false,
          'message' => 'You cannot delete your own account!'
        ], 403);
      }


      if (!$user) {
        return response()->json([
          'success' => false,
          'message' => 'User not found'
        ], 404);
      }
      if ($user->avatar && file_exists(public_path($user->avatar))) {
        unlink(public_path($user->avatar));
      }

      if ($user->cv && file_exists(public_path($user->cv))) {
        unlink(public_path($user->cv));
      }

      $user->delete();

      return response()->json([
        'success' => true,
        'message' => 'User deleted successfully!'
      ]);
    } catch (\Exception $e) {
      Log::error('Error deleting user: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Error deleting user: ' . $e->getMessage()
      ], 500);
    }
  }
}