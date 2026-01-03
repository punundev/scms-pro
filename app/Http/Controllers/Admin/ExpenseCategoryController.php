<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\User;
use App\Notifications\ExpenseCategoryModified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ExpenseCategoryController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Expense-Category';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $categories = ExpenseCategory::when($search, function ($query) use ($search) {
      return $query->where('name', 'like', "%{$search}%")
        ->orWhere('description', 'like', "%{$search}%");
    })
      ->withCount('expenses')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.expense_categories.index', compact('categories'));
  }

  public function create()
  {
    return view('admin.expense_categories.create');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255|unique:expense_categories,name',
      'description' => 'nullable|string|max:1000',
    ]);

    try {
      $cate = ExpenseCategory::create($validatedData);

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new ExpenseCategoryModified($cate, 'created'));

      return redirect()->route('admin.expense_categories.index')->with('success', 'Expense Category created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating expense category: ' . $e->getMessage());
      return redirect()->route('admin.expense_categories.create')->with('error', 'Error creating expense category.')->withInput();
    }
  }

  public function show(ExpenseCategory $expenseCategory)
  {
    $expenseCategory->load('expenses.creator', 'expenses.approver');

    return view('admin.expense_categories.show', compact('expenseCategory'));
  }

  public function edit(ExpenseCategory $expenseCategory)
  {
    return view('admin.expense_categories.edit', compact('expenseCategory'));
  }

  public function update(Request $request, ExpenseCategory $expenseCategory)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255|unique:expense_categories,name,' . $expenseCategory->id,
      'description' => 'nullable|string|max:1000',
    ]);

    try {
      $expenseCategory->update($validatedData);
      return redirect()->route('admin.expense_categories.index')->with('success', 'Expense Category updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating expense category: ' . $e->getMessage());
      return redirect()->route('admin.expense_categories.edit', $expenseCategory)->with('error', 'Error updating expense category.')->withInput();
    }
  }

  public function destroy(ExpenseCategory $expenseCategory)
  {
    try {
      $expenseCategory->delete();
      return redirect()->route('admin.expense_categories.index')->with('success', 'Expense Category deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting expense category: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting expense category: ' . $e->getMessage());
    }
  }
}
