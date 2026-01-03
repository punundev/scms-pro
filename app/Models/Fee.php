<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'created_by',
    'fee_type_id',
    'enrollment_id',
    'amount',
    'payment_date',
    'payment_method',
    'transaction_id',
    'received_by',
    'remarks',
    'due_date',
    'remarks'
  ];

  protected $casts = [
    'due_date' => 'date',
    'payment_date' => 'datetime',
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function feeType()
  {
    return $this->belongsTo(FeeType::class);
  }

  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function enrollment()
  {
    return $this->belongsTo(Enrollment::class, 'enrollment_id');
  }

  public function receiver()
  {
    return $this->belongsTo(User::class, 'received_by');
  }

  public function getStatusAttribute()
  {
    return $this->payment_date ? 'paid' : 'unpaid';
  }
}
