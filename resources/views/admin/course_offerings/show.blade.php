@extends('layouts.admin')
@section('title', 'Course Details: ' . $courseOffering->subject?->name . ' - ' . $courseOffering->time_slot)

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto @if (\Carbon\Carbon::parse($courseOffering->join_end)->isPast()) border-4 border-dashed border-red-600 dark:border-red-600 @endif">
    <!-- Header Section -->
    <div class="mb-4">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex items-center gap-3">
          <div
            class="size-10 p-1 rounded-full  flex items-center justify-center bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900">
            <i class="ri-calendar-todo-fill text-2xl"></i>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
              Course Offering Details
              @if (\Carbon\Carbon::parse($courseOffering->join_end)->isPast())
                <strong class="text-red-400 uppercase">
                  ( This Course Has Completed)
                </strong>
              @endif
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Complete information about this course offering</p>
          </div>
        </div>
        <div>
          <a href="{{ route('admin.course_offerings.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 dark:bg-gray-800 border border-gray-300
                     dark:border-gray-600 rounded-lg dark:hover:bg-gray-700 transition-colors text-gray-800
                     text-sm font-medium dark:text-gray-300">
            <i class="fas fa-arrow-left text-xs"></i>
            {{ __('message.back_to_offerings') }}
          </a>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <div>
        <!-- Course Title & Fee Card -->
        <div
          class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl shadow-sm border border-blue-100 dark:border-blue-800 p-3 mb-4">
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="mb-4 lg:mb-0">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ $courseOffering->subject->name ?? 'N/A' }}</h2>
              <div class="flex items-center gap-4 mt-2">
                <span
                  class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-sm font-medium">

                  {{ __('message.subject_code') }}<i
                    class="fas fa-hashtag text-xs"></i>{{ $courseOffering->subject->code ?? 'N/A' }}
                </span>
                <span
                  class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 text-sm font-medium">
                  <i class="fas fa-star text-xs"></i>
                  {{ $courseOffering->subject->credit_hours ?? 'N/A' }} {{ __('message.credit_hours') }}
                </span>
              </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-4 shadow-md border border-green-200 dark:border-green-800">
              <div class="text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">{{ __('message.course_fee') }}</p>
                <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-1">
                  ${{ number_format($courseOffering->fee, 2) }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <!-- Course Details Card -->
          <div class="lg:col-span-2 space-y-4">
            <!-- Basic Information Card -->
            <div
              class="bg-white dark:bg-gray-800 rounded-xl border border-slate-300 dark:border-slate-700 overflow-hidden">
              <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                  <i class="fas fa-info-circle text-blue-500"></i>
                  {{ __('message.course_information') }}
                </h3>
              </div>
              <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                  <!-- Teacher -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300">
                      <i class="fas fa-chalkboard-user"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.teacher') }}</p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                        {{ $courseOffering->teacher->name ?? 'Unassigned' }}</p>
                    </div>
                  </div>

                  <!-- Classroom -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300">
                      <i class="fas fa-school"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.classroom') }}</p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                        {{ $courseOffering->classroom->name ?? 'Unassigned' }}</p>
                    </div>
                  </div>

                  <!-- Schedule Type -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300">
                      <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.schedule_type') }}
                      </p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1 capitalize">
                        {{ $courseOffering->schedule ?? 'N/A' }}</p>
                    </div>
                  </div>

                  <!-- Time Slot -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-300">
                      <i class="fas fa-clock"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.time_slot') }}</p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1 capitalize">
                        {{ $courseOffering->time_slot ?? 'N/A' }}</p>
                    </div>
                  </div>

                  <!-- Class Time -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-teal-100 dark:bg-teal-900 text-teal-600 dark:text-teal-300">
                      <i class="fas fa-hourglass-start"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.class_time') }}</p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1 capitalize">
                        {{ $courseOffering->start_time?->format('h:m') }} -
                        {{ $courseOffering->end_time?->format('h:m') }}</p>
                    </div>
                  </div>

                  <!-- Credit Hours -->
                  <div
                    class="flex items-start gap-4 p-4 rounded-lg border border-slate-300 dark:border-slate-700 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <div class="p-2 rounded-lg bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                      <i class="fas fa-star"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.credit_hours') }}
                      </p>
                      <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                        {{ $courseOffering->subject->credit_hours ?? 'N/A' }} Point</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enrollment Period Card -->
            <div
              class="bg-white dark:bg-gray-800 rounded-xl border border-slate-300 dark:border-slate-700 overflow-hidden">
              <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                  <i class="fas fa-calendar-alt text-cyan-500"></i>
                  {{ __('message.enrollment_period') }}
                </h3>
              </div>
              <div class="p-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <!-- Enrollment Opens -->
                  <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 border border-cyan-100 dark:border-cyan-800">
                    <div class="flex items-center gap-3">
                      <div class="p-2 rounded-lg bg-cyan-100 dark:bg-cyan-900 text-cyan-600 dark:text-cyan-300">
                        <i class="fas fa-calendar-alt"></i>
                      </div>
                      <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                          {{ __('message.enrollment_opens') }}
                        </p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                          {{ $courseOffering->join_start?->format('M d, Y') ?? 'N/A' }}</p>
                      </div>
                    </div>
                    <div class="text-cyan-600 dark:text-cyan-400">
                      <i class="fas fa-door-open text-xl"></i>
                    </div>
                  </div>

                  <!-- Enrollment Closes -->
                  <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gradient-to-r from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 border border-pink-100 dark:border-pink-800">
                    <div class="flex items-center gap-3">
                      <div class="p-2 rounded-lg bg-pink-100 dark:bg-pink-900 text-pink-600 dark:text-pink-300">
                        <i class="fas fa-calendar-times"></i>
                      </div>
                      <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                          {{ __('message.enrollment_closes') }}
                        </p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                          {{ $courseOffering->join_end?->format('M d, Y') ?? 'N/A' }}</p>
                      </div>
                    </div>
                    <div class="text-pink-600 dark:text-pink-400">
                      <i class="fas fa-door-closed text-xl"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- Enrolled Students Card -->
      <div class="lg:col-span-1">
        <div
          class="bg-white dark:bg-gray-800 rounded-xl border border-slate-300 dark:border-slate-700 overflow-hidden h-full">
          <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-users text-blue-500"></i>
                {{ __('message.enrolled_students') }}
              </h3>
              <span
                class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-bold">
                {{ __('message.total') }}: {{ $courseOffering->students->count() }}
              </span>
            </div>
          </div>
          <div class="p-2 max-h-145 overflow-y-auto">
            @if ($courseOffering->students->isNotEmpty())
              <div class="space-y-1">
                @foreach ($courseOffering->students as $student)
                  <div
                    class="flex items-center justify-between p-2 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                    <div class="flex items-center gap-3">
                      <div
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 font-medium text-sm">
                        {{ $loop->iteration }}
                      </div>
                      <div>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $student->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-mono">
                          ID:{{ $student->id }}</p>
                      </div>
                    </div>
                    <div class="text-right">
                      <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $student->email }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-center py-8">
                <div
                  class="mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                  <i class="fas fa-user-slash text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500 dark:text-gray-400 font-medium">{{ __('message.no_students_enrolled') }}</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                  {{ __('message.students_will_appear_here_once_they_enroll') }}</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    @if (\Carbon\Carbon::parse($courseOffering->join_end)->isFuture())

      <div class="my-2 flex flex-col sm:flex-row justify-end gap-4">
        @if (Auth::user()->hasPermissionTo('update_course-offering'))
          <a href="{{ route('admin.course_offerings.edit', $courseOffering->id) }}"
            class="inline-flex items-center justify-center gap-2 px-3 py-1 border-2 border-blue-500 hover:border-blue-500 hover:bg-transparent hover:text-blue-500 bg-blue-500 text-white font-medium rounded-lg transition-all duration-300">
            <i class="fas fa-edit"></i>
            {{ __('message.edit_offering') }}
          </a>
        @endif

        {{-- @if (Auth::user()->hasPermissionTo('delete_course-offering'))
          <form action="{{ route('admin.course_offerings.destroy', $courseOffering->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to permanently delete this course offering? This will remove all associated student enrollments.');"
            class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="inline-flex items-center justify-center gap-2 px-6 py-2 border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white font-medium rounded-lg transition-all duration-300">
              <i class="fas fa-trash-can"></i>
              {{ __('message.disabled') }}
            </button>
          </form>
        @endif --}}
      </div>
    @endif
  </div>
@endsection
