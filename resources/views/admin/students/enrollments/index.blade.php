@extends('layouts.admin')
@section('title', 'Courses for: ' . $student->name)
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    {{-- Header Section --}}
    <div class="mb-6 flex justify-between items-start">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <i
          class="fa-regular fa-calendar-plus size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"></i>
        Enrolled Courses for: {{ $student->name }}
      </h3>
      <div class="flex space-x-3 mt-1"> {{-- Adjusted spacing and alignment --}}
        <a href="{{ route('admin.students.enrollments.create', $student) }}"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-sm text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Add Admission
        </a>

        <a href="{{ route('admin.students.show', $student) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2.586l3-3V17a1 1 0 001 1h2a1 1 0 001-1v-6.586l1.293-1.293a1 1 0 000-1.414l-7-7z" />
          </svg>
          Back to Student Details
        </a>
      </div>
    </div>

    {{-- Success/Error Messages (Retained from original code) --}}
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

    {{-- Course Cards Container (Clones Role Card Structure) --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
      @forelse ($enrollments as $enrollment)
        @php

          $gradeColor = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
          if (in_array($enrollment?->grade_final, ['A', 'B', 'C'])) {
              $gradeColor = 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100';
          } elseif (in_array($enrollment?->grade_final, ['D', 'E'])) {
              $gradeColor = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100';
          } elseif ($enrollment?->grade_final === 'F') {
              $gradeColor = 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100';
          } else {
              $gradeColor = 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100';
          }
        @endphp

        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Card Header: Course Name --}}
          <div
            class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200 capitalize truncate"
              title="{{ $enrollment->subject->name ?? 'N/A Subject' }}">
              {{ $enrollment->subject->name ?? 'N/A Subject' }}
            </h4>
            <span class="p-1 rounded text-lg font-bold {{ $gradeColor }}">
              {{ $enrollment->grade_final ?? 'Pending' }}
            </span>
          </div>

          {{-- Card Body: Course Details --}}
          <div class="p-4 space-y-3">
            {{-- Teacher --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <i class="fa-solid fa-chalkboard-user size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Teacher</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $enrollment->teacher->name ?? 'Unassigned' }}
                </p>
              </div>
            </div>

            {{-- Classroom / Schedule --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <i class="fa-regular fa-clock size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Classroom / Schedule</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $enrollment->classroom->name ?? 'N/A' }} ({{ $enrollment->schedule ?? 'TBA' }})
                </p>
              </div>
            </div>

            {{-- Enrollment Date --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-yellow-50 dark:bg-slate-700 text-yellow-600 dark:text-yellow-300">
                <i class="fa-regular fa-calendar-alt size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Enrollment Date</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $enrollment->created_at?->format('M d, Y') ?? 'N/A' }}
                </p>
              </div>
            </div>
          </div>

          {{-- Card Footer: Actions (Edit/Delete Enrollment, or View Course Details) --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            <a href="{{ route('admin.course_offerings.show', $enrollment) }}"
              class="btn px-3 py-1 rounded-full flex items-center cursor-pointer text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-slate-600 transition-colors"
              title="View Course Details">
              <i class="fa-solid fa-eye me-2"></i>
              View Course
            </a>

          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <i class="fa-regular fa-sad-cry h-8 w-8 text-red-400 dark:text-red-500"></i>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">Not Enrolled</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">This student is not currently enrolled in any courses.
            </p>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Courses --}}

    <div class="mt-6">
      {{ $enrollments->links() }}
    </div>

  </div>
@endsection
