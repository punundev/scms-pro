<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\CustomNotification;

class NotificationController extends Controller
{
  public function sendToStaff(Request $request)
  {
    $request->validate([
      'user_id' => 'required|exists:users,id',
      'title'   => 'required|string|max:255',
      'body'    => 'required|string',
    ]);

    $student = $request->user();

    if (!$student) {
      return response()->json([
        'message' => 'Unauthenticated. Please login first.'
      ], 401);
    }

    if (!$student->hasRole('student')) {
      return response()->json([
        'message' => 'Only students can send notifications.',
        'user_role' => $student->getRoleNames(), // returns collection
      ], 403);
    }

    $recipient = User::where('id', $request->user_id)
      ->role(['teacher', 'staff'])
      ->first();

    if (!$recipient) {
      return response()->json([
        'message' => 'Recipient must be a teacher or staff.'
      ], 404);
    }

    $recipient->notify(new CustomNotification($request->title, $request->body));

    return response()->json([
      'message' => 'Notification sent successfully!',
      'recipient_id' => $recipient->id
    ]);
  }
}
