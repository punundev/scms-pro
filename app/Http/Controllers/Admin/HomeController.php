<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Dashboard';
  }




  public function index()
  {
    $students = User::role('student')->count();
    $teachers = User::role('teacher')->count();
    // $course = CourseOffering::whereDate('join_end', '>=', Carbon::today())->count();
    $course = CourseOffering::active()->count();
    $totalPaid = Fee::whereNotNull('payment_date')->sum('amount');
    $totalUnpaid = Fee::whereNull('payment_date')->sum('amount');
    $totalExpense = Expense::whereNotNull('approved_by')->sum('amount');
    $pendingExpense = Expense::whereNull('approved_by')->sum('amount');

    $recentEnrollments = Enrollment::latest()
      ->with(['student', 'courseOffering', 'fee'])
      ->take(5)
      ->get();

    $statuses = ['attending', 'absence', 'permission'];

    $dailyLabels = [];
    $dailyCounts = [
      'attending' => [],
      'absence' => [],
      'permission' => []
    ];

    for ($i = 6; $i >= 0; $i--) {
      $d = Carbon::today()->subDays($i);
      $dailyLabels[] = $d->format('D');

      foreach ($statuses as $s) {
        $dailyCounts[$s][] = Attendance::whereDate('date', $d)
          ->where('status', $s)
          ->count();
      }
    }

    $weeklyLabels = [];
    $weeklyCounts = [
      'attending' => [],
      'absence' => [],
      'permission' => []
    ];

    for ($i = 3; $i >= 0; $i--) {
      $start = Carbon::now()->startOfWeek()->subWeeks($i);
      $end   = (clone $start)->endOfWeek();

      $weeklyLabels[] = "Wk " . $start->weekOfYear;

      foreach ($statuses as $s) {
        $weeklyCounts[$s][] = Attendance::whereBetween('date', [$start, $end])
          ->where('status', $s)
          ->count();
      }
    }

    $monthlyLabels = [];
    $monthlyCounts = [
      'attending' => [],
      'absence' => [],
      'permission' => []
    ];

    for ($i = 5; $i >= 0; $i--) {
      $m = Carbon::now()->subMonths($i);
      $monthlyLabels[] = $m->format('M');

      $start = $m->copy()->startOfMonth();
      $end   = $m->copy()->endOfMonth();

      foreach ($statuses as $s) {
        $monthlyCounts[$s][] = Attendance::whereBetween('date', [$start, $end])
          ->where('status', $s)
          ->count();
      }
    }

    $attendance = [
      'daily' => [
        'labels' => $dailyLabels,
        'attending' => $dailyCounts['attending'],
        'absence' => $dailyCounts['absence'],
        'permission' => $dailyCounts['permission'],
      ],
      'weekly' => [
        'labels' => $weeklyLabels,
        'attending' => $weeklyCounts['attending'],
        'absence' => $weeklyCounts['absence'],
        'permission' => $weeklyCounts['permission'],
      ],
      'monthly' => [
        'labels' => $monthlyLabels,
        'attending' => $monthlyCounts['attending'],
        'absence' => $monthlyCounts['absence'],
        'permission' => $monthlyCounts['permission'],
      ],
    ];



    $data = [
      'totalStudents' => $students,
      'totalTeachers' => $teachers,
      'totalExpense' => $totalExpense,
      'pendingExpense' => $pendingExpense,
      'activeCourse' => $course,
      'feesCollected' => $totalPaid,
      'feesUnpaid' => $totalUnpaid,
      'recentStudents' => $recentEnrollments,
      'attendance' => $attendance,
      'recentActivities' =>  Auth::user()->notifications()
        ->take(5)
        ->get()
        ->map(function ($n) {
          return [
            'id'          => $n->id,
            'title'       => $n->data['title'] ?? 'Notification',
            'description' => $n->data['description'] ?? '',
            'icon'        => $n->data['icon'] ?? 'info-circle',
            'color'       => $n->data['color'] ?? 'blue',
            'time'        => $n->created_at,
          ];
        })


    ];

    return view('admin.dashboard.index', $data);
  }
}
