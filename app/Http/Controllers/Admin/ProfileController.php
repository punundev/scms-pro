<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

  public function show(Request $request)
  {
    $user = User::with([
      'roles',

      'courseOfferings.subject',
      'fees.feeType',
      'scores.exam',
      'attendances.courseOffering.subject',
      'teachingCourses.subject',
      'teachingCourses.enrollments',
    ])
      ->withCount([
        'fees',
        'attendances',
        'courseOfferings',
        'teachingCourses',
        'approvedExpenses',
      ])
      ->find(Auth::id());

    $taughtStudentsCount = 0;
    if ($user->hasRole('teacher')) {
      $taughtStudentsCount = $user->teachingCourses
        ->flatMap(fn($course) => $course->students->pluck('id'))
        ->unique()
        ->count();
    }

    return view('admin.profile.show', [
      'user' => $user,
      'taughtStudentsCount' => $taughtStudentsCount,
    ]);
  }


  public function update(Request $request)
  {
    $user = Auth::user();

    $rules = [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'phone' => ['nullable', 'string', 'max:20'],
      'address' => ['nullable', 'string', 'max:500'],
      'date_of_birth' => ['nullable', 'date'],
      'gender' => ['required', Rule::in(['male', 'female'])],
      'avatar' => ['nullable', 'image', 'max:2048'],
      'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
      'joining_date' => ['nullable', 'date'],
      'qualification' => ['nullable', 'string', 'max:255'],
      'salary' => ['nullable', 'numeric', 'min:0'],
    ];

    $validatedData = $request->validate($rules);

    if ($request->hasFile('avatar')) {
      if ($user->avatar) {
        Storage::disk('public')->delete($user->avatar);
      }
      $validatedData['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    if ($request->hasFile('cv')) {
      if ($user->cv) {
        Storage::disk('public')->delete($user->cv);
      }
      $validatedData['cv'] = $request->file('cv')->store('cvs', 'public');
    }

    $user->fill($validatedData);
    $user->save();

    return redirect()->route('admin.profile.show')->with('status', 'Profile successfully updated!');
  }
}
