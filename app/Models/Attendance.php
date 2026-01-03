<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'course_offering_id',
    'date',
    'status',
    'remarks'
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }
}
