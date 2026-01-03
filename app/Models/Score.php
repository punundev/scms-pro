<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'exam_id',
    'score',
    'grade',
    'remarks',
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }
}
