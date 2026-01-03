<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Enrollment extends Model
{
  protected $fillable = [
    'student_id',
    'course_offering_id',
    'status',
    'remarks',
    'attendance_grade',
    'listening_grade',
    'writing_grade',
    'reading_grade',
    'speaking_grade',
    'midterm_grade',
    'final_grade',
  ];

  protected $casts = [
    'attendance_grade' => 'decimal:2',
    'listening_grade'  => 'decimal:2',
    'writing_grade'    => 'decimal:2',
    'reading_grade'    => 'decimal:2',
    'speaking_grade'   => 'decimal:2',
    'midterm_grade'    => 'decimal:2',
    'final_grade'      => 'decimal:2',
  ];


  public function fee()
  {
    return $this->hasOne(Fee::class, 'enrollment_id');
  }

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }

  public function isPassed(): bool
  {
    return $this->final_grade >= 50;
  }


  protected static function booted()
  {
    static::created(function (Enrollment $enrollment) {

      DB::transaction(function () use ($enrollment) {
        $course = $enrollment->courseOffering()->first();

        if (! $course) {
          Log::warning("CourseOffering not found for Enrollment ID {$enrollment->id}");
          return;
        }

        $feeType = FeeType::firstOrCreate(
          ['name' => 'Course Fee'],
          ['description' => 'Automatically generated fee type for course enrollment']
        );

        if ($course->payment_type === 'course') {
          Fee::create([
            'student_id'    => $enrollment->student_id,
            'enrollment_id' => $enrollment->id,
            'fee_type_id'   => $feeType->id,
            'created_by'    => Auth::id() ?? 1,
            'amount'        => $course->fee ?? 0,
            'description'   => "Enrollment fee for {$course->subject->name}",
            'due_date'      => now()->addDays(15),
          ]);

          return;
        }

        if ($course->payment_type === 'monthly') {

          $current = \Carbon\Carbon::parse($course->join_start)->startOfMonth();
          $end     = \Carbon\Carbon::parse($course->join_end)->endOfMonth();

          while ($current <= $end) {
            Fee::create([
              'student_id'    => $enrollment->student_id,
              'enrollment_id' => $enrollment->id,
              'fee_type_id'   => $feeType->id,
              'created_by'    => Auth::id() ?? 1,
              'amount'        => $course->fee,
              'description'   => "Monthly fee for {$course->subject->name} - " . $current->format('F Y'),
              'due_date'      => (clone $current)->addDays(15),
            ]);

            $current->addMonth();
          }
        }
      });
    });
  }

  protected function gradeFinal(): Attribute
  {
    return Attribute::make(
      get: fn() => collect([
        $this->attendance_grade,
        $this->listening_grade,
        $this->writing_grade,
        $this->reading_grade,
        $this->speaking_grade,
        $this->midterm_grade,
        $this->final_grade,
      ])
        ->filter(fn($value) => $value !== null)
        ->sum()
    );
  }

  public function getManualSumAttribute(): float
  {
    return (float) (
      ($this->attendance_grade ?? 0) +
      ($this->listening_grade  ?? 0) +
      ($this->writing_grade    ?? 0) +
      ($this->reading_grade    ?? 0) +
      ($this->speaking_grade   ?? 0) +
      ($this->midterm_grade    ?? 0) +
      ($this->final_grade      ?? 0)
    );
  }

  public function getLetterGradeAttribute(): string
  {
    $total = $this->manual_sum;

    if ($total >= 95) return 'A+';
    if ($total >= 90) return 'A';
    if ($total >= 85) return 'B+';
    if ($total >= 80) return 'B';
    if ($total >= 75) return 'C+';
    if ($total >= 70) return 'C';
    if ($total >= 65) return 'D+';
    if ($total >= 60) return 'D';

    return 'F';
  }

  public function getGradeColorAttribute(): string
  {
    $score = $this->grade_final;
    if ($score >= 80) return 'text-green-600';
    if ($score >= 70) return 'text-yellow-600';
    if ($score >= 60) return 'text-orange-600';
    return 'text-red-600';
  }
}
