<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\{
  AttendanceController,
  ClassroomController,
  ExamController,
  ExpenseController,
  ExpenseCategoryController,
  StudentController,
  SubjectController,
  TeacherController,
  HomeController,
  ScoreController,
  UserController,
  RoleController,
  ProfileController,
  CourseOfferingController,
  EnrollmentController,
  FeeTypeController,
  FeeController,
  NotificationController,
  ReportController
};



Route::middleware('auth')->group(function () {
  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});

Route::get('/', function () {
  if (Auth::check()) {
    return redirect('/admin/profile');
  }
  return redirect('/login');
});


Route::prefix('admin')
  ->as('admin.')
  ->middleware('auth')
  ->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('deshboard');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('expense_categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('fee_types', FeeTypeController::class);
    Route::resource('fees', FeeController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('course_offerings', CourseOfferingController::class);

    Route::prefix('enrollments')
      ->as('enrollments.')
      ->group(function () {
        Route::get('/', [EnrollmentController::class, 'index'])->name('index');
        Route::get('/create', [EnrollmentController::class, 'create'])->name('create');
        Route::post('/', [EnrollmentController::class, 'store'])->name('store');
        Route::get('/{student_id}/{course_offering_id}', [EnrollmentController::class, 'show'])->name('show');
        Route::get('/{student_id}/{course_offering_id}/edit', [EnrollmentController::class, 'edit'])->name('edit');
        Route::put('/{student_id}/{course_offering_id}', [EnrollmentController::class, 'update'])->name('update');
        Route::delete('/{student_id}/{course_offering_id}', [EnrollmentController::class, 'destroy'])->name('destroy');
      });

    Route::prefix('classrooms')
      ->as('classrooms.')
      ->group(function () {
        Route::patch('/{id}/restore', [ClassroomController::class, 'restore'])->name('restore');
      });

    Route::prefix('subjects')
      ->as('subjects.')
      ->group(function () {
        Route::patch('/{id}/restore', [SubjectController::class, 'restore'])->name('restore');
      });

    Route::prefix('course_offerings')
      ->as('course_offerings.')
      ->group(function () {
        Route::patch('/{id}/restore', [CourseOfferingController::class, 'restore'])->name('restore');
        Route::get('/export/{course_offering_id}', [ScoreController::class, 'exportCourseScores'])->name('export');
      });

    Route::prefix('profile')
      ->as('profile.')
      ->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
      });

    Route::prefix('notifications')
      ->as('notifications.')
      ->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('readAll');
        Route::get('/create', [NotificationController::class, 'create'])->name('create');
        Route::post('/send', [NotificationController::class, 'send'])->name('send');
      });

    Route::prefix('scores')
      ->as('scores.')
      ->group(function () {
        Route::get('/', [ScoreController::class, 'index'])->name('index');
        Route::post('/save-all', [ScoreController::class, 'saveAll'])->name('saveAll');
        Route::get('/{courseOfferingId}/student/{studentId}', [ScoreController::class, 'show'])->name('show');
        Route::get('/export/{exam_id}', [ScoreController::class, 'exportExamScores'])->name('export');
        Route::post('/final-grade', [ScoreController::class, 'assignFinalGrades'])->name('assignFinalGrades');
      });

    Route::prefix('attendances')
      ->as('attendances.')
      ->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
        Route::post('/save-all', [AttendanceController::class, 'saveAll'])->name('saveAll');
        Route::get('/{courseOfferingId}/student/{studentId}', [AttendanceController::class, 'show'])->name('show');
        Route::get('/export/{course_offering_id}', [AttendanceController::class, 'exportCourseAttendance'])
          ->name('export');
      });

    Route::prefix('students')
      ->as('students.')
      ->group(function () {
        Route::get('fees/{student}', [StudentController::class, 'feesIndex'])->name('fees.index');
        Route::get('enrollments/{student}', [StudentController::class, 'coursesIndex'])->name('enrollments.index');
        Route::get('enrollments/create/{student}', [StudentController::class, 'createEnrollment'])->name('enrollments.create');
        Route::post('enrollments/{student}', [StudentController::class, 'storeEnrollment'])->name('enrollments.store');
        Route::get('fees/create/{student}', [StudentController::class, 'createFee'])->name('fees.create');
        Route::post('fees/{student}', [StudentController::class, 'storeFee'])->name('fees.store');
      });

    Route::prefix('users')->name('users.')->group(function () {
      Route::put('/password/{user}', [UserController::class, 'changePassword'])->name('password.update');
      Route::put('/role/{user}', [UserController::class, 'changeRole'])->name('role.update');
    });

    Route::post('expenses/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
    Route::post('/fees/{fee}/pay', [FeeController::class, 'paid'])
      ->name('fees.pay');





    Route::prefix('teachers')->name('teachers.')->group(function () {
      Route::post('/bulk-delete', [TeacherController::class, 'bulkDelete'])->name('bulkDelete');
      Route::post('/bulk-data', [TeacherController::class, 'getBulkData'])->name('getBulkData');
      Route::post('/bulk-update', [TeacherController::class, 'bulkUpdate'])->name('bulkUpdate');
    });
  });
