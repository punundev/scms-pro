<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      UserSeeder::class,
      CourseDataSeeder::class,
      // SubjectSeeder::class,
      // CourseOfferingSeeder::class,
      // StudentCourseSeeder::class,
      // FeeTypeSeeder::class,
      // FeeSeeder::class,
      // ExamSeeder::class,
      // ExpenseCategorySeeder::class,
      // ExpenseSeeder::class,
    ]);
  }
}
