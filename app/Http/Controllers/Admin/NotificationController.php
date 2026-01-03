<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\CourseOffering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class NotificationController extends Controller
{
  public function index()
  {
    $notifications = Auth::user()->notifications()->paginate(15);

    return view('admin.notifications.index', compact('notifications'));
  }

  public function markAllAsRead()
  {
    Auth::user()->unreadNotifications->markAsRead();

    return back()->with('success', 'All notifications marked as read.');
  }

  public function markAsRead(string $id)
  {
    $notification = Auth::user()->unreadNotifications()->find($id);

    if ($notification) {
      $notification->markAsRead();
      return back()->with('status', 'Notification marked as read.');
    }

    return back();
  }

  public function create(Request $request)
  {
    $role = $request->role;
    $courseOfferingId = $request->course_offering_id;

    $users = User::query();

    if ($role) {
      $users->role($role);
    }

    if ($role === "student" && $courseOfferingId) {
      $users->whereHas('enrollments', function ($q) use ($courseOfferingId) {
        $q->where('course_offering_id', $courseOfferingId);
      });
    }

    // dd($users->with('roles')->get());

    return view('admin.notifications.create', [
      'users' => $users->with('roles')->get(),
      'roles' => ['admin', 'teacher', 'staff', 'student'],
      'courseOfferings' => CourseOffering::with('subject')->get(),
      'selectedRole' => $role,
      'selectedCourseOffering' => $courseOfferingId
    ]);
  }

  public function send(Request $request)
  {
    $request->validate([
      'user_ids' => 'required|array',
      'title' => 'required|string|max:255',
      'body' => 'required|string'
    ]);

    $users = User::whereIn('id', $request->user_ids)->get();

    foreach ($users as $user) {
      $user->notify(new \App\Notifications\CustomNotification(
        $request->title,
        $request->body
      ));
    }

    return back()->with('success', 'Notification sent successfully!');
  }
}
