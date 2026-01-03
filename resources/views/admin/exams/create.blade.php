@extends('layouts.admin')
@section('title', 'Create New Exam')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Exam (Add) --}}
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
          <polyline points="14 2 14 8 20 8"></polyline>
          <line x1="12" y1="12" x2="12" y2="18"></line>
          <line x1="9" y1="15" x2="15" y2="15"></line>
        </svg>
        {{ __('message.create_new_exam') }}
      </h3>

      <a href="{{ route('admin.exams.index', ['course_offering_id' => $courseOfferingId]) }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    <form action="{{ route('admin.exams.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <input type="hidden" name="course_offering_id" value="{{ $courseOfferingId }}">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        {{-- 1. Exam Type (New addition from Edit) --}}
        <div class="lg:col-span-1">
          @php
            $examTypes = [
                'midterm' => 'Midterm',
                'final' => 'Final',
                'speaking' => 'Speaking',
                'listening' => 'Listening',
                'reading' => 'Reading',
                'writing' => 'Writing',
            ];

            if ($courseOffering->is_final_only) {
                $examTypes = ['final' => 'Final'];
            }
          @endphp

          <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Exam Type <span class="text-red-500">*</span>
            @if ($courseOffering->is_final_only)
              <span class="ml-2 text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase">(Final Only
                Course)</span>
            @endif
          </label>

          <select id="type" name="type" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('type') border-red-500 @enderror">

            @foreach ($examTypes as $key => $label)
              <option value="{{ $key }}" @selected(old('type') == $key)>
                {{ $label }}
              </option>
            @endforeach
          </select>

          @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 4. Exam Date --}}
        @php
          $maxDate = $courseOffering->join_end
              ? \Carbon\Carbon::parse($courseOffering->join_end)->format('Y-m-d')
              : '2027-12-31';
        @endphp

        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Exam Date <span class="text-red-500">*</span>
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
            </div>

            <input type="text" id="date" name="date" datepicker datepicker-format="yyyy-mm-dd"
              value="{{ old('date', $maxDate) }}" max="{{ $maxDate }}" min="{{ now()->toDateString() }}" required
              class="block w-full ps-9 pe-3 py-2.5
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('date') border-red-500 @enderror"
              placeholder="Select exam date">
          </div>

          <p class="mt-1 text-xs text-gray-500">
            {{ __('message.the_exam_must_be_held') }} <strong> {{ __('message.on_or_before') }}{{ \Carbon\Carbon::parse($maxDate)->format('d-m-Y') }}</strong>.
          </p>

          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- @php
          $maxDate = $courseOffering->join_end
              ? \Carbon\Carbon::parse($courseOffering->join_end)->format('Y-m-d')
              : '2027-12-31';
        @endphp

        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.exam_date') }} <span class="text-red-500">*</span>
          </label>

          <input type="date" id="date" name="date" value="{{ old('date', $maxDate) }}"
            max="{{ $maxDate }}"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('date') border-red-500 @enderror"
            required>

          <p class="mt-1 text-xs text-gray-500">
            {{ __('message.the_exam_must_be_held_**on_or_before') }} {{ \Carbon\Carbon::parse($maxDate)->format('d-m-Y') }}**.
          </p>

          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">

        {{-- 5. Total Marks --}}
        <div>
          <label for="total_marks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.total_marks') }} <span class="text-red-500">*</span>
          </label>
          <input type="number" id="total_marks" name="total_marks" value="{{ old('total_marks') ?? 100 }}"
            max="100" min="1"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('total_marks') border-red-500 @enderror"
            placeholder="e.g., 100" required>
          @error('total_marks')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- 6. Passing Marks --}}
        <div>
          <label for="passing_marks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.passing_marks') }} <span class="text-red-500">*</span>
          </label>
          <input type="number" id="passing_marks" name="passing_marks" value="{{ old('passing_marks') ?? 60 }}"
            min="0" max="100"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('passing_marks') border-red-500 @enderror"
            placeholder="e.g., 60" required>
          @error('passing_marks')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- Description (Textarea) - Moved up for better grouping --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {{ __('message.description_(optional)') }}
        </label>
        <textarea id="description" name="description" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('description') border-red-500 @enderror"
          placeholder="Provide a brief description or instruction for the exam.">{{ old('description') }}</textarea>
        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.exams.index', ['course_offering_id' => $courseOfferingId]) }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>
        @if (Auth::user()->hasPermissionTo('create_exam'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            {{ __('message.save_exam') }}
          </button>
        @endif
      </div>
    </form>
  </div>
@endsection
