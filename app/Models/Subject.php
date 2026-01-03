<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'code',
    'description',
    'credit_hours'
  ];

  protected $casts = [
    'credit_hours' => 'integer',
  ];

  public function students()
  {
    return $this->belongsToMany(User::class, 'enrollments');
  }

  public function exams()
  {
    return $this->hasMany(Exam::class);
  }

  public function scores()
  {
    return $this->hasMany(Score::class);
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }
}