<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentCourseSeeder extends Seeder
{
  public function run(): void
  {
    $studentIds = User::role('student')->pluck('id')->toArray();
    $courseOfferingIds = DB::table('course_offerings')->pluck('id')->toArray();

    if (empty($courseOfferingIds)) {
      $this->command->warn('No course offerings found, skipping StudentCourseSeeder.');
      return;
    }

    $enrollments = [];

    foreach ($studentIds as $studentId) {
      $assignedSubjects = (array) array_rand(
        array_flip($courseOfferingIds),
        min(3, count($courseOfferingIds))
      );

      foreach ($assignedSubjects as $courseOfferingId) {
        $enrollments[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => round(rand(6000, 10000) / 100, 2),
          'status' => 'studying',
          'payment_status' => 'pending',
          'created_at' => now(),
          'updated_at' => now(),
        ];
      }
    }

    if (!empty($enrollments)) {
      DB::table('student_course')->upsert(
        $enrollments,
        ['student_id', 'course_offering_id'],
        ['grade_final', 'status', 'payment_status', 'updated_at']
      );
    }
  }
}
