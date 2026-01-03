@extends('layouts.admin')
@section('title', 'Edit Exam: ' . ($exam->type ?? 'N/A'))
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Exam (Pencil) --}}
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-3.18 3.18a.5.5 0 00-.13.37l-.235 1.764 1.764-.235a.5.5 0 00.37-.13l5.5-5.5-1.764-1.764-5.5 5.5z" />
          <path fill-rule="evenodd"
            d="M5 4a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V9a1 1 0 112 0v7a4 4 0 01-4 4H5a4 4 0 01-4-4V6a4 4 0 014-4h5a1 1 0 110 2H5z"
            clip-rule="evenodd" />
        </svg>
        {{ __('message.edit_exam') }}
        <span class="ml-1 text-indigo-600 dark:text-indigo-400 capitalize">
          {{ $exam->type ?? 'N/A' }}
          ({{ $exam->courseOffering->join_end->format('D,d,M-Y') }})
        </span>
      </h3>
      <a href="{{ route('admin.exams.index', ['course_offering_id' => $courseOfferingId]) }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST" id="editForm" class="p-0">
      @csrf
      @method('PUT')

      <input type="hidden" name="course_offering_id" value="{{ $courseOfferingId }}">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        {{-- Exam Type --}}
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
          @endphp

          <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.exam_type') }} <span class="text-red-500">*</span>
          </label>

          <select id="type" name="type" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('type') border-red-500 @enderror">

            <option value="" disabled>{{ __('message.select_exam_type') }}</option>

            @foreach ($examTypes as $key => $label)
              <option value="{{ $key }}" @selected(old('type', $exam->type) == $key)>
                {{ $label }}
              </option>
            @endforeach
          </select>

          @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Exam Date --}}
        @php
          $maxDate = $courseOffering->join_end
              ? \Carbon\Carbon::parse($courseOffering->join_end)->format('Y-m-d')
              : '2027-12-31';
        @endphp

        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.exam_date') }} <span class="text-red-500">*</span>
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
            </div>

            <input type="text" id="date" name="date" datepicker datepicker-format="yyyy-mm-dd" required
              min="{{ now()->toDateString() }}" max="{{ $maxDate }}"
              value="{{ old('date', $exam->date ? \Carbon\Carbon::parse($exam->date)->format('Y-m-d') : null) }}"
              class="block w-full ps-9 pe-3 py-2.5
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('date') border-red-500 @enderror"
              placeholder="Select exam date">
          </div>

          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.exam_date') }} <span class="text-red-500">*</span>
          </label>
          <input type="date" id="date" name="date" required min="2025-01-01" max="2027-12-31"
            min="{{ now()->toDateString() }}"
            value="{{ old('date', $exam->date ? \Carbon\Carbon::parse($exam->date)->format('Y-m-d') : null) }}"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('date') border-red-500 @enderror">
          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">

        {{-- Total Marks --}}
        <div>
          <label for="total_marks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.total_marks') }} <span class="text-red-500">*</span>
          </label>
          <input type="number" id="total_marks" name="total_marks" required min="1" max="100" maxlength="3"
            value="{{ old('total_marks', $exam->total_marks ?? 100) }}"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('total_marks') border-red-500 @enderror"
            placeholder="e.g., 100">
          @error('total_marks')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Passing Marks --}}
        <div>
          <label for="passing_marks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.passing_marks') }} <span class="text-red-500">*</span>
          </label>
          <input type="number" id="passing_marks" name="passing_marks" required min="0" max="100"
            maxlength="3" value="{{ old('passing_marks', $exam->passing_marks ?? '') }}"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('passing_marks') border-red-500 @enderror"
            placeholder="e.g., 60">
          @error('passing_marks')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <div class="mb-6">
        {{-- Description (Textarea) --}}
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {{ __('message.description_(optional)') }}
        </label>
        <textarea id="description" name="description" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('description') border-red-500 @enderror"
          placeholder="Provide a brief description or instruction for the exam.">{{ old('description', $exam->description ?? '') }}</textarea>
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

        @if (Auth::user()->hasPermissionTo('update_exam'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            {{ __('message.update_exam') }}
          </button>
        @endif
      </div>
    </form>
  </div>
@endsection
