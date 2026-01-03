@extends('layouts.admin')

@section('title', 'Record New Expense')

@section('content')

  <div class="box p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Expense (money icon) --}}
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-red-50 text-red-600 dark:text-red-50 dark:bg-red-900" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="1" x2="12" y2="23"></line>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
        {{ __('message.record_new_expense') }} - {{ $category->name }}
      </h3>
      <a href="{{ route('admin.expenses.index', ['category_id' => $category->id]) }}"
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

    {{-- Form submits to the store method --}}
    <form action="{{ route('admin.expenses.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <input type="hidden" name="expense_category_id" value="{{ $category->id }}">

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- 1. Title Field --}}
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.expense_title') }} <span class="text-red-500">*</span>
          </label>
          <input type="text" id="title" name="title" value="{{ old('title') }}"
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
          <input type="number" step="0.01" min="0.01" id="amount" name="amount" value="{{ old('amount') }}"
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
              value="{{ old('date', now()->toDateString()) }}" min="{{ now()->toDateString() }}" max="2027-01-01"
              required placeholder="Select date"
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
          <input type="date" id="date" name="date" value="{{ old('date', now()->toDateString()) }}"
            min="2025-01-01" max="2027-01-01"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('date') border-red-500 @else border-gray-400 @enderror"
            required>
          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

      </div>

      @if ($category->name === 'Payroll')
        <div class="mb-3 mt-6">
          <label class="form-label fw-bold text-gray-800 dark:text-gray-200">
            {{ __('message.select_users_for_payroll') }}
          </label>

          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mt-2">
            @foreach ($payrollUsers as $user)
              <div class="flex items-center space-x-2 relative">
                <div class="relative flex items-center justify-center">
                  <input id="user-{{ $user->id }}" type="checkbox" name="payroll_user_ids[]"
                    value="{{ $user->id }}"
                    class="peer size-5 appearance-none rounded-lg cursor-pointer
                      border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                      transition-all duration-200
                      checked:bg-indigo-600 checked:border-indigo-600
                      hover:border-indigo-400 dark:hover:border-indigo-500
                      focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-700
                      focus:ring-offset-2 dark:focus:ring-offset-gray-800 relative z-10">
                  <svg
                    class="pointer-events-none absolute w-4 h-4 text-white
                        opacity-0 scale-75 transition-all duration-200
                        peer-checked:opacity-100 peer-checked:scale-100 z-20"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                  </svg>
                </div>

                <label for="user-{{ $user->id }}" class="cursor-pointer text-sm text-gray-900 dark:text-gray-300">
                  {{ $user->name }} — ({{ implode(', ', $user->getRoleNames()->toArray()) }})
                </label>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      {{-- 6. Description Field --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Description / Notes
        </label>
        <textarea id="description" name="description" rows="5" required
          class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                    focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
            @error('description') border-red-500 @else border-gray-400 @enderror"
          placeholder="Detailed description of the expense and its purpose">{{ old('description') }}</textarea>

        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.expenses.index', ['category_id' => $category->id]) }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>

        @if (Auth::user()->hasPermissionTo('create_expense'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.record_expense') }}
          </button>
        @endif
      </div>
    </form>

  </div>
@endsection
