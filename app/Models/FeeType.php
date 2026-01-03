<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeType extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'description'
  ];

  public function fees()
  {
    return $this->hasMany(Fee::class);
  }
}
