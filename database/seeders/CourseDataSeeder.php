<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\CourseOffering;
use Faker\Factory as Faker;

class CourseDataSeeder extends Seeder
{
  public function run(): void
  {
    $faker = Faker::create();

    $teacherIds = User::role('teacher')->pluck('id')->toArray();

    if (empty($teacherIds)) {
      $this->command->error("Teacher data not found. Please run the UserSeeder first.");
      return;
    }

    $this->command->info('Seeding 2 Classrooms...');
    $classroomRoomNumbers = ['A145', 'B201'];
    $faker->unique(true);
    $classroomIds = [];

    foreach ($classroomRoomNumbers as $index => $roomNumber) {
      $classroom = Classroom::updateOrCreate(
        ['room_number' => $roomNumber],
        [
          'name' => 'Room ' . ($index + 100),
          'capacity' => 25,
        ]
      );
      $classroomIds[] = $classroom->id;
    }


    $this->command->info('Seeding 3 Subjects...');
    $subjectData = [
      ['name' => 'English Grammar', 'code' => 'ENGL102'],
      ['name' => 'World History', 'code' => 'HIST201'],
      ['name' => 'Microeconomics', 'code' => 'ECON305'],
    ];

    $subjectIds = [];
    foreach ($subjectData as $data) {
      $subject = Subject::updateOrCreate(
        ['code' => $data['code']],
        [
          'name' => $data['name'],
          'description' => $faker->sentence(),
          'credit_hours' => $faker->randomElement([3, 4]),
        ]
      );
      $subjectIds[] = $subject->id;
    }

    $this->command->info('Seeding 7 Course Offerings...');

    $totalOfferings = 7;
    $numSubjects = count($subjectIds);
    $subjectAssignments = [];

    for ($i = 0; $i < $totalOfferings; $i++) {
      $subjectAssignments[] = $subjectIds[$i % $numSubjects];
    }

    CourseOffering::query()->delete();

    $teacherIndex = 0;
    $classroomIndex = 0;

    $timeSlots = ['morning', 'afternoon', 'evening'];
    $schedules = ['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'];

    $usedTeacherCombinations = [];
    $usedClassroomCombinations = [];

    for ($i = 0; $i < $totalOfferings; $i++) {
      $teacherId = $teacherIds[$teacherIndex % count($teacherIds)];
      $classroomId = $classroomIds[$classroomIndex % count($classroomIds)];

      // Pick schedule and time_slot that don't violate unique constraint
      foreach ($schedules as $schedule) {
        foreach ($timeSlots as $timeSlot) {
          $teacherKey = "{$teacherId}-{$schedule}-{$timeSlot}";
          $classroomKey = "{$classroomId}-{$schedule}-{$timeSlot}";

          if (!isset($usedTeacherCombinations[$teacherKey]) && !isset($usedClassroomCombinations[$classroomKey])) {
            $usedTeacherCombinations[$teacherKey] = true;
            $usedClassroomCombinations[$classroomKey] = true;

            $startTime = $faker->time('H:i:s', '09:00:00');
            $endTime = $faker->time('H:i:s', strtotime('+2 hours', strtotime($startTime)));

            CourseOffering::create([
              'subject_id' => $subjectAssignments[$i],
              'teacher_id' => $teacherId,
              'classroom_id' => $classroomId,
              'time_slot' => $timeSlot,
              'schedule' => $schedule,
              'payment_type' => $faker->randomElement(['course', 'monthly']),
              'start_time' => $startTime,
              'end_time' => $endTime,
              'join_start' => $faker->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d'),
              'join_end' => $faker->dateTimeBetween('-6 months', '+3 months')->format('Y-m-d'),
              'fee' => $faker->randomFloat(2, 50, 300),
            ]);

            break 2; // exit both loops once we have a valid combination
          }
        }
      }

      $teacherIndex++;
      $classroomIndex++;
    }
  }
}
