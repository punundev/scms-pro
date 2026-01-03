<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseOffering;
use Illuminate\Http\Request;

class CourseOfferingController extends Controller
{
  public function index()
  {
    $offerings = CourseOffering::with([
      'subject',
      'teacher',
      'classroom'
    ])->latest()->get();

    return response()->json($offerings);
  }
}
