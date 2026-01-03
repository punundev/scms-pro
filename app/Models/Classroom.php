<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
  use SoftDeletes;

  protected $fillable = ['name', 'room_number', 'capacity'];

  public function attendances()
  {
    return $this->hasMany(Attendance::class);
  }
}
