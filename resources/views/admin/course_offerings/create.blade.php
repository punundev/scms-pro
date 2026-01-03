@extends('layouts.admin')
@section('title', 'Create New Course Offering')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-book-atlas"></i>
        {{ __('message.create_new_course_offering') }}
      </h3>
      <a href="{{ route('admin.course_offerings.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    <form action="{{ route('admin.course_offerings.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        {{-- Subject Select --}}
        <div>
          <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.subject') }} <span class="text-red-500">*</span>
          </label>
          <select id="subject_id" name="subject_id" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('subject_id') border-red-500 @enderror">
            @foreach ($subjects as $subject)
              <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->name }}
                ({{ $subject->code ?? '' }})
              </option>
            @endforeach
          </select>
          @error('subject_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Teacher Select (Assuming User Model) --}}
        <div>
          <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.teacher') }} <span class="text-red-500">*</span>
          </label>
          <select id="teacher_id" name="teacher_id" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('teacher_id') border-red-500 @enderror">
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>{{ $teacher->name }}
                ({{ $teacher->specialization }})
              </option>
            @endforeach
          </select>
          @error('teacher_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Classroom Select --}}
        <div>
          <label for="classroom_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.classroom') }} <span class="text-red-500">*</span>
          </label>
          <select id="classroom_id" name="classroom_id" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('classroom_id') border-red-500 @enderror">
            @foreach ($classrooms as $classroom)
              <option value="{{ $classroom->id }}" @selected(old('classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
            @endforeach
          </select>
          @error('classroom_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div
        class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">
        {{-- Payment Type Select --}}
        <div>
          <label for="payment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.payment_type') }} <span class="text-red-500">*</span>
          </label>

          <select id="payment_type" name="payment_type" required
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500
           dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300
           @error('payment_type') border-red-500 @enderror">

            <option value="">{{ __('message.select_payment_type') }}</option>

            <option value="course" @selected(old('payment_type', $courseOffering->payment_type ?? 'course') == 'course')>
              {{ __('message.pay_full_course') }}
            </option>

            <option value="monthly" @selected(old('payment_type', $courseOffering->payment_type ?? 'course') == 'monthly')>
              {{ __('message.pay_monthly') }}
            </option>

          </select>

          @error('payment_type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Fee (Price) --}}
        <div>
          <label for="fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.course_fee') }} (USD) <span class="text-red-500">*</span>
          </label>
          <div class="relative mt-1 rounded-lg shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
            </div>
            <input type="type" step="0.01" min="0.00" max="50" maxlength="2" id="fee"
              oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="fee" value="{{ old('fee') }}"
              class="w-full pl-7 pr-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('fee') border-red-500 @enderror"
              placeholder="0.00" required>
          </div>
          @error('fee')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Join Start Date --}}

        <div>
          <label for="join_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_date') }}
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
            </div>

            <input type="text" id="join_start" name="join_start"
              value="{{ old('join_start', now()->toDateString()) }}" datepicker datepicker-format="yyyy-mm-dd"
              min="{{ now()->toDateString() }}" max="2027-12-31"
              class="block w-full ps-9 pe-3 py-2
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('join_start') border-red-500 @enderror"
              placeholder="Select start date">
          </div>

          @error('join_start')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="join_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_date') }}
          </label>
          <input type="date" id="join_start" name="join_start" value="{{ old('join_start', now()->toDateString()) }}"
            min="{{ now()->toDateString() }}" max="2027-12-31"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('join_start') border-red-500 @enderror">
          @error('join_start')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

        {{-- Join End Date --}}
        <div>
          <label for="join_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_date') }}
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
            </div>

            <input type="text" id="join_end" name="join_end" value="{{ old('join_end', now()->toDateString()) }}"
              datepicker datepicker-format="yyyy-mm-dd" min="{{ now()->toDateString() }}" max="2027-12-31"
              class="block w-full ps-9 pe-3 py-2
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('join_end') border-red-500 @enderror"
              placeholder="Select end date">
          </div>

          @error('join_end')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="join_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_date') }}
          </label>
          <input type="date" id="join_end" name="join_end" value="{{ old('join_end', now()->toDateString()) }}"
            min="{{ now()->toDateString() }}" max="2027-12-31"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('join_end') border-red-500 @enderror">
          @error('join_end')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}
      </div>

      <div
        class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">
        <div>
          <label for="schedule" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.schedule') }} <span class="text-red-500">*</span>
          </label>
          <select id="schedule" name="schedule" required
            class="w-full px-3 py-2 border  rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @foreach (['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'] as $sch)
              <option value="{{ $sch }}" @selected(old('schedule') == $sch)>
                {{ strtoupper($sch) }}
              </option>
            @endforeach
          </select>
          @error('schedule')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Time Slot (e.g., Mon/Wed 10:00) --}}
        <div>
          <label for="time_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.time_slot_category') }} <span class="text-red-500">*</span>
          </label>
          <select id="time_slot" name="time_slot" required
            class="w-full px-3 py-2 border  rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('time_slot') border-red-500 @enderror">
            @foreach (['morning', 'afternoon', 'evening'] as $slot)
              <option value="{{ $slot }}">
                {{ ucfirst($slot) }}
              </option>
            @endforeach
          </select>
          @error('time_slot')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Start Time --}}
        <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_time') }} <span class="text-red-500">*</span>
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>

            <input type="time" id="start_time" name="start_time" value="{{ old('start_time') ?? '06:00' }}"
              min="06:00" max="21:00" required
              class="block w-full p-2
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('start_time') border-red-500 @enderror">
          </div>

          @error('start_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="start_time" name="start_time" value="{{ old('start_time') ?? '06:00' }}"
            min="06:00" max="21:00"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('start_time') border-red-500 @enderror"
            required>
          @error('start_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}

        {{-- End Time --}}
        <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_time') }} <span class="text-red-500">*</span>
          </label>

          <div class="relative">
            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
              <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>

            <input type="time" id="end_time" name="end_time" value="{{ old('end_time') ?? '06:00' }}"
              min="06:00" max="21:00" required
              class="block w-full p-2
             bg-neutral-secondary-medium border border-default-medium
             text-heading text-sm rounded-base
             focus:ring-brand focus:border-brand
             shadow-xs placeholder:text-body
             dark:bg-gray-700 dark:border-gray-600 dark:text-white
             @error('end_time') border-red-500 @enderror">
          </div>

          @error('end_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="end_time" name="end_time" value="{{ old('end_time') ?? '06:00' }}"
            min="06:00" max="21:00"
            class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('end_time') border-red-500 @enderror"
            required>
          @error('end_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div> --}}
      </div>

      <label for="is_final_only"
        class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-slate-200 dark:border-gray-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors mb-4">
        <div class="flex flex-col">
          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ __('message.final_only_title') ?? 'Final Exam Only' }}
          </span>
          <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ __('message.final_only_desc') ?? 'Check this if the course only requires a final exam.' }}
          </p>
        </div>

        <div class="relative inline-flex items-center">
          <input type="checkbox" id="is_final_only" name="is_final_only" value="1" class="sr-only peer"
            {{ old('is_final_only', $courseOffering->is_final_only ?? false) ? 'checked' : '' }}>

          <div
            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
          </div>
        </div>
      </label>

      @error('is_final_only')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.course_offerings.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>

        @if (Auth::user()->hasPermissionTo('create_course-offering'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            {{ __('message.create_offering') }}
          </button>
        @endif

      </div>
    </form>
  </div>
@endsection
