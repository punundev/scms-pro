<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasApiTokens;
  use HasRoles, SoftDeletes;

  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'address',
    'date_of_birth',
    'gender',
    'joining_date',
    'qualification',
    'experience',
    'specialization',
    'salary',
    'cv',
    'nationality',
    'religion',
    'admission_date',
    'occupation',
    'company',
    'avatar'
  ];


  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'date_of_birth' => 'date',
      'joining_date' => 'date',
      'admission_date' => 'date',
    ];
  }

  public function fees()
  {
    return $this->hasMany(Fee::class, 'student_id');
  }

  public function attendances()
  {
    return $this->hasMany(Attendance::class, 'student_id');
  }

  public function scores()
  {
    return $this->hasMany(Score::class, 'student_id');
  }

  public function approvedExpenses()
  {
    return $this->hasMany(Expense::class, 'approved_by');
  }

  public function receivedPayments()
  {
    return $this->hasMany(Fee::class, 'received_by');
  }

  public function scopeTeachers($query)
  {
    return $query->role('teacher');
  }

  public function teachingCourses()
  {
    return $this->hasMany(\App\Models\CourseOffering::class, 'teacher_id');
  }

  public function enrollments()
  {
    return $this->hasMany(Enrollment::class, 'student_id');
  }

  public function notifications()
  {
    return $this->morphMany(DatabaseNotification::class, 'notifiable')
      ->orderBy('created_at', 'desc');
  }


  public function courseOfferings()
  {
    return $this->hasManyThrough(
      CourseOffering::class,
      Enrollment::class,
      'student_id',
      'id',
      'id',
      'course_offering_id'
    );
  }

  public function getAvatarUrlAttribute()
  {
    return $this->avatar
      ? asset($this->avatar)
      : asset('assets/images/cambodia.png');
  }
}
