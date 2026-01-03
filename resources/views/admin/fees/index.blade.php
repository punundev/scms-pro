@extends('layouts.admin')

@section('title', 'Fees List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fa-solid fa-file-invoice-dollar me-2"></i>
      {{ __('message.fees_list_of__') }} {{ $selectedFeeType->name ?? 'All' }}
    </h3>

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

    <form action="{{ route('admin.fees.index', ['fee_type_id' => $feeTypeId]) }}" method="GET">
      <input type="hidden" name="fee_type_id" value="{{ $feeTypeId }}">
      <div
        class="p-2 flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_fee'))
          <a href="{{ route('admin.fees.create', ['fee_type_id' => $feeTypeId]) }}"
            class="lg:col-span-1 text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.create_new_fee') }}
          </a>
        @endif

        <div class="lg:col-span-2 xl:col-span-3 flex items-center mt-3 lg:mt-0 gap-2 flex min-w-2/3">
          <select name="status"
            class="border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg py-1.5 px-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
            <option value="">{{ __('message.all_statuses') }}</option>
            @foreach ($statuses as $s)
              <option value="{{ $s }}" @selected(request('status') == $s) class="capitalize">{{ $s }}
              </option>
            @endforeach
          </select>

          <div class="relative w-full flex-grow">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by remarks, amount, student name/email..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-10 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-lg transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>

          <a href="{{ route('admin.fees.index', ['fee_type_id' => $feeTypeId]) }}" id="resetSearch"
            class="p-2 h-8 w-10 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-lg transition-colors"
            title="Reset Filters">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4"
      x-data="paymentsModal()">
      @forelse ($fees as $fee)

        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300
    @if ($fee->status === 'paid') border-dashed border-green-600 dark:border-green-600
    @elseif($fee->due_date && $fee->due_date < now() && $fee->status !== 'paid')
       border-dashed border-red-600 dark:border-red-500 @endif
">

          <div class="px-4 py-1 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize">
                  {{ $fee->student->name ?? 'Student Deleted' }} -
                  ${{ number_format($fee->amount, 2) }}
                </h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                  {{ __('message.category') }} <span
                    class="font-semibold text-indigo-600 dark:text-indigo-400 capitalize">{{ $fee->feeType->name ?? 'Fee Type Deleted' }}</span>
                </p>
              </div>
              <div class="flex">

                <a href="{{ route('admin.fees.show', ['fee' => $fee->id, 'fee_type_id' => $fee->fee_type_id]) }}"
                  class="btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-900 transition-colors"
                  title="View Details">
                  <span class="btn-content">
                    <i class="fa-regular fa-eye"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="p-4 space-y-3">
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-red-50 dark:bg-slate-700 text-red-600 dark:text-red-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.due_date') }}</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('F jS, Y') : 'N/A' }}
                </p>
              </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 002.944 12c.328 1.488.844 2.936 1.551 4.316l-3.35 3.35a1 1 0 001.414 1.414l3.35-3.35c1.38 0.707 2.828 1.223 4.316 1.551a11.955 11.955 0 01-8.618-3.04A12.02 12.02 0 0012 21.056c1.488-.328 2.936-.844 4.316-1.551l3.35 3.35a1 1 0 001.414-1.414l-3.35-3.35c0.707-1.38 1.223-2.828 1.551-4.316a12.02 12.02 0 00.001-8.168z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.status') }}</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 capitalize">
                <p class="text-sm">
                  @if ($fee->status == 'paid')
                    <span
                      class="font-bold px-3 py-0.5 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
                      {{ __('message.paid_on') }} {{ $fee->paid_date ? \Carbon\Carbon::parse($fee->paid_date)->format('M d, Y') : 'N/A' }}
                    </span>
                  @elseif ($fee->status == 'pending' && $fee->due_date && $fee->due_date->isPast())
                    <span
                      class="font-bold px-3 py-0.5 rounded-full text-xs bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">
                      {{ __('message.overdue') }}
                    </span>
                  @else
                    <span
                      class="font-bold px-3 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                      {{ ucfirst($fee->status) }}
                    </span>
                  @endif
                </p>
                </p>
              </div>
            </div>
          </div>

          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            @if ($fee->status != 'paid')
              <a href="#"
                @click.prevent="openModal({{ $fee }}, {{ $fee->feeType }},{{ $fee->student }}, '{{ route('admin.fees.pay', $fee->id) }}')"
                class="btn px-2 py-1 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Add Payment">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-money-bill-transfer me-2"></i>
                  {{ __('message.payment') }}
                </span>
              </a>
            @else
              <a href="{{ route('admin.fees.show', ['fee' => $fee->id, 'fee_type_id' => $fee->fee_type_id]) }}"
                class="btn px-2 py-1 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Paid">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-money-bill-transfer me-2"></i>
                  {{ __('message.invoice') }}
                </span>
              </a>
            @endif

            @if ($fee->status != 'paid')
              <div class="flex">
                @if (Auth::user()->hasPermissionTo('update_fee'))
                  <a href="{{ route('admin.fees.edit', ['fee' => $fee->id, 'fee_type_id' => $fee->fee_type_id]) }}"
                    class="btn px-2 py-1 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                    title="Edit">
                    <span class="btn-content flex items-center justify-center">
                      <i class="fa-solid fa-pen-to-square me-2"></i>
                      {{ __('message.edit') }}
                    </span>
                  </a>
                @endif

                {{-- <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this fee record?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                    title="Delete">
                    <i class="fa-regular fa-trash-can me-2"></i>
                    {{ __('message.delete') }}
                  </button>
                </form> --}}
              </div>
            @endif
          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">{{ __('message.no_fee_records_found') }}</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">{{ __('message.create_your_first_fee_record_to_begin_tracking_student_payments') }}</p>
          </div>
        </div>
      @endforelse

      @include('admin.fees.payment-modal')

    </div>

    <div class="mt-6">
      {{ $fees->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>
  </div>
@endsection
