<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use Faker\Factory as Faker;

class EnrollmentSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    $studentIds = User::role('student')->pluck('id')->toArray();
    $courseOfferingIds = CourseOffering::pluck('id')->toArray();

    if (empty($studentIds) || empty($courseOfferingIds)) {
      $this->command->error("Cannot seed Enrollments. Ensure UserSeeder (students) and CourseDataSeeder (offerings) have been run.");
      return;
    }

    $this->command->info('Seeding Enrollments...');

    Enrollment::query()->delete();

    $enrollmentsToInsert = [];
    $studentsAssigned = [];

    foreach ($studentIds as $studentId) {
      $courseOfferingId = $faker->randomElement($courseOfferingIds);

      $enrollmentKey = $studentId . '-' . $courseOfferingId;

      if (!isset($studentsAssigned[$enrollmentKey])) {
        $enrollmentsToInsert[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => $faker->optional(0.7)->randomFloat(2, 60.00, 99.99),
          'status' => $faker->randomElement(['studying', 'completed']),
          'remarks' => $faker->optional(0.1)->sentence(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
        $studentsAssigned[$enrollmentKey] = true;
      }
    }

    for ($i = 0; $i < 50; $i++) {
      $studentId = $faker->randomElement($studentIds);
      $courseOfferingId = $faker->randomElement($courseOfferingIds);
      $enrollmentKey = $studentId . '-' . $courseOfferingId;

      if (!isset($studentsAssigned[$enrollmentKey])) {
        $enrollmentsToInsert[] = [
          'student_id' => $studentId,
          'course_offering_id' => $courseOfferingId,
          'grade_final' => $faker->optional(0.7)->randomFloat(2, 60.00, 99.99),
          'status' => $faker->randomElement(['studying', 'suspended', 'dropped', 'completed']),
          'remarks' => $faker->optional(0.1)->sentence(),
          'created_at' => now(),
          'updated_at' => now(),
        ];
        $studentsAssigned[$enrollmentKey] = true;
      }
    }

    Enrollment::insert($enrollmentsToInsert);
    $this->command->info('Successfully seeded ' . count($enrollmentsToInsert) . ' enrollments.');
  }
}
