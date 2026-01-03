<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseOffering extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'subject_id',
    'teacher_id',
    'classroom_id',
    'time_slot',
    'schedule',
    'start_time',
    'end_time',
    'join_start',
    'join_end',
    'fee',
    'payment_type',
    'is_final_only',
  ];


  protected $casts = [
    'join_start' => 'date',
    'join_end' => 'date',
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    'is_final_only' => 'boolean',
  ];


  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id');
  }

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function exams()
  {
    return $this->hasMany(Exam::class, 'course_offering_id');
  }
  public function attendances()
  {
    return $this->hasMany(Attendance::class, 'course_offering_id');
  }

  public function enrollments()
  {
    return $this->hasMany(Enrollment::class, 'course_offering_id');
  }

  public function scopeActive($query)
  {
    return $query->whereDate('join_end', '>=', \Carbon\Carbon::today());
  }

  public function students()
  {
    return $this->hasManyThrough(
      User::class,
      Enrollment::class,
      'course_offering_id',
      'id',
      'id',
      'student_id'
    );
  }
}
