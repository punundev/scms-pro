<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
  public function run(): void
  {
    $categoryIds = DB::table('expense_categories')->pluck('id')->toArray();
    $userIds = DB::table('users')->pluck('id')->toArray();
    $expenses = [];

    for ($i = 0; $i < 20; $i++) {
      $expenses[] = [
        'title' => "Expense {$i}",
        'description' => "Description for expense {$i}",
        'amount' => rand(50, 500),
        'date' => now()->subDays(rand(0, 30)),
        'expense_category_id' => $categoryIds[array_rand($categoryIds)],
        'approved_by' => $userIds[array_rand($userIds)],
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('expenses')->insert($expenses);
  }
}
