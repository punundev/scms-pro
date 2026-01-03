@extends('layouts.admin')

@section('title', 'Student Attendance History')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    {{-- Header --}}
    <div class="flex justify-between mb-4 items-center">
      <h3 class="text-xl mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <i class="fa-solid fa-clipboard-user"></i>
        {{ __('message.attendance_history_for') }}<span
          class="ml-1 text-indigo-600 dark:text-indigo-400">{{ $student->name }}</span>
      </h3>
      <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOffering->id]) }}"
        class="px-4 py-2 text-sm bg-gray-200 text-gray-800 rounded shadow hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
        <i class="fa-solid fa-arrow-left me-2"></i>
        {{ __('message.back_to_register') }}
      </a>
    </div>

    <hr class="my-4 dark:border-gray-700">

    {{-- Course/Student Details (Simplified Layout) --}}
    <div
      class="mb-6 p-4 grid grid-cols-1 md:grid-cols-3 gap-y-2 gap-x-4 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
      <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
        <span class="font-bold">{{ __('message.course') }}</span> {{ $courseOffering?->subject?->name }}
        ({{ $courseOffering->time_slot }})
      </p>
      <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
        <span class="font-bold">{{ __('message.teacher') }}</span> {{ $courseOffering?->teacher?->name }}
      </p>
      <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
        <span class="font-bold">{{ __('message.classroom') }}</span> {{ $courseOffering?->classroom?->name }}
      </p>
    </div>

    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('message.attendance_records') }} -
      ( {{ $enrollment->attendance_grade }} Points )</h4>

    {{-- Attendance Records - Grid/Card View --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-2">
      @forelse ($attendances as $attendance)
        @php
          $statusClasses = [
              'attending' => 'bg-green-50 text-green-800 dark:bg-green-900/50 dark:text-green-300',
              'permission' => 'bg-yellow-50 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300',
              'absence' => 'bg-red-50 text-red-800 dark:bg-red-900/50 dark:text-red-300',
          ];

          $statusColor =
              $statusClasses[$attendance->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
        @endphp

        {{-- Individual Attendance Card/Box --}}
        <div class="p-2 border rounded-lg shadow-sm {{ $statusColor }} flex flex-col justify-between">
          <div class="flex justify-between items-start mb-0">

            <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
              {{ \Carbon\Carbon::parse($attendance->date)->format('D, M j, Y') }}
            </div>

            {{-- Status Badge --}}
            <span class="px-3 py-1 text-xs font-semibold rounded-full border border-current">
              {{ ucfirst($attendance->status) }}
            </span>
          </div>

          {{-- Remarks (Secondary Info) --}}
          <div class="text-xs text-gray-700 dark:text-gray-300 italic mt-1">
            <span class="font-medium">{{ __('message.remarks') }}</span>
            {{ $attendance->remarks ?? 'N/A' }}
          </div>
        </div>
      @empty
        <div class="md:col-span-2 lg:col-span-3 p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            {{ __('message.no_attendance_records_found_for_this_student_in_this_course') }}
          </p>
        </div>
      @endforelse
    </div>
  </div>
@endsection
