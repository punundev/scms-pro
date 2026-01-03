<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
  public function run(): void
  {
    $categories = ['Maintenance', 'Utilities', 'Events', 'Supplies'];
    foreach ($categories as $cat) {
      DB::table('expense_categories')->updateOrInsert(
        ['name' => $cat],
        ['description' => $cat . ' expenses', 'created_at' => now(), 'updated_at' => now()]
      );
    }
  }
}
