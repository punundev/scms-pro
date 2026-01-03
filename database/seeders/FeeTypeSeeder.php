<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeTypeSeeder extends Seeder
{
  public function run(): void
  {
    $types = ['Tuition', 'Library', 'Lab', 'Sports'];
    foreach ($types as $name) {
      DB::table('fee_types')->updateOrInsert(
        ['name' => $name],
        ['description' => $name . ' fee', 'created_at' => now(), 'updated_at' => now()]
      );
    }
  }
}
