<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
  public function run(): void
  {
    $students = User::role('student')->pluck('id')->toArray();
    $feeTypeIds = DB::table('fee_types')->pluck('id')->toArray();
    $fees = [];

    foreach ($students as $student) {
      foreach ($feeTypeIds as $typeId) {
        $fees[] = [
          'student_id' => $student,
          'fee_type_id' => $typeId,
          'amount' => rand(100, 1000),
          'due_date' => now()->addMonth(),
          'status' => 'unpaid',
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    DB::table('fees')->upsert($fees, ['student_id', 'fee_type_id']);
  }
}
