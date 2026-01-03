@extends('layouts.admin')
@section('title', 'Fees for: ' . $student->name)
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    {{-- Header Section --}}
    <div class="mb-6 flex justify-between items-start">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <i class="fa-solid fa-dollar-sign"></i>
        Fee Records for: {{ $student->name }}
      </h3>
      <div class="flex space-x-3 mt-1">
        <a href="{{ route('admin.students.show', $student) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <i class="fa-solid fa-person me-2 text-lg"></i>
          Back to Student Details
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    {{-- Fee Record Cards Container (Clones Role Card Structure) --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
      @forelse ($fees as $fee)
        @php
          $totalPaid = $fee->payment_date ? $fee->amount : 0;
          $amountDue = $fee->amount;

          // Status Color Logic
          $statusColor = [
              'Paid' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
              'Due' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
              'Partial' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
              'Draft' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
          ];
          $badgeClass = $statusColor[$fee->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        @endphp

        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Card Header: Fee Type and Status --}}
          <div
            class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200 capitalize truncate"
              title="{{ $fee->feeType->name ?? 'N/A' }}">
              {{ $fee->feeType->name ?? 'N/A Fee' }}
            </h4>
            <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
              {{ $fee->status }}
            </span>
          </div>

          {{-- Card Body: Financial Details --}}
          <div class="p-4 space-y-3">

            {{-- Total Amount --}}
            <div class="flex items-center justify-between gap-3 text-sm">
              <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                  <i class="fa-solid fa-sack-dollar size-5"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Total Amount</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200 text-base">
                    ${{ number_format($fee->amount, 2) }}
                  </p>
                </div>
              </div>

              {{-- Due Date --}}
              <div class="text-right">
                <p class="text-xs text-gray-500 dark:text-gray-400">Due Date</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 text-sm">
                  <i class="fa-regular fa-calendar-days text-gray-400 dark:text-gray-500"></i>
                  {{ $fee->due_date?->format('M d, Y') ?? 'N/A' }}
                </p>
              </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            {{-- Paid / Due Status --}}
            <div class="flex justify-between gap-4">

              {{-- Paid --}}
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                  <i class="fa-solid fa-check size-5"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Amount Paid</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200 text-base text-green-600 dark:text-green-400">
                    ${{ number_format($totalPaid, 2) }}
                  </p>
                </div>
              </div>

              {{-- Due --}}
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-red-50 dark:bg-slate-700 text-red-600 dark:text-red-300">
                  <i class="fa-solid fa-bell size-5"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Amount Due</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200 text-base text-red-600 dark:text-red-400">
                    ${{ number_format($amountDue, 2) }}
                  </p>
                </div>
              </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            {{-- Created By --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-gray-300">
                <i class="fa-solid fa-user-tag size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Record Created By</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $fee->creator->name ?? 'System' }}
                </p>
              </div>
            </div>

          </div>

          {{-- Card Footer: Actions (View/Edit/Add Payment) --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            {{-- Example: View Details Button --}}
            <a href="{{ route('admin.fees.show', $fee) }}"
              class="btn px-3 py-1 rounded-full flex items-center cursor-pointer text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-slate-600 transition-colors"
              title="View Fee Details">
              <i class="fa-solid fa-eye me-2"></i>
              View
            </a>

          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <i class="fa-regular fa-face-frown h-8 w-8 text-red-400 dark:text-red-500"></i>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Fee Records</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">There are no financial records associated with this
              student.
            </p>
            <a href="{{ route('admin.students.fees.create', $student) }}"
              class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                  clip-rule="evenodd" />
              </svg>
              Create First Fee Record
            </a>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Fee Records --}}

    <div class="mt-6">
      {{ $fees->links() }}
    </div>

  </div>
@endsection
