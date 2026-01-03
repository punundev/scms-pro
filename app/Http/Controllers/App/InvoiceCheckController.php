<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;

class InvoiceCheckController extends Controller
{
  public function show(string $transactionId)
  {
    $fee = Fee::where('transaction_id', $transactionId)
      ->firstOrFail();

    $fee->load([
      'student',
      'feeType',
      'creator',
      'receiver',
      'enrollment.courseOffering.subject',
      'enrollment.courseOffering.teacher'
    ]);

    return view('app.invoice', compact('fee'));
  }
}
