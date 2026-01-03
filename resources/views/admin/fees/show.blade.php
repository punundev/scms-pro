@extends('layouts.admin')

@section('title', 'Invoice: ' . $fee->id)

@section('content')

  @php
    $student = $fee->student;
    $enrollment = $fee->enrollment;
    $courseOffering = $enrollment?->courseOffering;
    $subject = $courseOffering?->subject;
    $teacher = $courseOffering?->teacher;
    $currency = $currency ?? '$'; // Default currency if not set
  @endphp

  <div
    class="invoice-container max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg border border-gray-200 dark:border-gray-700 relative mb-10">

    {{-- 1. PAID Watermark Implementation --}}
    @if ($fee->status == 'paid')
      <div
        class="invoice-watermark absolute inset-0 flex items-center justify-center pointer-events-none opacity-10 z-10 text-red-600 dark:text-red-400">
        <span
          class="text-9xl font-extrabold transform rotate-[-45deg] border-8 border-red-600 dark:border-red-400 px-16 py-8 rounded-xl tracking-wider">
          {{ __('message.paid') }}
        </span>
      </div>
    @endif
    {{-- End Watermark --}}

    <div
      class="flex items-center justify-between mb-4 border-b pb-4 border-gray-100 dark:border-gray-700/50 print:hidden z-20">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-file-invoice text-blue-600 dark:text-blue-400"></i>
        {{ __('message.fee_invoice_preview') }}
      </h3>
      <div class="flex gap-2">
        @if ($fee->status == 'paid')
          <button onclick="window.print()"
            class="text-nowrap px-4 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-1 text-sm font-semibold">
            <i class="fas fa-print"></i> {{ __('message.print_invoice') }}
          </button>
        @endif

        <a href="{{ route('admin.fees.index') }}"
          class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
          <i class="fas fa-arrow-left text-xs"></i> {{ __('message.back_to_fees') }}
        </a>
      </div>
    </div>

    <div class="flex justify-between items-start mb-4 z-20">
      <div>
        <h1 class="text-3xl font-extrabold text-blue-800 dark:text-blue-400 mb-1">
          {{ config('app.name') }} G2
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $school_address ?? '123 School Lane, City, Country' }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          {{ $school_contact ?? 'Email: info@school.com | Phone: (123) 456-7890' }}
        </p>

        <div class="mt-4">
          @if ($subject)
            <p class="font-semibold text-gray-900 dark:text-gray-100">Course: {{ $subject->name }}</p>
            <p class="text-gray-600 dark:text-gray-400">Teacher: {{ $teacher?->name ?? 'N/A' }}</p>
            <p class="text-gray-600 dark:text-gray-400">
              {{ __('message.payment_type') }} <span class="font-medium uppercase">{{ $courseOffering->payment_type ?? 'N/A' }}</span>
            </p>
          @else
            <p class="text-gray-600 dark:text-gray-400">{{ __('message.general_fee_(no_enrollment)') }}</p>
          @endif
          <p class="text-gray-600 dark:text-gray-400">{{ __('message.fee_type') }} {{ $fee->feeType?->name ?? 'N/A' }}</p>
        </div>
      </div>

      <div class="text-right z-20">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ __('message.invoice') }}</h2>
        <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">
          {{ $fee->transaction_id }}
        </p>

        @if ($fee->transaction_id)
          <div
            class="mt-4 p-1 inline-block bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-lg rounded-md">
            <div class="relative w-24 h-24 mx-auto">
              <img
                src="https://tool.konkmeng.site/api/qrcode?size=500&fg=00000&content={{ urlencode(route('invoice.check', ['transactionId' => $fee->transaction_id])) }}"
                alt="QR Code for Transaction {{ $fee->transaction_id }}" class="w-full h-full" loading="lazy">

              <img src="{{ asset('assets/images/khmer.svg') }}" alt="Khmer Icon"
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4" loading="lazy">
            </div>
          </div>
        @endif
      </div>
    </div>

    <div
      class="flex justify-between gap-2 text-sm mb-4 p-3 py-6 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-l-4 border-blue-500 dark:border-blue-400 z-20">

      <div>
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">{{ __('message.bill_to') }}</h4>
        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $student?->name ?? 'N/A' }}</p>
        <p class="text-gray-600 dark:text-gray-400">Email: {{ $student?->email ?? 'N/A' }}</p>
        <p class="text-gray-600 dark:text-gray-400">Phone: {{ $student?->phone ?? 'N/A' }}</p>
        <p class="text-gray-600 dark:text-gray-400">Address: {{ $student?->address ?? 'N/A' }}</p>
      </div>

      <div class="text-right">
        <h4 class="font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">{{ __('message.invoice_status') }}</h4>
        @php
          $statusColor = 'yellow';
          $statusText = strtoupper($fee->status);
          if ($fee->status == 'paid') {
              $statusColor = 'teal';
              $statusText = 'PAID IN FULL';
          } elseif ($fee->status == 'unpaid' && $fee->due_date && \Carbon\Carbon::parse($fee->due_date)->isPast()) {
              $statusColor = 'red';
              $statusText = 'OVERDUE';
          }
        @endphp
        <span
          class="font-bold px-4 py-1 rounded-full text-md bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 dark:bg-{{ $statusColor }}-900 dark:text-{{ $statusColor }}-300">
          {{ $statusText }}
        </span>
        <p class="text-gray-900 dark:text-gray-100 mt-2">
          <span class="font-medium">{{ __('message.issue_date') }}</span> {{ $fee->created_at->format('M d, Y') }}
        </p>
        <p class="font-semibold text-red-600 dark:text-red-400">
          <span class="font-medium text-gray-700 dark:text-gray-300">{{ __('message.due_date') }}</span>
          {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : 'N/A' }}
        </p>
      </div>
    </div>

    <div class="mb-4 overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg z-20">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              {{ __('message.fee_description') }}
            </th>
            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider dark:text-gray-300">
              {{ __('message.amount') }} ({{ $currency }})
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100">
              {{ $fee->feeType?->name ?? 'Unknown Fee Type' }}
              @if ($enrollment)
                <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                  {{ $fee->description ?? "Enrollment fee for {$subject?->name}" }}
                </p>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-base font-semibold text-gray-900 dark:text-gray-100">
              {{ $currency }}{{ number_format($fee->amount, 2) }}
            </td>
          </tr>

          @php
            $totalPaid = $fee->status == 'paid' ? $fee->amount : 0;
            $balanceDue = $fee->amount - $totalPaid;
          @endphp

          @if ($totalPaid > 0 && $fee->payment_date)
            <tr class="bg-teal-50/50 dark:bg-teal-900/30">
              <td class="px-6 py-1 text-sm text-left font-medium text-teal-700 dark:text-teal-300">
                {{ __('message.payments_received') }} ({{ $fee->payment_method ?? 'N/A' }})
              </td>
              <td class="px-6 py-1 text-sm text-right font-bold text-teal-700 dark:text-teal-300">
                -{{ $currency }}{{ number_format($totalPaid, 2) }}
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <div class="flex flex-col md:flex-row justify-between gap-8 z-20">

      <div class="md:w-1/2 space-y-1">
        <h4 class="text-sm font-bold uppercase text-gray-700 dark:text-gray-300 mb-2">{{ __('message.payment/transaction_info') }}</h4>
        <p class="text-sm text-gray-700 dark:text-gray-300">
          <span class="font-semibold">{{ __('message.payment_date') }}</span>
          <span class="font-medium text-blue-600 dark:text-blue-400">
            {{ $fee->payment_date ? \Carbon\Carbon::parse($fee->payment_date)->format('M d, Y h:i A') : 'N/A' }}
          </span>
        </p>
        <p class="text-sm text-gray-700 dark:text-gray-300">
          <span class="font-semibold">Method:</span>
          {{ $fee->payment_method ? strtoupper($fee->payment_method) : 'N/A' }}
        </p>
        <p class="text-sm text-gray-700 dark:text-gray-300">
          <span class="font-semibold">{{ __('message.transaction_id') }}</span>
          {{ $fee->transaction_id ?? 'N/A' }}
        </p>
        <p class="text-sm text-gray-700 dark:text-gray-300">
          <span class="font-semibold">{{ __('message.received_by') }}</span>
          {{ $fee->receiver?->name ?? 'N/A' }}
        </p>
      </div>

      <div class="md:w-1/2 space-y-3">
        <div class="flex justify-between">
          <span class="text-base font-semibold text-gray-600 dark:text-gray-400">{{ __('message.total_fee') }}</span>
          <span class="text-base font-semibold text-gray-800 dark:text-gray-200">
            {{ $currency }}{{ number_format($fee->amount, 2) }}
          </span>
        </div>

        <div
          class="flex justify-between py-3 border-t-2 border-b-2 border-blue-400 dark:border-blue-700/50 bg-blue-50 dark:bg-blue-900/30 p-2 rounded @if ($balanceDue) border-red-400 dark:border-red-700/50 bg-red-50 dark:bg-red-900/30 @endif">
          <span class="text-xl font-extrabold text-blue-700 dark:text-blue-300">{{ __('message.balance_due') }}</span>
          <span class="text-2xl font-extrabold text-blue-700 dark:text-blue-300">
            {{ $currency }}{{ number_format($balanceDue, 2) }}
          </span>
        </div>
      </div>
    </div>

    <div class="mt-8 z-20">
      <h4 class="text-sm font-bold uppercase text-gray-700 dark:text-gray-300 mb-1">{{ __('message.remarks') }}</h4>
      <p class="text-sm italic text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 p-3 rounded-lg min-h-20">
        {{ $fee->remarks ?? 'Please ensure payment is made by the due date.' }}
      </p>
    </div>

    <div class="mt-10 pt-2 border-t border-gray-200 dark:border-gray-700/50 text-center z-20">
      <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('message.thank_you') }}</p>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
        {{ __('message.developed_by') }} {{ config('app.name') }} - {{ __('message.g2_developer_support_on') }} {{ now()->format('M d, Y h:i A') }}
      </p>
    </div>

  </div>

@endsection

@push('styles')
  <style>
    @media print {
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color: #000 !important;
        background: #fff !important;
        box-shadow: none !important;
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

      .invoice-container,
      .invoice-container * {
        visibility: visible !important;
      }

      .invoice-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100% !important;
        padding: 10mm !important;
        background: #fff !important;
        margin: 0 !important;
        border: none !important;
        box-shadow: none !important;
      }

      .invoice-watermark {
        opacity: 0.2 !important;
      }

      @page {
        size: A4;
        margin: 10mm;
      }

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .invoice-container {
        transform: scale(0.92);
        transform-origin: top left;
      }

      .dark * {
        color: #000 !important;
        background: #fff !important;
      }
    }
  </style>
@endpush
