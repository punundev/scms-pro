<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('classrooms', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('room_number')->unique();
      $table->integer('capacity');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('phone')->nullable()->unique();
      $table->text('address')->nullable();
      $table->date('date_of_birth')->nullable();
      $table->enum('gender', [
        'monk',
        'male',
        'female',
        'other'
      ])->nullable()->default('male');
      $table->date('joining_date')->nullable();
      $table->string('qualification')->nullable();
      $table->string('experience')->nullable();
      $table->text('specialization')->nullable();
      $table->decimal('salary', 10, 2)->nullable();
      $table->string('cv')->nullable();
      $table->string('blood_group')->nullable();
      $table->string('nationality')->nullable();
      $table->string('religion')->nullable();
      $table->date('admission_date')->nullable();
      $table->string('occupation')->nullable();
      $table->string('company')->nullable();
      $table->string('avatar')->nullable();
      $table->rememberToken();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('password_reset_tokens', function (Blueprint $table) {
      $table->string('email')->primary();
      $table->string('token');
      $table->timestamp('created_at')->nullable();
    });

    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });

    Schema::create('subjects', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('code')->unique();
      $table->text('description')->nullable();
      $table->integer('credit_hours')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('expense_categories', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->decimal('amount', 10, 2);
      $table->date('date');
      $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->onDelete('set null');
      $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
      $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();
    });


    Schema::create('course_offerings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('subject_id')
        ->constrained()
        ->cascadeOnDelete();
      $table->foreignId('teacher_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();
      $table->foreignId('classroom_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();
      $table->enum('time_slot', ['morning', 'afternoon', 'evening'])
        ->default('morning');
      $table->enum('schedule', ['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'])
        ->default('mon-fri');
      $table->enum('payment_type', ['course', 'monthly'])
        ->default('course');
      $table->boolean('is_final_only')->default(false);
      $table->time('start_time')->nullable();
      $table->time('end_time')->nullable();
      $table->date('join_start')->nullable();
      $table->date('join_end')->nullable();
      $table->decimal('fee', 10, 2)->default(0);
      $table->timestamps();
      $table->softDeletes();

      $table->unique(
        ['teacher_id', 'schedule', 'time_slot', 'join_start', 'join_end'],
        'unique_teacher_schedule_slot_period'
      );

      $table->unique(
        ['classroom_id', 'schedule', 'time_slot', 'join_start', 'join_end'],
        'unique_classroom_schedule_slot_period'
      );
    });

    Schema::create('enrollments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('course_offering_id')->constrained()->onDelete('cascade');
      $table->enum('status', [
        'studying',
        'suspended',
        'dropped',
        'completed'
      ])->default('studying');
      $table->decimal('attendance_grade', 5, 2)->nullable();
      $table->decimal('listening_grade', 5, 2)->nullable();
      $table->decimal('writing_grade', 5, 2)->nullable();
      $table->decimal('reading_grade', 5, 2)->nullable();
      $table->decimal('speaking_grade', 5, 2)->nullable();
      $table->decimal('midterm_grade', 5, 2)->nullable();
      $table->decimal('final_grade', 5, 2)->nullable();
      $table->text('remarks')->nullable();
      $table->timestamps();

      $table->unique(
        ['student_id', 'course_offering_id'],
        'unique_student_course_enrollment'
      );
    });

    Schema::create('attendances', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('course_offering_id')->nullable()->constrained();
      $table->date('date');
      $table->enum('status', ['attending', 'absence', 'permission']);
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();
      $table->unique(
        ['student_id', 'course_offering_id',  'date'],
        'attendances_unique_idx'
      );
    });

    Schema::create('exams', function (Blueprint $table) {
      $table->id();
      $table->foreignId('course_offering_id')->constrained()->onDelete('cascade');
      $table->enum('type', [
        'midterm',
        'final',
        'speaking',
        'listening',
        'reading',
        'writing',
      ]);
      $table->text('description')->nullable();
      $table->date('date');
      $table->integer('total_marks');
      $table->integer('passing_marks');
      $table->timestamps();
      $table->softDeletes();

      $table->unique(
        ['course_offering_id', 'type'],
        'unique_exam_type_per_course'
      );
    });

    Schema::create('fee_types', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('fees', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('enrollment_id')->constrained('enrollments')->onDelete('cascade');
      $table->foreignId('fee_type_id')->constrained('fee_types')->onDelete('cascade');
      $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
      $table->decimal('amount', 10, 2);
      $table->date('due_date')->nullable();
      $table->text('remarks')->nullable();
      $table->date('payment_date')->nullable();
      $table->string('payment_method')->nullable();
      $table->string('transaction_id')->nullable();
      $table->foreignId('received_by')->nullable()->constrained('users')->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('scores', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('exam_id')->constrained()->onDelete('cascade');
      $table->integer('score');
      $table->string('grade')->nullable();
      $table->text('remarks')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->unique(
        ['student_id', 'exam_id'],
        'unique_student_exam_score'
      );
    });

    Schema::create('notifications', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('type');
      $table->morphs('notifiable');
      $table->text('data');
      $table->timestamp('read_at')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('notifications');
    Schema::dropIfExists('scores');
    Schema::dropIfExists('payments');
    Schema::dropIfExists('fees');
    Schema::dropIfExists('fee_types');
    Schema::dropIfExists('exams');
    Schema::dropIfExists('attendances');
    Schema::dropIfExists('enrollments');
    Schema::dropIfExists('course_offerings');
    Schema::dropIfExists('expenses');
    Schema::dropIfExists('expense_categories');
    Schema::dropIfExists('subjects');
    Schema::dropIfExists('sessions');
    Schema::dropIfExists('users');
    Schema::dropIfExists('classrooms');
    Schema::dropIfExists('password_reset_tokens');
  }
};
