<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GenericReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Expense;
use App\Models\Attendance;
use App\Models\Score;
use App\Models\Subject;
use App\Models\CourseOffering;
use App\Models\Fee;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'reports';
  }

  public function index()
  {
    return view('admin.reports.index', [
      'subjects' => Subject::pluck('name', 'id'),
      'courses' => CourseOffering::with('subject')->get()
        ->mapWithKeys(fn($c) => [
          $c->id => $c->subject->name . " ({$c->time_slot})"
        ]),

      'reportType' => null,
      'data'       => null,
      'title'      => null,
      'reportView' => null,

      'defaultStart' => null,
      'defaultEnd'   => null,
    ]);
  }


  public function generate(Request $request)
  {
    $request->validate([
      'report_type' => 'required|string',
      'export' => 'nullable|in:pdf,excel,csv'
    ]);

    $type = $request->report_type;

    $reports = [
      'student_enrollment' => 'reportStudentEnrollment',
      'financial_expenses' => 'reportFinancialExpenses',
      'attendance'        => 'reportAttendance',
      'scores'            => 'reportScores',
      'financial_summary' => 'reportFinancialSummary',
    ];

    if (!isset($reports[$type])) {
      abort(404, "Unknown report type");
    }

    $method = $reports[$type];
    $response = $this->$method($request);

    $defaultStart = null;
    $defaultEnd = null;

    switch ($type) {
      case 'student_enrollment':
        $defaultStart = Enrollment::min('created_at');
        $defaultEnd   = Enrollment::max('created_at');
        break;

      case 'financial_expenses':
        $defaultStart = Expense::min('date');
        $defaultEnd   = Expense::max('date');
        break;

      case 'attendance':
        $defaultStart = Attendance::min('date');
        $defaultEnd   = Attendance::max('date');
        break;

      case 'scores':
        $defaultStart = Score::min('created_at');
        $defaultEnd   = Score::max('created_at');
        break;

      case 'financial_summary':

        $start1 = Fee::min('created_at');
        $start2 = Expense::min('date');
        $end1   = Fee::max('created_at');
        $end2   = Expense::max('date');

        $defaultStart = min(array_filter([$start1, $start2]));
        $defaultEnd   = max(array_filter([$end1, $end2]));
        break;
    }

    if ($request->export) {
      return $this->exportReport($response, $request->export);
    }

    return view('admin.reports.index', [
      'subjects'      => Subject::pluck('name', 'id'),
      'courses'       => CourseOffering::with('subject')->get()
        ->mapWithKeys(fn($c) => [
          $c->id => $c->subject->name . " ({$c->time_slot})"
        ]),
      'reportType'    => $type,
      'data'          => $response['data'],
      'title'         => $response['title'],
      'reportView'    => $response['view'],

      'defaultStart'  => $defaultStart,
      'defaultEnd'    => $defaultEnd,
    ]);
  }


  private function reportStudentEnrollment($request)
  {
    $query = Enrollment::with(['student', 'courseOffering.subject'])
      ->orderBy('created_at', 'desc');

    if ($request->course_offering_id) {
      $query->where('course_offering_id', $request->course_offering_id);
    }

    if ($request->status) {
      $query->where('status', $request->status);
    }

    if ($request->start_date) {
      $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->end_date) {
      $query->whereDate('created_at', '<=', $request->end_date);
    }

    return [
      'title' => 'Student Enrollment Report',
      'view'  => 'admin.reports.partials.enrollment_report',
      'data'  => $query->paginate(50),
    ];
  }

  private function reportFinancialExpenses($request)
  {
    $query = Expense::with(['category', 'creator'])
      ->orderBy('date', 'desc');

    if ($request->expense_category_id) {
      $query->where('expense_category_id', $request->expense_category_id);
    }

    if ($request->start_date) {
      $query->whereDate('date', '>=', $request->start_date);
    }

    if ($request->end_date) {
      $query->whereDate('date', '<=', $request->end_date);
    }

    return [
      'title' => 'Financial Expense Report',
      'view'  => 'admin.reports.partials.expense_report',
      'data'  => [
        'list' => $query->paginate(50),
        'summary' => [
          'total' => (clone $query)->sum('amount'),
          'count' => (clone $query)->count(),
        ]
      ]
    ];
  }

  private function reportAttendance($request)
  {
    $query = Attendance::with(['student', 'courseOffering.subject'])
      ->orderBy('date', 'desc');

    if ($request->course_offering_id) {
      $query->where('course_offering_id', $request->course_offering_id);
    }

    if ($request->status) {
      $query->where('status', $request->status);
    }

    if ($request->start_date) {
      $query->whereDate('date', '>=', $request->start_date);
    }

    if ($request->end_date) {
      $query->whereDate('date', '<=', $request->end_date);
    }

    return [
      'title' => 'Attendance Report',
      'view'  => 'admin.reports.partials.attendance_report',
      'data'  => $query->paginate(50),
    ];
  }

  private function reportScores($request)
  {
    $query = Score::with(['student', 'exam.courseOffering.subject'])
      ->orderBy('created_at', 'desc');

    if ($request->course_offering_id) {
      $query->whereHas(
        'exam',
        fn($q) =>
        $q->where('course_offering_id', $request->course_offering_id)
      );
    }

    if ($request->exam_type) {
      $query->whereHas(
        'exam',
        fn($q) =>
        $q->where('type', $request->exam_type)
      );
    }

    return [
      'title' => 'Exam Score Report',
      'view'  => 'admin.reports.partials.score_report',
      'data'  => $query->paginate(50)
    ];
  }


  private function reportFinancialSummary($request)
  {
    $incomeQuery = Fee::query();
    $expenseQuery = Expense::with('category');

    if ($request->start_date) {
      $incomeQuery->whereDate('created_at', '>=', $request->start_date);
      $expenseQuery->whereDate('date', '>=', $request->start_date);
    }

    if ($request->end_date) {
      $incomeQuery->whereDate('created_at', '<=', $request->end_date);
      $expenseQuery->whereDate('date', '<=', $request->end_date);
    }

    $incomeList = $incomeQuery->orderBy('created_at')->get();
    $expenseList = $expenseQuery->orderBy('date')->get();

    $totalIncome = $incomeList->sum('amount');
    $totalExpenses = $expenseList->sum('amount');

    return [
      'title' => 'Financial Summary Report',
      'view'  => 'admin.reports.partials.financial_summary',
      'data'  => [
        'total_income'   => $totalIncome,
        'total_expenses' => $totalExpenses,
        'income'         => $incomeList,
        'expenses'       => $expenseList,
      ]
    ];
  }

  private function exportReport($response, $type)
  {
    $view = $response['view'];
    $data = $response['data'];
    $title = $response['title'];
    $reportType = request('report_type');

    if ($type === 'pdf') {
      return Pdf::loadView('admin.reports.pdf.master', [
        'view'  => $view,
        'data'  => $data,
        'title' => $title,
      ])->setPaper('a4', 'portrait')->download("{$title}.pdf");
    }

    if ($type === 'excel') {
      $export = match ($reportType) {
        'financial_summary'  => new \App\Exports\FinancialSummaryExport($data),
        'student_enrollment' => new \App\Exports\EnrollmentReportExport($data),
        // 'financial_expenses' => new \App\Exports\ExpenseReportExport($data),
        // 'attendance'         => new \App\Exports\AttendanceReportExport($data),
        // 'scores'             => new \App\Exports\ScoreReportExport($data),
        default              => new GenericReportExport($data, ['ID' => 'id', 'Date' => 'created_at']),
      };

      return Excel::download($export, "{$title}.xlsx");
    }
  }

  // private function exportReport($response, $type)
  // {
  //   $view = $response['view'];
  //   $data = $response['data'];
  //   $title = $response['title'];
  //   $reportType = request('report_type');

  //   if ($type === 'pdf') {
  //     return Pdf::loadView('admin.reports.pdf.master', [
  //       'view'  => $view,
  //       'data'  => $data,
  //       'title' => $title,
  //     ])->setPaper('a4', 'portrait')->download("{$title}.pdf");
  //   }

  //   if ($type === 'excel') {
  //     if ($reportType === 'financial_summary') {
  //       return Excel::download(new \App\Exports\FinancialSummaryExport($data), "{$title}.xlsx");
  //     }

  //     $mapping = match ($reportType) {
  //       'student_enrollment' => [
  //         'Student Name' => 'student.name',
  //         'Course'       => 'courseOffering.subject.name',
  //         'Date'         => 'created_at',
  //         'Status'       => 'status',
  //       ],
  //       'attendance' => [
  //         'Student Name' => 'student.name',
  //         'Course'       => 'courseOffering.subject.name',
  //         'Date'         => 'date',
  //         'Status'       => 'status',
  //       ],
  //       'scores' => [
  //         'Student Name' => 'student.name',
  //         'Exam'         => 'exam.type',
  //         'Subject'      => 'exam.courseOffering.subject.name',
  //         'Score'        => 'score',
  //         'Grade'        => 'grade',
  //       ],
  //       'financial_expenses' => [
  //         'Category' => 'category.name',
  //         'Amount'   => 'amount',
  //         'Date'     => 'date',
  //         'Notes'    => 'notes',
  //       ],
  //       default => [
  //         'ID'   => 'id',
  //         'Date' => 'created_at'
  //       ]
  //     };

  //     return Excel::download(
  //       new GenericReportExport($data, $mapping),
  //       "{$title}.xlsx"
  //     );
  //   }
  // }
}
