@extends('layouts.admin')

@section('title', 'Expense Ledger')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fa-solid fa-money-check-dollar"></i>
      {{ __('message.expense_for') }}
    </h3>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('admin.expenses.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-red-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_expense'))
          <a href="{{ route('admin.expenses.create', ['category_id' => request('category_id')]) }}"
            class="text-nowrap px-4 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.record_new_expense') }}
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by title, description, or category..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                       focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-red-600 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-600 rounded-lg transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.expenses.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-lg transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- Expense Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse($expenses as $expense)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 @if ($expense->approved_by) border-3 border-dashed border-green-400 dark:border-green-400 @endif">

          {{-- Header: Title & Amount --}}
          <div class="px-4 py-3 bg-red-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-center gap-2">
              <h4 class="font-bold text-lg text-red-600 dark:text-red-400">
                {{ $expense->title }}
              </h4>
              <span class="text-2xl font-extrabold text-red-700 dark:text-red-300">
                ${{ number_format($expense->amount, 2) }}
              </span>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold flex items-center gap-1">
            {{ __('message.category') }}  
              <span class="text-red-600 dark:text-red-400">{{ $expense->category?->name ?? 'N/A' }}</span>
            </p>
          </div>

          {{-- Details --}}
          <div class="p-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
            {{-- Expense Date --}}
            <p
              class="flex items-center gap-1 font-medium text-gray-600 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700/50 py-1">
              <i class="fa-solid fa-calendar-alt text-blue-500"></i>
              {{ __('message.date') }}
              <span class="font-semibold text-gray-800 dark:text-gray-200">
                {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('M d, Y') : 'N/A' }}
              </span>
            </p>

            <p
              class="flex items-center gap-1 font-medium text-gray-600 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700/50 py-1">
              <i class="fa-solid fa-user-edit text-green-500"></i>
              {{ __('message.recorded_by') }}
              <span class="font-semibold text-gray-800 dark:text-gray-200">
                {{ $expense->creator?->name ?? 'Unknown' }}
              </span>
            </p>

            {{-- Approver Status --}}
            <p class="flex justify-between items-center">
              <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
                <i class="fa-solid fa-check-circle text-teal-500"></i>
                {{ __('message.approval') }}
              </span>
              @if ($expense->approved_by)
                <span
                  class="font-bold px-2 py-0.5 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
                  {{ __('message.approved_by__') }} {{ $expense?->approver?->name }}
                </span>
              @else
                <span
                  class="font-bold px-2 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                  {{ __('message.pending') }}
                </span>
              @endif
            </p>

            {{-- Description/Remarks --}}
            @if ($expense->description)
              <div class="pt-2 border-t border-gray-100 dark:border-gray-700/50">
                <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
                  <i class="fa-solid fa-file-alt text-orange-500"></i>
                  {{ __('message.notes') }}
                </span>
                <p class="text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded-lg">
                  {{ Str::limit($expense->description, 100) }}
                </p>
              </div>
            @endif
          </div>

          {{-- Actions --}}
          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">
            <a href="{{ route('admin.expenses.show', $expense->id) }}"
              class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit Expense">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-eye me-2"></i>
                {{-- Show --}}
              </span>
            </a>

            @if (Auth::user()->hasPermissionTo('update_expense') && !$expense->approved_by)
              <a href="{{ route('admin.expenses.edit', $expense->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit Expense">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  {{-- Edit --}}
                </span>
              </a>
            @endif

            {{-- <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this expense record?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete Expense">
                <i class="fa-regular fa-trash-can me-2"></i>
                {{ __('message.delete') }}
              </button>
            </form> --}}
          </div>
        </div>
      @empty
        <div
          class="col-span-full p-6 text-center text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 rounded-lg">
          {{ __('message.no_expense_records_found_click_record_new_expense_to_start') }}
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $expenses->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>

@endsection
