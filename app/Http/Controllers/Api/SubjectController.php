<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
  public function index()
  {
    $subjects = Subject::all();

    return response()->json([
      'status'  => true,
      'message' => 'Successful',
      'subjects'   => $subjects,
    ], 200);
  }
}
