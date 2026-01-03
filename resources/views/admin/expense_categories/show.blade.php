@extends('layouts.admin')

@section('title', 'Category Details: ' . $expenseCategory->name)

@section('content')

  <div
    class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto">

    <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100 dark:border-gray-700/50">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon changed for expense/finance theme --}}
        <svg class="size-8 p-1 rounded-full bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.25 18.75a60.03 60.03 0 0115.79-4.148 61.03 61.03 0 014.288 3.52 61.03 61.03 0 01-4.288 3.52A60.03 60.03 0 012.25 18.75zm17.91-14.939a.75.75 0 00-.918-.282L13 6.969V5.25A2.25 2.25 0 0010.75 3h-5a2.25 2.25 0 00-2.25 2.25V15h2.25a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V5.511l.243-.092A.75.75 0 0020.16 3.811z" />
        </svg>
        {{ __('message.expense_category_details') }}
      </h3>

      <div class="flex gap-4">
        <a href="{{ route('admin.students.fees.index', $expenseCategory->id) }}"
          class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors text-base"
          title="Export {{ $expenseCategory->name ?? 'N/A' }}">
          <i class="fa-solid fa-download me-2"></i>
          {{ __('message.export') }} {{ $expenseCategory->name ?? 'N/A' }}
        </a>
        {{-- Back Button (Update route name) --}}
        <a href="{{ route('admin.expense_categories.index') }}"
          class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
          <i class="fas fa-arrow-left text-xs"></i> {{ __('message.back_to_categories') }}
        </a>
      </div>
    </div>

    {{-- Main Detail Card --}}
    <div class="bg-green-50 dark:bg-slate-700/30 rounded-lg p-6 space-y-6">

      {{-- Category Name & Total Expenses --}}
      <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col">
          <h2 class="text-2xl font-extrabold text-green-700 dark:text-green-300">
            {{ $expenseCategory->name ?? 'N/A' }}
          </h2>
          <p class="text-sm font-semibold text-green-500 dark:text-green-400 mt-1">
            {{ __('message.category_id') }} {{ $expenseCategory->id }}
          </p>
        </div>
        {{-- Calculate and display total amount spent for this category --}}
        <span class="text-3xl font-extrabold text-indigo-700 dark:text-indigo-400 mt-2 sm:mt-0">
          {{ __('message.total_spent') }} ${{ number_format($expenseCategory->expenses->sum('amount') ?? 0, 2) }}
        </span>
      </div>

      {{-- Core Details Grid (Description, Dates) --}}
      <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-sm border-b pb-4 border-gray-200 dark:border-gray-700/50">

        {{-- Description --}}
        <p class="lg:col-span-2 detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-list-ul text-purple-500"></i> {{ __('message.description') }}
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1 text-base whitespace-pre-wrap">
            {{ $expenseCategory->description ?? 'No description provided.' }}
          </span>
        </p>

        {{-- Created At --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-plus text-cyan-500"></i> {{ __('message.created') }}
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expenseCategory->created_at?->format('M d, Y H:i') ?? 'N/A' }}
          </span>
        </p>

        {{-- Last Updated --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-check text-pink-500"></i> {{ __('message.last_updated') }}
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $expenseCategory->updated_at?->format('M d, Y H:i') ?? 'N/A' }}
          </span>
        </p>
      </div>

      {{-- Associated Expenses Section --}}
      <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
        <span class="font-bold text-lg text-gray-700 dark:text-gray-300 flex items-center gap-2 mb-3">
          <i class="fa-solid fa-file-invoice-dollar text-green-500"></i> {{ __('message.associated_expenses') }}
          <span
            class="ml-2 px-3 py-0.5 rounded-full text-xs font-extrabold bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
            {{ __('message.total') }} {{ $expenseCategory->expenses->count() }}
          </span>
        </span>
        <div
          class="max-h-96 overflow-y-auto bg-white dark:bg-gray-700 p-3 rounded-lg border border-gray-100 dark:border-gray-600">
          @if ($expenseCategory->expenses->isNotEmpty())
            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
              @foreach ($expenseCategory->expenses->sortByDesc('date') as $expense)
                <li
                  class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-2 px-3 border-b border-gray-50 dark:border-gray-600/50 hover:bg-gray-50 dark:hover:bg-gray-600/50 rounded-sm">
                  {{-- Expense Title and Amount --}}
                  <div class="flex flex-col">
                    <span class="font-bold text-base text-gray-800 dark:text-gray-200">
                      {{ $expense->title }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                      {{ __('message.date') }} {{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}
                    </span>
                  </div>

                  {{-- Details on the right --}}
                  <div class="flex items-center gap-4 mt-1 sm:mt-0">
                    <span class="text-lg font-extrabold text-red-600 dark:text-red-400">
                      -${{ number_format($expense->amount, 2) }}
                    </span>
                    {{-- Display Approver/Creator, assuming you have a route for Expense details --}}
                    {{-- <a href="{{ route('admin.expenses.show', $expense->id) }}" class="text-blue-500 hover:text-blue-700 text-xs">View</a> --}}
                  </div>

                </li>
              @endforeach
            </ul>
          @else
            <p class="text-center text-sm italic text-gray-500 dark:text-gray-400">
              {{ __('message.no_expenses_have_been_recorded_for_this_category_yet') }}
            </p>
          @endif
        </div>
      </div>

    </div>

    {{-- Action Buttons (Update route names) --}}
    <div class="mt-6 flex justify-end gap-3">

      @if (Auth::user()->hasPermissionTo('update_expense-category'))
        <a href="{{ route('admin.expense_categories.edit', $expenseCategory->id) }}"
          class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors"
          title="Edit Expense Category">
          <i class="fa-solid fa-pen-to-square mr-2"></i>
          {{ __('message.edit_category') }}
        </a>
      @endif

      @if (Auth::user()->hasPermissionTo('delete_expense-category'))
        <form action="{{ route('admin.expense_categories.destroy', $expenseCategory->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to permanently delete this expense category? This will not delete associated expenses, but they will become uncategorized.');">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors"
            title="Delete Expense Category">
            <i class="fa-regular fa-trash-can mr-2"></i>
            {{ __('message.delete') }}
          </button>
        </form>
      @endif
    </div>
  </div>
@endsection
