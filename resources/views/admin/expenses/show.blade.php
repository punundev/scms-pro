@extends('layouts.admin')

@section('title', 'Expense Report: ' . $expense->title)

@section('content')

  @php
    // Check if the expense is approved for the watermark logic
    $isApproved = !empty($expense->approved_by);
    $currency = $currency ?? '$'; // Assuming currency is available or default to $
    $school_address = $school_address ?? '123 Finance Office, Central Admin, City';
    $school_contact = $school_contact ?? 'Email: finance@school.com | Phone: (123) 456-7890';
  @endphp

  <div
    class="report-container max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700 relative">

    {{-- 1. APPROVED Watermark Implementation --}}
    @if ($isApproved)
      <div
        class="report-watermark absolute inset-0 flex items-center justify-center pointer-events-none opacity-10 z-10 text-teal-600 dark:text-teal-400">
        <span
          class="text-9xl font-extrabold transform rotate-[-45deg] border-8 border-teal-600 dark:border-teal-400 px-16 py-8 rounded-xl tracking-wider">
          {{ __('message.approved') }}
        </span>
      </div>
    @endif
    {{-- End Watermark --}}

    {{-- Header & Actions --}}
    <div
      class="flex items-center justify-between mb-8 border-b pb-4 border-gray-100 dark:border-gray-700/50 print:hidden z-20">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-file-invoice-dollar text-red-600 dark:text-red-400"></i>
        {{ __('message.expense_report_preview') }}
      </h3>
      <div class="flex gap-2">
        <button onclick="window.print()"
          class="text-nowrap px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-1 text-sm font-semibold">
          <i class="fas fa-print"></i> {{ __('message.print_report') }}
        </button>
        <a href="{{ route('admin.expenses.index', ['category_id' => $expense->expense_category_id]) }}"
          class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
          <i class="fas fa-arrow-left text-xs"></i> {{ __('message.back_to_ledger') }}
        </a>
      </div>
    </div>

    {{-- Report Info Block (Top Left & Right) --}}
    <div class="flex justify-between items-start mb-8 z-20">
      <div>
        <h1 class="text-3xl font-extrabold text-red-800 dark:text-red-400 mb-1">
          {{ config('app.name') }}-G2
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $school_address }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ $school_contact }}
        </p>

        <div class="mt-4">
          <p class="font-semibold text-gray-900 dark:text-gray-100">Category: {{ $expense->category?->name ?? 'N/A' }}</p>
          <p class="text-gray-600 dark:text-gray-400">{{ __('message.recorded_by') }} {{ $expense->creator?->name ?? 'Unknown' }}</p>
        </div>
      </div>

      <div class="text-right z-20">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ __('message.expense_report') }}</h2>
        <p class="text-lg font-semibold text-red-600 dark:text-red-400">
          #EXP-{{ str_pad($expense->id, 6, '0', STR_PAD_LEFT) }}
        </p>
        <p class="text-gray-600 dark:text-gray-400 mt-1">
          {{ __('message.date') }} {{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('M d, Y') : 'N/A' }}
        </p>
      </div>
    </div>

    {{-- Status Block --}}
    <div
      class="flex justify-between gap-2 text-sm mb-8 p-3 py-6 bg-red-50 dark:bg-red-900/30 rounded-lg border border-l-4 border-red-500 dark:border-red-400 z-20">

      <div>
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">{{ __('message.expense_title') }}</h4>
        <p class="text-xl font-extrabold text-red-700 dark:text-red-300">{{ $expense->title ?? 'N/A' }}</p>
      </div>

      <div class="text-right">
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">{{ __('message.approval_status') }}</h4>
        @php
          $statusColor = $isApproved ? 'teal' : 'yellow';
          $statusText = $isApproved ? 'APPROVED' : 'PENDING';
        @endphp
        <span
          class="font-bold px-4 py-1 rounded-full text-md bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 dark:bg-{{ $statusColor }}-900 dark:text-{{ $statusColor }}-300">
          {{ $statusText }}
        </span>
        <p class="text-gray-900 dark:text-gray-100 mt-2">
          <span class="font-medium">{{ __('message.recorded_at') }}</span> {{ $expense->created_at->format('M d, Y h:i A') }}
        </p>
      </div>
    </div>

    {{-- Expense Details Table (Simplified to single row) --}}
    <div class="mb-8 overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg z-20">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              {{ __('message.description') }}
            </th>
            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              {{ __('message.total_amount') }} ({{ $currency }})
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
          <tr>
            <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100">
              {{ $expense->title ?? 'General Expense' }}
              <p class="text-xs font-normal text-gray-500 dark:text-gray-400 mt-1">
                {{ __('message.category') }} {{ $expense->category?->name ?? 'N/A' }}
              </p>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-3xl font-extrabold text-red-700 dark:text-red-300">
              {{ $currency }}{{ number_format($expense->amount, 2) }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- Approval and Description Blocks --}}
    <div class="flex flex-col md:flex-row justify-between gap-8 z-20">

      <div class="md:w-1/2 space-y-3">
        <h4 class="text-sm font-bold uppercase text-gray-700 dark:text-gray-300 mb-2">{{ __('message.approval_details') }}</h4>
        @if ($isApproved)
          <div class="p-3 bg-teal-50 dark:bg-teal-900/50 border border-teal-200 dark:border-teal-700 rounded-lg">
            <p class="text-sm text-teal-700 dark:text-teal-300">
              <span class="font-semibold">{{ __('message.approved_by') }}</span>
              {{ $expense->approver?->name ?? 'System' }}
            </p>
            <p class="text-sm text-teal-700 dark:text-teal-300 mt-1">
              <span class="font-semibold">Approval Date:</span>
              {{ $expense->approved_at ? \Carbon\Carbon::parse($expense->approved_at)->format('M d, Y h:i A') : 'N/A' }}
            </p>
          </div>
        @else
          <div class="p-3 bg-yellow-50 dark:bg-yellow-900/50 border border-yellow-200 dark:border-yellow-700 rounded-lg">
            <p class="text-sm text-yellow-700 dark:text-yellow-300 font-medium">
              {{ __('message.this_expense_is_currently_pending_review_and_approval') }}
            </p>
          </div>
        @endif
      </div>

      <div class="md:w-1/2 space-y-1">
        <h4 class="text-sm font-bold uppercase text-gray-700 dark:text-gray-300 mb-2">{{ __('message.description_/_remarks') }}</h4>
        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg min-h-20">
          <p class="text-sm italic text-gray-700 dark:text-gray-300">
            {{ $expense->description ?? 'No detailed description provided for this expense.' }}
          </p>
        </div>
      </div>
    </div>

    {{-- Action Buttons (Visible only on screen) --}}
    <div class="mt-8 flex justify-end gap-3 print:hidden z-20">

      @unless ($isApproved)
        {{-- Approval Button (Only visible if NOT approved) --}}
        <form action="{{ route('admin.expenses.approve', $expense->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to approve this expense?');">
          @csrf
          <button type="submit"
            class="p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-teal-600 text-white hover:bg-teal-700 transition-colors font-semibold"
            title="Approve Expense">
            <i class="fa-solid fa-thumbs-up mr-2"></i>
            {{ __('message.approve_expense') }}
          </button>
        </form>
      @endunless

      @if (!$isApproved)
        <a href="{{ route('admin.expenses.edit', $expense->id) }}"
          class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors font-semibold"
          title="Edit Expense">
          <i class="fa-solid fa-pen-to-square mr-2"></i>
          {{ __('message.edit') }}
        </a>

        <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to permanently delete this expense record?');">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors font-semibold"
            title="Delete Expense">
            <i class="fa-regular fa-trash-can mr-2"></i>
            {{ __('message.delete') }}
          </button>
        </form>
      @endif
    </div>

    <div class="mt-10 pt-2 border-t border-gray-200 dark:border-gray-700/50 text-center z-20">
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        {{ __('message.record_id') }} EXP-{{ $expense->id }} | {{ __('message.report_generated_on') }} {{ now()->format('M d, Y h:i A') }}
      </p>
    </div>

  </div>

@endsection

@push('styles')
  <style>
    @media print {

      /* General Print Reset */
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color: #000 !important;
        background: #fff !important;
        box-shadow: none !important;
        border-color: #eee !important;
      }

      .sidebar,
      .main-header,
      .main-footer,
      .admin-toolbar,
      .print\:hidden {
        display: none !important;
      }

      body {
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
      }

      body * {
        visibility: hidden !important;
      }

      .report-container,
      .report-container * {
        visibility: visible !important;
        z-index: 99 !important;
        /* Ensure content is above everything */
      }

      /* Container Setup */
      .report-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        padding: 10mm !important;
        background: #fff !important;
        margin: 0 !important;
        border: none !important;
        box-shadow: none !important;
        min-height: 297mm;
      }

      /* Watermark Specific Print Style */
      .report-watermark {
        opacity: 0.1 !important;
        color: #047857 !important;
        /* Teal for Approved */
        border-color: #047857 !important;
      }

      /* Page Setup */
      @page {
        size: A4;
        margin: 10mm;
      }

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      /* Scale down slightly if needed */
      .report-container {
        transform: scale(0.92);
        transform-origin: top left;
      }

      /* Ensure dark mode colors are converted to black on white for print */
      .dark * {
        color: #000 !important;
        background: #fff !important;
      }
    }
  </style>
@endpush
