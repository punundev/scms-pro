@extends('layouts.admin')

@section('title', 'Edit Expense: ' . $expense->title)

@section('content')

  <div class="box p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Expense (money icon) --}}
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-red-50 text-red-600 dark:text-red-50 dark:bg-red-900" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 20h9"></path>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
        </svg>
        {{ __('message.edit_expense') }} <span class="text-red-600 dark:text-red-400">{{ $category->name }} - {{ $expense->title }} -
          ({{ $expense?->creator?->name }})</span>
      </h3>
      <a href="{{ route('admin.expenses.index', ['category_id' => $expense->expense_category_id]) }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_ledger') }}
      </a>
    </div>

    {{-- Error Message Display --}}
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    {{-- Form submits to the update method --}}
    <form action="{{ route('admin.expenses.update', $expense->id) }}" method="POST" id="editForm" class="p-0">
      @csrf
      @method('PUT')

      <input type="hidden" name="expense_category_id" value="{{ $category->id }}">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- 1. Title Field --}}
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.expense_title') }} <span class="text-red-500">*</span>
          </label>
          <input type="text" id="title" name="title" value="{{ old('title', $expense->title) }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('title') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., Office Supplies, Monthly Rent" required>
          @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 2. Amount Field --}}
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.amount') }} ($) <span class="text-red-500">*</span>
          </label>
          <input type="number" step="0.01" min="0.01" id="amount" name="amount"
            value="{{ old('amount', $expense->amount) }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('amount') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., 150.99" required>
          @error('amount')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 3. Date Field --}}
        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.date') }} <span class="text-red-500">*</span>
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
            </div>

            <input type="text" id="date" name="date" datepicker datepicker-format="yyyy-mm-dd"
              value="{{ old('date', \Carbon\Carbon::parse($expense->date)->toDateString()) }}"
              min="{{ now()->toDateString() }}" max="2027-01-01" required placeholder="Select date"
              class="block w-full ps-9 pe-3 py-2.5
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-2 focus:ring-red-500 focus:border-red-500
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('date') border-red-500 @else border-gray-400 @enderror">
          </div>

          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.date') }} <span class="text-red-500">*</span>
          </label>
          <input type="date" id="date" name="date"
            value="{{ old('date', \Carbon\Carbon::parse($expense->date)->toDateString()) }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('date') border-red-500 @else border-gray-400 @enderror"
            required>
          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

        {{-- 5. Approved By Select Field (Optional) --}}
        {{-- <div>
          <label for="approved_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.approved_by_(optional)') }}
          </label>
          <select id="approved_by" name="approved_by"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('approved_by') border-red-500 @else border-gray-400 @enderror">
            <option value="">{{ __('message.no_approval_needed_/_pending') }}</option>
            @foreach ($approvers as $approver)
              <option value="{{ $approver->id }}" @selected(old('approved_by', $expense->approved_by) == $approver->id)>
                {{ $approver->name }}
              </option>
            @endforeach
          </select>
          @error('approved_by')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

      </div>

      {{-- 6. Description Field --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {{ __('message.description_/_notes') }}
        </label>
        <textarea id="description" name="description" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
            @error('description') border-red-500 @else border-gray-400 @enderror"
          placeholder="Detailed description of the expense and its purpose">{{ old('description', $expense->description) }}</textarea>

        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.expenses.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>

        @if (Auth::user()->hasPermissionTo('update_expense'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            {{ __('message.update_expense') }}
          </button>
        @endif
      </div>
    </form>

  </div>
@endsection
