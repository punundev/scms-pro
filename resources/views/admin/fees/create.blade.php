@extends('layouts.admin')
@section('title', 'Create New Fee Record')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <line x1="12" y1="1" x2="12" y2="23"></line>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
        {{ __('message.create_new_fee_record') }}
      </h3>
      <a href="{{ route('admin.fees.index', ['fee_type_id' => $feeTypeId]) }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    {{-- Error Message Display --}}
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    {{-- Form submits to the store method --}}
    <form action="{{ route('admin.fees.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">

        {{-- 1. Student Field --}}
        {{-- <div>
          <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.student') }} <span class="text-red-500">*</span>
          </label>
          <select id="student_id" name="student_id"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('student_id') border-red-500 @else border-gray-400 @enderror"
            required>
            <option value="">{{ __('message.select_a_student') }}</option>
            @foreach ($students as $student)
              <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                {{ $student->name }} ({{ $student->email }})
              </option>
            @endforeach
          </select>
          @error('student_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}
        <x-fields.select name="student" label="Student" :required="true" :options="$students" placeholder="Choose student"
          searchable="true" />

        {{-- 2. Fee Type Field --}}
        <div>
          <label for="fee_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Fee Type <span class="text-red-500">*</span>
          </label>
          <select id="fee_type_id" name="fee_type_id"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('fee_type_id') border-red-500 @else border-gray-400 @enderror"
            required>
            <option value="">{{ __('message.select_fee_type') }}</option>
            @foreach ($feeTypes as $feeType)
              <option value="{{ $feeType->id }}" @selected(old('fee_type_id') == $feeType->id)>
                {{ $feeType->name }}
              </option>
            @endforeach
          </select>
          @error('fee_type_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 3. Amount Field --}}
        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Amount ($) <span class="text-red-500">*</span>
          </label>
          <input type="number" step="0.01" min="0" id="amount" name="amount" value="{{ old('amount') }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('amount') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., 500.00" required>
          @error('amount')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 4. Due Date Field --}}
        <div>
          <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.due_date_(optional)') }}
          </label>
          <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
            class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('due_date') border-red-500 @else border-gray-400 @enderror">
          @error('due_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      {{-- 6. Remarks Field --}}
      <div class="mb-6">
        <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {{ __('message.remarks_(optional)') }}
        </label>
        <textarea id="remarks" name="remarks" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('remarks') border-red-500 @else border-gray-400 @enderror"
          placeholder="Any specific notes regarding this fee, payment plan details, etc.">{{ old('remarks') }}</textarea>

        @error('remarks')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.fees.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>

        @if (Auth::user()->hasPermissionTo('create_fee'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-plus me-2"></i>
            {{ __('message.create_fee_record') }}
          </button>
        @endif
      </div>
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof $ !== 'undefined') {
        $.ajaxSetup({
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // 'Accept': 'application/json'
          }
        });
      }
      selectfields = function() {
        document.querySelectorAll('.custom-select').forEach(select => {
          const header = select.querySelector('.select-header');
          const optionsBox = select.querySelector('.select-options');
          const searchInput = select.querySelector('.search-input');
          const selectedValue = select.querySelector('.selected-value');
          const noResults = select.querySelector('.no-results');
          const options = Array.from(select.querySelectorAll('.select-option'));
          const hiddenInput = select.querySelector(
            `input[name="${select.dataset.name}"]`);

          header.addEventListener('click', () => {
            select.classList.toggle('open');
            optionsBox.classList.toggle('hidden');
            if (select.classList.contains('open')) searchInput.focus();
          });

          searchInput.addEventListener('input', function() {
            const term = this.value.toLowerCase().trim();
            let hasMatch = false;
            options.forEach(option => {
              option.style.display = option.textContent
                .toLowerCase().includes(term) ? 'block' :
                'none';
              if (option.style.display === 'block') hasMatch =
                true;
            });
            noResults.style.display = hasMatch ? 'none' : 'block';
          });

          options.forEach(option => {
            option.addEventListener('click', function() {
              options.forEach(opt => opt.classList.remove(
                'selected'));
              this.classList.add('selected');
              selectedValue.textContent = this.dataset.value;
              if (select.dataset.name == "type" || select.dataset.name ==
                "edit_type") {
                hiddenInput.value = this.dataset.value;
              } else {
                hiddenInput.value = this.dataset.id;
              }
              select.classList.remove('open');
              optionsBox.classList.add('hidden');
            });
          });

          document.addEventListener('click', function(e) {
            if (!select.contains(e.target)) {
              select.classList.remove('open');
              optionsBox.classList.add('hidden');
            }
          });
        });
      }
      selectfields();
    });
  </script>
@endpush
