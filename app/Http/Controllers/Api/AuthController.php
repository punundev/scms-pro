<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    try {
      $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
      ]);

      if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
          'status'  => false,
          'message' => 'Invalid email or password',
        ], 401);
      }

      $user = Auth::user();


      $token = $user->createToken('api-token')->plainTextToken;

      return response()->json([
        'status'  => true,
        'message' => 'Login successful',
        'token'   => $token,
        'user'    => [
          'id'          => $user->id,
          'name'        => $user->name,
          'email'       => $user->email,
          'phone'       => $user->phone,
          'avatar_url'  => $user->avatar_url,
        ]
      ], 200);
    } catch (ValidationException $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Validation failed',
        'errors'  => $e->errors(),
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Something went wrong while trying to login',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }


  public function logout(Request $request)
  {
    try {
      $request->user()->currentAccessToken()->delete();

      return response()->json([
        'status'  => true,
        'message' => 'Logged out successfully'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Something went wrong while logging out',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }

  public function profile(Request $request)
  {
    try {
      $user = $request->user()->load([
        'notifications',
        'unreadNotifications',
        'readNotifications',
        'fees.feeType',
        'scores.exam.courseOffering.subject',
        'attendances.courseOffering.subject',
        'teachingCourses.subject',
        'teachingCourses.classroom',
        'teachingCourses.exams',
        'teachingCourses.students',
        'enrollments.courseOffering.subject',
        'enrollments.courseOffering.teacher',
        'enrollments.courseOffering.classroom',
        'enrollments.courseOffering.exams',
      ]);

      return response()->json([
        'status' => true,
        'user'   => $user
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Failed to load user profile',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }


  public function changePassword(Request $request)
  {
    try {
      $request->validate([
        'current_password' => 'required|string|min:6',
        'new_password'     => 'required|string|min:6|confirmed',
      ]);

      $user = $request->user();

      if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
          'status'  => false,
          'message' => 'Current password is incorrect',
        ], 403);
      }

      $user->password = Hash::make($request->new_password);
      $user->save();

      return response()->json([
        'status'  => true,
        'message' => 'Password changed successfully',
      ], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Validation failed',
        'errors'  => $e->errors(),
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Something went wrong while changing password',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }


  public function changeAvatar(Request $request)
  {
    $request->validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
    ]);

    try {
      $user = $request->user();

      $avatarPath = public_path('uploads/avatars');
      if (!file_exists($avatarPath)) {
        mkdir($avatarPath, 0755, true);
      }

      $validatedData['avatar'] = $user->avatar;

      if ($request->hasFile('avatar')) {
        $manager = new ImageManager(new Driver());
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . date('d-m-Y') . '_user_avatar.' . $avatar->getClientOriginalExtension();

        $image = $manager->read($avatar);
        $image->resize(640, 640);
        $image->save($avatarPath . '/' . $avatarName);

        if ($user->avatar && file_exists(public_path($user->avatar))) {
          unlink(public_path($user->avatar));
        }

        $validatedData['avatar'] = 'uploads/avatars/' . $avatarName;
      }

      $user->avatar = $validatedData['avatar'];
      $user->save();

      return response()->json([
        'status'  => true,
        'message' => 'Avatar updated successfully!',
        'avatar_url' => asset($user->avatar),
      ], 200);
    } catch (\Exception $e) {
      Log::error('Error updating avatar: ' . $e->getMessage());

      return response()->json([
        'status'  => false,
        'message' => 'Error updating avatar',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }
}
