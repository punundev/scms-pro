<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Notifications\ExpenseCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ExpenseController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Expense';
  }





  public function index(Request $request)
  {
    $search      = $request->input('search');
    $perPage     = $request->input('per_page', 8);
    $categoryId  = $request->input('category_id');
    $fromDate    = $request->input('from_date');
    $toDate      = $request->input('to_date');

    $expenses = Expense::query()
      ->with(['category:id,name', 'creator:id,name'])

      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhereHas('category', function ($q) use ($search) {
              $q->where('name', 'like', "%{$search}%");
            })
            ->orWhereHas('creator', function ($q) use ($search) {
              $q->where('name', 'like', "%{$search}%");
            });
        });
      })

      ->when($categoryId, function ($query) use ($categoryId) {
        $query->where('expense_category_id', $categoryId);
      })

      ->when($fromDate, function ($query) use ($fromDate) {
        $query->whereDate('date', '>=', $fromDate);
      })
      ->when($toDate, function ($query) use ($toDate) {
        $query->whereDate('date', '<=', $toDate);
      })

      ->orderByRaw('approved_by IS NOT NULL')

      ->orderBy('date', 'desc')
      ->orderBy('created_at', 'desc')

      ->paginate($perPage)
      ->appends($request->query());

    $categories = ExpenseCategory::orderBy('name')->get(['id', 'name']);

    return view('admin.expenses.index', compact('expenses', 'categories'));
  }



  public function create(Request $request)
  {
    $categoryId = $request->input('category_id');
    $category = ExpenseCategory::findOrFail($categoryId);

    $payrollUsers = null;

    if ($category->name === 'Payroll') {
      $payrollUsers = User::role(['teacher', 'staff'])->get();
    }

    return view('admin.expenses.create', compact('category', 'payrollUsers'));
  }

  public function store(ExpenseRequest $request)
  {
    $data = $request->validated();
    $category = ExpenseCategory::find($data['expense_category_id']);

    if ($category->name !== 'Payroll') {

      $data['approved_by'] = null;
      $data['created_by'] = Auth::id();

      $expense = Expense::create($data);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new ExpenseCreated($expense));

      return redirect()
        ->route('admin.expenses.index', ['category_id' => $data['expense_category_id']])
        ->with('success', 'Expense record created successfully!');
    }

    $selectedUsers = $request->input('payroll_user_ids', []);

    if (empty($selectedUsers)) {
      return back()->withErrors(['payroll_user_ids' => 'Please select at least one user for payroll.']);
    }

    foreach ($selectedUsers as $userId) {

      $row = $data;
      $row['approved_by'] = null;
      $row['created_by'] = $userId;

      $expense = Expense::create($row);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new ExpenseCreated($expense));
    }

    return redirect()
      ->route('admin.expenses.index', ['category_id' => $data['expense_category_id']])
      ->with('success', 'Payroll expenses created successfully!');
  }


  public function show(Expense $expense)
  {
    return view('admin.expenses.show', compact('expense'));
  }

  public function approve(Expense $expense)
  {

    if ($expense->approved_by) {
      return back()->with('error', 'This expense is already approved.');
    }

    $expense->update([
      'approved_by' => Auth::id(),
      'approved_at' => now(),
    ]);


    return redirect()->route('admin.expenses.index', ['category_id' => $expense->expense_category_id])
      ->with('success', "Expense '{$expense->title}' has been successfully approved!");
  }

  public function edit(Expense $expense)
  {
    $category = $expense->category;
    $approvers = User::role(['admin', 'staff'])->get(['id', 'name']);

    return view('admin.expenses.edit', compact('expense', 'category', 'approvers'));
  }


  public function update(ExpenseRequest $request, Expense $expense)
  {
    $data = $request->validated();
    $data['expense_category_id'] = $expense->expense_category_id;

    $expense->update($data);

    return redirect()
      ->route('admin.expenses.index', ['category_id' => $data['expense_category_id']])
      ->with('success', 'Expense record updated successfully.');
  }



  public function destroy(Expense $expense)
  {

    try {
      $expense->delete();
      return redirect()->route('admin.expenses.index', ['category_id' => $expense->expense_category_id])->with('success', 'Expense record deleted successfully.');
    } catch (\Exception $e) {
      Log::error('Error deleting Expense: ' . $e->getMessage());
      return redirect()->route('admin.expenses.index')->with('error', 'Error deleting expense record.')->withInput();
    }
  }
}
