@extends('layouts.admin')

@section('title', 'Fee Type Details: ' . $feeType->name)

@section('content')

  <div
    class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto">

    <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100 dark:border-gray-700/50">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Fee Type/Finance --}}
        <svg class="size-8 p-1 rounded-full bg-teal-50 text-teal-600 dark:text-teal-50 dark:bg-teal-900"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 6v12m-2.25 1.5h4.5a.75.75 0 00.75-.75V6.75a.75.75 0 00-.75-.75h-4.5a.75.75 0 00-.75.75V18.75a.75.75 0 00.75.75z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12h-6" />
        </svg>
        {{ $feeType->name ?? 'N/A' }} {{ __('message.details') }}
      </h3>

      <div class="flex gap-4">
        <a href="{{ route('admin.students.fees.index', $feeType->id) }}"
          class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors text-base"
          title="Export {{ $feeType->name ?? 'N/A' }}">
          <i class="fa-solid fa-download me-2"></i>
          {{ __('message.export') }} {{ $feeType->name ?? 'N/A' }}
        </a>
        {{-- Back Button --}}
        <a href="{{ route('admin.fee_types.index') }}"
          class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
          <i class="fas fa-arrow-left text-xs"></i> {{ __('message.back_to_fee_types') }}
        </a>
      </div>
    </div>

    {{-- Main Detail Card --}}
    <div class="bg-teal-50 dark:bg-slate-700/30 rounded-lg p-6 space-y-6">

      {{-- Type Name & Total Amount Due --}}
      <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col">
          <h2 class="text-2xl font-extrabold text-teal-700 dark:text-teal-300">
            {{ $feeType->name ?? 'N/A' }}
          </h2>
          <p class="text-sm font-semibold text-teal-500 dark:text-teal-400 mt-1">
            {{ __('message.type_id') }} {{ $feeType->id }}
          </p>
        </div>
        {{-- Calculate and display total amount due for this category --}}
        <span class="text-3xl font-extrabold text-blue-700 dark:text-blue-400 mt-2 sm:mt-0">
          {{ __('message.total_due') }} ${{ number_format($feeType->fees->sum('amount') ?? 0, 2) }}
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
            {{ $feeType->description ?? 'No description provided.' }}
          </span>
        </p>

        {{-- Created At --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-plus text-cyan-500"></i> {{ __('message.created') }}
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $feeType->created_at?->format('M d, Y H:i') ?? 'N/A' }}
          </span>
        </p>

        {{-- Last Updated --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-check text-pink-500"></i> {{ __('message.last_updated') }}
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $feeType->updated_at?->format('M d, Y H:i') ?? 'N/A' }}
          </span>
        </p>
      </div>

      {{-- Associated Fees Section --}}
      <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
        <span class="font-bold text-lg text-gray-700 dark:text-gray-300 flex items-center gap-2 mb-3">
          <i class="fa-solid fa-graduation-cap text-teal-500"></i> {{ __('message.associated_fees') }}
          <span
            class="ml-2 px-3 py-0.5 rounded-full text-xs font-extrabold bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
            {{ __('message.total_fees') }} {{ $feeType->fees->count() }}
          </span>
        </span>
        <div
          class="max-h-96 overflow-y-auto bg-white dark:bg-gray-700 p-3 rounded-lg border border-gray-100 dark:border-gray-600">
          @if ($feeType->fees->isNotEmpty())
            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
              @foreach ($feeType->fees->sortByDesc('due_date') as $fee)
                {{-- Determine color based on status (uses Fee Model accessor logic) --}}
                @php
                  $status = $fee->status;
                  $statusColor =
                      [
                          'paid' => 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-200',
                          'partially_paid' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-200',
                          'unpaid' => 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-200',
                          'overpaid' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-700 dark:text-indigo-200',
                      ][$status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                @endphp

                <li
                  class="flex flex-col sm:flex-row justify-between items-start sm:items-center py-2 px-3 border-b border-gray-50 dark:border-gray-600/50 hover:bg-gray-50 dark:hover:bg-gray-600/50 rounded-sm">
                  {{-- Fee Details (Student Name) --}}
                  <div class="flex flex-col">
                    <span class="font-bold text-base text-gray-800 dark:text-gray-200">
                      {{ __('message.fee_for') }} {{ $fee->student->name ?? 'Student N/A' }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                      {{ __('message.due_date') }} {{ $fee->due_date?->format('M d, Y') ?? 'N/A' }}
                    </span>
                  </div>

                  {{-- Amount and Status --}}
                  <div class="flex items-center gap-4 mt-1 sm:mt-0">
                    <span class="text-lg font-extrabold text-blue-600 dark:text-blue-400">
                      ${{ number_format($fee->amount, 2) }}
                    </span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold uppercase {{ $statusColor }}">
                      {{ str_replace('_', ' ', $status) }}
                    </span>
                  </div>

                </li>
              @endforeach
            </ul>
          @else
            <p class="text-center text-sm italic text-gray-500 dark:text-gray-400">
              {{ __('message.no_fees_have_been_assigned_with_this_fee_type_yet') }}
            </p>
          @endif
        </div>
      </div>

    </div>

    {{-- Action Buttons --}}
    <div class="mt-6 flex justify-end gap-3">

      @if (Auth::user()->hasPermissionTo('update_fee-type'))
        <a href="{{ route('admin.fee_types.edit', $feeType->id) }}"
          class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors"
          title="Edit Fee Type">
          <i class="fa-solid fa-pen-to-square mr-2"></i>
         {{ __('message.edit_type') }}
        </a>
      @endif

      {{-- @if (Auth::user()->hasPermissionTo('delete_fee-type'))
        <form action="{{ route('admin.fee_types.destroy', $feeType->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to permanently delete this fee type? This will not delete associated fees, but they will become uncategorized.');">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors"
            title="Delete Fee Type">
            <i class="fa-regular fa-trash-can mr-2"></i>
            {{ __('message.delete') }}
          </button>
        </form>
      @endif --}}
    </div>
  </div>

@endsection
