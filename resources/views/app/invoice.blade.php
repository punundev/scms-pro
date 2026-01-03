<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice: {{ $fee->transaction_id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJz9y6p8s5Wd+W1F+kG6tB8x5p8JgW5E/H3X/YvK+b7/4M2/vN/R+y4z4/w+g=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap"
      rel="stylesheet">

    <style>
      @media print {
        * {
          -webkit-print-color-adjust: exact !important;
          print-color-adjust: exact !important;
          color: #000 !important;
          background: #fff !important;
          box-shadow: none !important;
          font-family: "Kantumruy Pro", sans-serif;
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
      }
    </style>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Kantumruy Pro', 'sans-serif'],
            },
          }
        }
      }
    </script>
  </head>

  <body class="bg-gray-100 p-0 min-h-screen">

    @php
      $student = $fee->student;
      $enrollment = $fee->enrollment;
      $courseOffering = $enrollment?->courseOffering;
      $subject = $courseOffering?->subject;
      $teacher = $courseOffering?->teacher;
      $currency = $currency ?? '$';

      $totalPaid = $fee->status == 'paid' ? $fee->amount : 0;
      $balanceDue = $fee->amount - $totalPaid;

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

    <div
      class="invoice-container max-w-4xl mx-auto p-6 bg-white shadow-xl sm:rounded-lg border border-gray-200 relative">

      @if ($fee->status == 'paid')
        <div
          class="invoice-watermark absolute inset-0 flex items-center justify-center pointer-events-none opacity-10 z-10 text-red-600">
          <span
            class="text-9xl font-extrabold transform rotate-[-45deg] border-8 border-red-600 px-16 py-8 rounded-xl tracking-wider">
            PAID
          </span>
        </div>
      @endif

      <div class="flex justify-between items-start mb-4 z-20">
        <div>
          <h1 class="text-3xl font-extrabold text-blue-800 mb-1">
            {{ config('app.name') }}
          </h1>
          <p class="text-sm text-gray-600">{{ $school_address ?? '123 School Lane, City, Country' }}
          </p>
          <p class="text-sm text-gray-600">
            {{ $school_contact ?? 'Email: info@school.com | Phone: (123) 456-7890' }}
          </p>

          <div class="mt-4">
            @if ($subject)
              <p class="font-semibold text-gray-900">Course: {{ $subject->name }}</p>
              <p class="text-gray-600">Teacher: {{ $teacher?->name ?? 'N/A' }}</p>
              <p class="text-gray-600">
                Payment Type: <span class="font-medium uppercase">{{ $courseOffering->payment_type ?? 'N/A' }}</span>
              </p>
            @else
              <p class="text-gray-600">General Fee (No Enrollment)</p>
            @endif
            <p class="text-gray-600">Fee Type: {{ $fee->feeType?->name ?? 'N/A' }}</p>
          </div>
        </div>

        <div class="text-right z-20">
          <h2 class="text-4xl font-extrabold text-gray-900 mb-1">INVOICE</h2>
          <p class="text-lg font-semibold text-blue-600">
            {{ $fee->transaction_id }}
          </p>
          {{-- @if ($fee->transaction_id)
            <div class="mt-4 p-1 inline-block bg-white border border-gray-200 shadow-lg rounded-md">
              <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ urlencode(route('invoice.check', ['transactionId' => $fee->transaction_id])) }}"
                alt="QR Code for Transaction {{ $fee->transaction_id }}" class="w-24 h-24 mx-auto" loading="lazy">
            </div>
          @endif --}}
          @if ($fee->transaction_id)
            <div
              class="mt-4 p-1 inline-block bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-lg rounded-md">
              <div class="relative w-24 h-24 mx-auto">
                <img
                  src="https://tool.konkmeng.site/api/qrcode?size=500&fg=007A28&content={{ urlencode(route('invoice.check', ['transactionId' => $fee->transaction_id])) }}"
                  alt="QR Code for Transaction {{ $fee->transaction_id }}" class="w-full h-full" loading="lazy">

                <img src="{{ asset('assets/images/khmer.svg') }}" alt="Khmer Icon"
                  class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4" loading="lazy">
              </div>
            </div>
          @endif

        </div>
      </div>

      <div
        class="flex justify-between gap-2 text-sm mb-4 p-3 py-6 bg-gray-50 rounded-lg border border-l-4 border-blue-500 z-20">

        <div>
          <h4 class="font-bold uppercase text-gray-700 mb-1">Bill To:</h4>
          <p class="font-semibold text-gray-900">{{ $student?->name ?? 'N/A' }}</p>
          <p class="text-gray-600">Email: {{ $student?->email ?? 'N/A' }}</p>
          <p class="text-gray-600">Phone: {{ $student?->phone ?? 'N/A' }}</p>
          <p class="text-gray-600">Address: {{ $student?->address ?? 'N/A' }}</p>
        </div>

        <div class="text-right">
          <h4 class="font-bold uppercase text-gray-700 mb-1">Invoice Status:</h4>
          <span
            class="font-bold px-4 py-1 rounded-full text-md bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700">
            {{ $statusText }}
          </span>
          <p class="text-gray-900 mt-2">
            <span class="font-medium">Issue Date:</span> {{ $fee->created_at->format('M d, Y') }}
          </p>
          <p class="font-semibold text-red-600">
            <span class="font-medium text-gray-700">Due Date:</span>
            {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : 'N/A' }}
          </p>
        </div>
      </div>

      <div class="mb-4 overflow-x-auto border border-gray-200 rounded-lg z-20">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                Fee Description
              </th>
              <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                Amount ({{ $currency }})
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                {{ $fee->feeType?->name ?? 'Unknown Fee Type' }}
                @if ($enrollment)
                  <p class="text-xs font-normal text-gray-500">
                    {{ $fee->description ?? "Enrollment fee for {$subject?->name}" }}
                  </p>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-base font-semibold text-gray-900">
                {{ $currency }}{{ number_format($fee->amount, 2) }}
              </td>
            </tr>

            @if ($totalPaid > 0 && $fee->payment_date)
              <tr class="bg-teal-50/50">
                <td class="px-6 py-2 text-sm text-left font-medium text-teal-700">
                  Payments Received ({{ $fee->payment_method ?? 'N/A' }})
                </td>
                <td class="px-6 py-2 text-sm text-right font-bold text-teal-700">
                  -{{ $currency }}{{ number_format($totalPaid, 2) }}
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>

      <div class="flex flex-col md:flex-row justify-between gap-8 z-20">

        <div class="md:w-1/2 space-y-1">
          <h4 class="text-sm font-bold uppercase text-gray-700 mb-2">Payment/Transaction Info:</h4>
          <p class="text-sm text-gray-700">
            <span class="font-semibold">Payment Date:</span>
            <span class="font-medium text-blue-600">
              {{ $fee->payment_date ? \Carbon\Carbon::parse($fee->payment_date)->format('M d, Y h:i A') : 'N/A' }}
            </span>
          </p>
          <p class="text-sm text-gray-700">
            <span class="font-semibold">Method:</span>
            {{ $fee->payment_method ? strtoupper($fee->payment_method) : 'N/A' }}
          </p>
          <p class="text-sm text-gray-700">
            <span class="font-semibold">Transaction ID:</span>
            {{ $fee->transaction_id ?? 'N/A' }}
          </p>
          <p class="text-sm text-gray-700">
            <span class="font-semibold">Received By:</span>
            {{ $fee->receiver?->name ?? 'N/A' }}
          </p>
        </div>

        <div class="md:w-1/2 space-y-3">
          <div class="flex justify-between">
            <span class="text-base font-semibold text-gray-600">Total Fee:</span>
            <span class="text-base font-semibold text-gray-800">
              {{ $currency }}{{ number_format($fee->amount, 2) }}
            </span>
          </div>

          <div class="flex justify-between py-3 border-t-2 border-b-2 border-blue-400 bg-blue-50 p-2 rounded">
            <span class="text-xl font-extrabold text-blue-700">BALANCE DUE:</span>
            <span class="text-2xl font-extrabold text-blue-700">
              {{ $currency }}{{ number_format($balanceDue, 2) }}
            </span>
          </div>
        </div>
      </div>

      <div class="mt-8 z-20">
        <h4 class="text-sm font-bold uppercase text-gray-700 mb-1">Remarks:</h4>
        <p class="text-sm italic text-gray-700 bg-gray-100 p-3 rounded-md min-h-20">
          {{ $fee->remarks ?? 'Please ensure payment is made by the due date.' }}
        </p>
      </div>

      <div class="mt-10 pt-2 border-t border-gray-200 text-center z-20">
        <p class="text-lg font-semibold text-gray-800">Thank You!</p>
        <p class="text-sm text-gray-500 mt-2">
          Developed by {{ config('app.name') }} - G2 Developer Support on {{ now()->format('M d, Y h:i A') }}
        </p>
      </div>

    </div>
  </body>

</html>
