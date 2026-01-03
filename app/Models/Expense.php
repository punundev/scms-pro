<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'title',
    'description',
    'amount',
    'date',
    'expense_category_id',
    'approved_by',
    'created_by',
  ];

  public function category()
  {
    return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
  }

  public function approver()
  {
    return $this->belongsTo(User::class, 'approved_by');
  }

  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }
}
