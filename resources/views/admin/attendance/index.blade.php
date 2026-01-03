@extends('layouts.admin')

@section('title', 'Attendance Register')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form method="GET" action="{{ route('admin.attendances.index') }}"
      class="mb-4 flex justify-between items-center gap-4">
      <input type="hidden" name="course_offering_id" value="{{ $courseOffering->id }}">

      <div class="flex items-center gap-3">

        <div class="relative w-64">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
            </svg>
          </div>

          <input type="text" name="date" value="{{ $date }}" datepicker datepicker-format="yyyy-mm-dd"
            min="{{ $courseOffering->join_start->format('Y-m-d') }}"
            max="{{ $courseOffering->join_end->format('Y-m-d') }}"
            class="block w-full ps-9 pe-3 py-1.5
           bg-neutral-secondary-medium border border-default-medium
           text-heading text-sm rounded-base
           focus:ring-brand focus:border-brand
           shadow-xs placeholder:text-body
           dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Select date">
        </div>

        <button type="submit"
          class="px-4 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700
                   dark:bg-indigo-500 dark:hover:bg-indigo-600">
          {{ __('message.go') }}
        </button>
      </div>

      <div class="mb-4">
        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ __('message.status_key') }}</span>
        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">L =
          {{ __('message.attending_(1_score)') }} </span>
        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">P =
          {{ __('message.permission_(05_score)') }}</span>
        <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">A =
          {{ __('message.absent_(0_score)') }}</span>
      </div>
    </form>

    <form action="{{ route('admin.attendances.saveAll') }}" method="POST">
      @csrf
      <input type="hidden" name="course_offering_id" value="{{ $courseOffering->id }}">
      <input type="hidden" name="date" value="{{ $date }}">

      <div class="flex justify-between mb-4 items-center">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <i class="fa-solid fa-clipboard-user"></i>
          {{ __('message.attendance_for') }}
          <span class="ml-1 text-indigo-600 dark:text-indigo-400 capitalize">
            {{ $courseOffering?->teacher?->name }} -
            {{ $courseOffering?->classroom?->name }} -
            {{ $courseOffering?->subject?->name }} -
            {{ $courseOffering->time_slot }}
          </span>
        </h3>

        <div class="flex gap-2">
          <a href="{{ route('admin.course_offerings.index') }}"
            class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <span class="btn-content flex items-center justify-center">
              <i class="fa-solid fa-arrow-left me-2"></i>
              {{ __('message.back_to_course') }}
            </span>
          </a>

          @if (Auth::user()->hasPermissionTo('create_attendance'))
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
              <i class="fa-regular fa-floppy-disk me-2"></i>
              {{ __('message.save_all_attendance') }}
            </button>
          @endif

        </div>
      </div>

      <div class="my-2 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-6 ">
        @forelse($students as $student)
          @php
            $attendanceEntry = $student->attendances->first();
            $currentStatus = $attendanceEntry?->status ?? 'absence';

          @endphp

          <div class="flex flex-col border-r dark:border-gray-500 pr-4">
            <div class="md:col-span-2 flex justify-between">
              <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $student->name }}</span>
              <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.student_id') }} {{ $student->id }}
              </div>
            </div>

            <div class="flex flex-row justify-between">
              <div class="flex flex-col me-4">
                <label
                  class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('message.status') }}</label>

                <ul class="grid w-full gap-2 grid-cols-3">
                  <li class="min-w-[60px] w-full">
                    <input type="radio" id="status_attending_{{ $student->id }}" name="status_{{ $student->id }}"
                      value="attending" class="hidden peer" {{ $currentStatus === 'attending' ? 'checked' : '' }} />
                    <label for="status_attending_{{ $student->id }}"
                      class="inline-flex items-center justify-between w-full p-2 text-xs
                   bg-neutral-primary-soft border border-default rounded-base cursor-pointer
                   hover:bg-neutral-secondary-medium
                   peer-checked:bg-brand-softer peer-checked:border-brand-subtle
                   peer-checked:text-fg-brand-strong">
                      <span class="font-semibold">L</span>
                      <i class="fa-solid fa-check"></i>
                    </label>
                  </li>

                  <li class="min-w-[60px] w-full">
                    <input type="radio" id="status_permission_{{ $student->id }}" name="status_{{ $student->id }}"
                      value="permission" class="hidden peer" {{ $currentStatus === 'permission' ? 'checked' : '' }} />
                    <label for="status_permission_{{ $student->id }}"
                      class="inline-flex items-center justify-between w-full p-2 text-xs
                   bg-neutral-primary-soft border border-default rounded-base cursor-pointer
                   hover:bg-neutral-secondary-medium
                   peer-checked:bg-brand-softer peer-checked:border-brand-subtle
                   peer-checked:text-fg-brand-strong">
                      <span class="font-semibold">P</span>
                      <i class="fa-solid fa-check"></i>
                    </label>
                  </li>

                  <li class="min-w-[60px] w-full">
                    <input type="radio" id="status_absence_{{ $student->id }}" name="status_{{ $student->id }}"
                      value="absence" class="hidden peer" {{ $currentStatus === 'absence' ? 'checked' : '' }} />
                    <label for="status_absence_{{ $student->id }}"
                      class="inline-flex items-center justify-between w-full p-2 text-xs
                   bg-neutral-primary-soft border border-default rounded-base cursor-pointer
                   hover:bg-neutral-secondary-medium
                   peer-checked:bg-brand-softer peer-checked:border-brand-subtle
                   peer-checked:text-fg-brand-strong">
                      <span class="font-semibold">A</span>
                      <i class="fa-solid fa-check"></i>
                    </label>
                  </li>
                </ul>
              </div>

              <div class="flex flex-col">
                <label
                  class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('message.remarks') }}</label>
                <input type="text" name="remarks_{{ $student->id }}" value="{{ $attendanceEntry->remarks ?? '' }}"
                  class="w-full max-w-[150px] border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              </div>
            </div>
          </div>
        @empty
          <div class="p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
              {{ __('message.no_students_found_in_this_course_offering') }}
            </p>
          </div>
        @endforelse
      </div>
    </form>

  </div>
@endsection
