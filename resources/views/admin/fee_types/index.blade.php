@extends('layouts.admin')

@section('title', 'Fee Types List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fa-solid fa-sack-dollar me-2"></i>
      {{ __('message.fee_types_list') }}
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

    <form action="{{ route('admin.fee_types.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_fee-type'))
          <a href="{{ route('admin.fee_types.create') }}"
            class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.create_new_fee_type') }}
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search fee types..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-lg transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.fee_types.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-lg transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-4">
      @forelse ($feeTypes as $feeType)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          <div class="px-4 py-1 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $feeType->name }}</h4>
              </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
              {{ Str::limit($feeType->description, 100, '...') ?? 'N/A' }}
            </p>
          </div>

          <div class="p-4 space-y-3">
            {{-- Fees Count --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-pink-50 dark:bg-slate-700 text-pink-600 dark:text-pink-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM5 14h14M5 18h14M5 6h14" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.total_fees_used') }}</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span>{{ $feeType->fees_count }}</span>
                </p>
              </div>
            </div>
          </div>

          {{-- Actions (Edit Link + Delete Form) --}}
          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <div class="flex">
              @if (Auth::user()->hasPermissionTo('create_fee'))
                <a href="{{ route('admin.fees.index', ['fee_type_id' => $feeType->id]) }}"
                  class="btn py-1 px-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Admission Register">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-book-atlas me-2"></i>
                    {{ __('message.register') }}
                  </span>
                </a>
              @endif
            </div>

            <div class="flex items-center">
              <a href="{{ route('admin.fee_types.show', $feeType->id) }}"
                class="btn py-1 px-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="View Details">
                <span class="btn-content">
                  <i class="fa-solid fa-eye me-2"></i>
                  {{-- Show --}}
                </span>
              </a>

              @if (Auth::user()->hasPermissionTo('create_fee-type'))
                <a href="{{ route('admin.fee_types.edit', $feeType->id) }}"
                  class="btn py-1 px-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    {{-- Edit --}}
                  </span>
                </a>
              @endif

              {{-- Delete Button (Full form submission) --}}
              {{-- <form action="{{ route('admin.fee_types.destroy', $feeType->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this Fee Type? This action cannot be undone.');">
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">{{ __('message.no_fee_types_found') }}</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">{{ __('message.create_your_first_fee_type_to_get_started') }}
            </p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $feeTypes->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
