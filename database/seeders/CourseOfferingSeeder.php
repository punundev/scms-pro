<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;

class CourseOfferingSeeder extends Seeder
{
  public function run(): void
  {
    $subjects = Subject::pluck('id')->toArray();
    $teachers = User::role('teacher')->pluck('id')->toArray();
    $classrooms = Classroom::pluck('id')->toArray();

    if (empty($subjects) || empty($teachers) || empty($classrooms)) {
      $this->command->warn('Not enough subjects, teachers, or classrooms to seed course offerings.');
      return;
    }

    $courseOfferings = [];

    foreach ($subjects as $subjectId) {
      $teacherId = $teachers[array_rand($teachers)];
      $classroomId = $classrooms[array_rand($classrooms)];

      $courseOfferings[] = [
        'subject_id' => $subjectId,
        'teacher_id' => $teacherId,
        'classroom_id' => $classroomId,
        'time_slot' => 'morning',
        'start_time' => '08:00:00',
        'end_time' => '10:00:00',
        'join_start' => now()->subDays(10),
        'join_end' => now()->addDays(30),
        'fee' => rand(1000, 5000),
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    DB::table('course_offerings')->insert($courseOfferings);
  }
}
