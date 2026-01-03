@extends('layouts.admin')

@section('title', 'Admission Register')
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <i class="fa-solid fa-clipboard-user"></i>
      @if ($courseOffering)
        Admission Register for {{ $courseOffering->subject?->name }} -
        {{ $courseOffering->teacher->name }} -
        {{ $courseOffering->classroom?->name }}
        ({{ $courseOffering->time_slot }}) -
        ($ {{ $courseOffering->fee }})
      @endif
    </h3>

    {{-- Success/Error Messages --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    {{-- Search Form --}}
    <form action="{{ route('admin.enrollments.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        @if ($enrollments->count() >= $courseOffering->classroom?->capacity)
          <div></div>
        @else
          <div class="flex gap-4">
            @if (Auth::user()->hasPermissionTo('create_enrollment'))
              <a href="{{ route('admin.enrollments.create', ['course_offering_id' => $courseOffering->id]) }}"
                class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2 disabled">
                <i class="fa-solid fa-plus"></i>
                {{ __('message.enrollment') }}
              </a>
            @endif

            <a href="{{ route('admin.course_offerings.index') }}"
              class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2 disabled">
              <i class="fa-solid fa-plus"></i>
              {{ __('message.back') }}
            </a>
          </div>
        @endif

        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by student name, course, or status..."
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
          <a href="{{ route('admin.enrollments.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-lg transition-colors"
            title="Reset Search">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </a>
        </div>
      </div>
    </form>

    {{-- Admission Register Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse($enrollments as $enrollment)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Header: Student Name & Course --}}
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between">
            <div class="flex justify-between items-start gap-2">
              <h4 class="font-bold text-lg text-indigo-600 dark:text-indigo-400">
                {{ $enrollment->student->name ?? 'Student Deleted' }}</h4>
            </div>
            <div class="">
              <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold">
                {{ $enrollment->courseOffering->subject->name ?? 'Course Deleted' }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">Time Slot:
                {{ $enrollment->courseOffering->time_slot ?? 'N/A' }}</p>
            </div>
          </div>

          {{-- NEW SECTION: Status and Details --}}
          <div class="p-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
            {{-- Status and Payment Status (Flex for alignment) --}}
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-700/50">
              <p class="flex items-center gap-1 font-medium justify-between">
                <i class="fa-solid fa-circle-info text-indigo-500"></i>
                {{ __('message.status') }}
                <span
                  class="font-semibold px-2 py-0.5 rounded-full text-xs
            @if ($enrollment->status === 'completed') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
            @elseif ($enrollment->status === 'studying')
                bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
            @elseif ($enrollment->status === 'suspended')
                bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300
            @else
                bg-blue-100 text-blue-700 dark:bg-blue-700 dark:text-blue-300 @endif">
                  {{ ucfirst($enrollment->status ?? 'N/A') }}
                </span>
              </p>
            </div>

            {{-- <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-700/50">
              <p class="flex items-center gap-1 font-medium justify-between">
                <i class="fa-solid fa-circle-info text-indigo-500"></i>
                {{ __('message.status') }}
                <span
                  class="font-semibold px-2 py-0.5 rounded-full text-xs
                  @if ($enrollment->status === 'Completed') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                  @elseif ($enrollment->status === 'In Progress')
                    bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
                  @else
                    bg-blue-100 text-blue-700 dark:bg-blue-700 dark:text-blue-300 @endif">
                  {{ $enrollment->status ?? 'N/A' }}
                </span>
              </p>
            </div> --}}

            {{-- Final Grade --}}
            <div class="flex justify-between items-center">
              <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
                <i class="fa-solid fa-graduation-cap text-purple-500"></i>
                {{ __('message.final_grade') }}
              </span>

              @php
                $grades = [
                    $enrollment->attendance_grade,
                    $enrollment->listening_grade,
                    $enrollment->writing_grade,
                    $enrollment->reading_grade,
                    $enrollment->speaking_grade,
                    $enrollment->midterm_grade,
                    $enrollment->final_grade,
                ];

                $sum = collect($grades)->filter(fn($g) => !is_null($g))->sum();

                $output = $sum > 0 ? $sum : 'N/A';
              @endphp

              <span class="font-bold text-lg text-purple-600 dark:text-purple-400">
                {{-- {{ $output }} p --}}
                {{ $enrollment->manual_sum > 0 ? $enrollment->manual_sum : '0.00' }}
                @if ($enrollment->manual_sum > 0)
                  {{ $enrollment->letter_grade }}
                @endif
              </span>
            </div>

            {{-- Payment Status --}}
            <div class="flex justify-between items-center">
              <p class="flex items-center gap-1 font-medium">
                <i class="fa-solid fa-wallet text-teal-500"></i>
                Payment:

              <p class="text-sm ">
                @if ($enrollment?->fee?->status == 'paid')
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
                    Paid on
                    {{ $enrollment->fee->payment_date ? \Carbon\Carbon::parse($enrollment->fee->payment_date)->format('M d, Y') : 'N/A' }}
                  </span>
                @elseif ($enrollment->fee?->status == 'pending' && $enrollment->fee->due_date && $enrollment->fee->due_date->isPast())
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">
                    Overdue
                  </span>
                @else
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                    {{ ucfirst($enrollment->fee?->status) }}
                  </span>
                @endif
              </p>
            </div>

            {{-- Remarks --}}
            {{-- @if ($enrollment->remarks)
              <div class="pt-2 border-t border-gray-100 dark:border-gray-700/50">
                <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
                  <i class="fa-solid fa-comment-dots text-yellow-500"></i>
                  Remarks:
                </span>
                <p class="text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded-lg">
                  {{ Str::limit($enrollment->remarks, 100) }}
                </p>
              </div>
            @endif --}}
          </div>

          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <div class="flex">
              @if (Auth::user()->hasPermissionTo('view_attendance'))
                <a href="{{ route('admin.attendances.show', [$courseOffering->id, $enrollment->student->id]) }}"
                  class="btn p-1 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Attendance">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-book-atlas me-2"></i>
                    Attendance
                  </span>
                </a>
              @endif

              @if (Auth::user()->hasPermissionTo('view_score'))
                <a href="{{ route('admin.scores.show', [$courseOffering->id, $enrollment->student->id]) }}"
                  class="btn p-1 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                  title="Attendance">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-file-circle-plus me-2"></i>
                    Score
                  </span>
                </a>
              @endif
            </div>

            <div class="flex">
              @if (Auth::user()->hasPermissionTo('update_attendance'))
                <a href="{{ route('admin.enrollments.edit', ['student_id' => $enrollment->student_id, 'course_offering_id' => $enrollment->course_offering_id]) }}"
                  class="btn p-1 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit Admission">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                    Edit
                  </span>
                </a>
              @endif

              {{-- <form
                action="{{ route('admin.enrollments.destroy', ['student_id' => $enrollment->student_id, 'course_offering_id' => $enrollment->course_offering_id]) }}"
                method="POST" onsubmit="return confirm('Are you sure you want to delete this admission record?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete Admission">
                  <i class="fa-regular fa-trash-can me-2"></i>
                  {{ __('message.delete') }}
                </button>
              </form> --}}
            </div>
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>

@endsection
