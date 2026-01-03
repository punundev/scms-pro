<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseOfferingController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SubjectController;

Route::post('/v1/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])
  ->prefix('/v1')
  ->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change_password', [AuthController::class, 'changePassword']);
    Route::post('/change_avatar', [AuthController::class, 'changeAvatar']);
    Route::post('/send_notification', [NotificationController::class, 'sendToStaff']);

    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::get('/courses', [CourseOfferingController::class, 'index']);
  });
