@extends('layouts.admin')
@section('title', 'Create New Expense Category')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Expense Categories (tag icon) --}}
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7a1 1 0 010-1.414l7-7a1 1 0 011.414 0l7 7zM9 10a1 1 0 100 2 1 1 0 000-2z"
            clip-rule="evenodd" />
        </svg>
        {{ __('message.create_new_expense_category') }}
        {{-- {{ __('message.create_new_expense_category') }} --}}
      </h3>
      <a href="{{ route('admin.expense_categories.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    {{-- Form submits to the store method --}}
    <form action="{{ route('admin.expense_categories.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <div class="grid grid-cols-1 gap-4 mb-4">

        {{-- Category Name Field --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
           {{ __('message.category_name') }}  <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('name') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., Software Subscriptions, Travel Expenses" required>
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      {{-- Category Description Field --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {{ __('message.description') }}
        </label>
        <textarea id="description" name="description" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('description') border-red-500 @else border-gray-400 @enderror"
          placeholder="Briefly describe what this category is used for">{{ old('description') }}</textarea>

        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.expense_categories.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>
        @if (Auth::user()->hasPermissionTo('create_expense-category'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.create_category') }}
          </button>
        @endif
      </div>
    </form>
  </div>
@endsection
