@extends('layouts.admin')

@section('title', 'Course Offerings List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <div
        class="size-8 p-1 rounded-full  flex items-center justify-center bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900">
        <i class="ri-calendar-todo-fill"></i>
      </div>
      {{ __('message.course_offerings_list') }}
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

    <form action="{{ route('admin.course_offerings.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_course-offering'))
          <a href="{{ route('admin.course_offerings.create') }}"
            class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            {{ __('message.create_new_offering') }}
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search offerings by subject, teacher, or time..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.course_offerings.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
      @forelse ($courseOfferings as $offering)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 @if (\Carbon\Carbon::parse($offering->join_end)->isPast()) border-3 border-dashed border-red-400 dark:border-red-400 @endif">

          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <div class="flex flex-col">
              <div class="flex justify-between items-start gap-2">
                <div>
                  <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">
                    {{ $offering->subject->name ?? 'Subject Deleted' }}
                    <span class="text-sm @if ($offering?->students->count() >= $offering->classroom?->capacity) dark:text-red-500 @endif">
                      @if ($offering->students->count() >= $offering->classroom?->capacity)
                        (Full)
                      @endif

                      @if (\Carbon\Carbon::parse($offering->join_end)->isPast())
                        <strong class="text-red-400 uppercase">
                          ( This Course Has Completed)
                        </strong>
                      @endif
                    </span>
                  </h4>
                </div>
              </div>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 capitalize font-bold">
                {{ $offering->time_slot }}
                ({{ $offering->schedule }})
                ({{ \Carbon\Carbon::parse($offering->start_time)->format('H:i') }} -
                {{ \Carbon\Carbon::parse($offering->end_time)->format('H:i') }})
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 capitalize font-bold">
                Start: {{ \Carbon\Carbon::parse($offering->join_start)->format('d M Y') }},
                End: {{ \Carbon\Carbon::parse($offering->join_end)->format('d M Y') }}
              </p>
            </div>

            <div class="flex flex-col items-end">
              @if ($offering->attendances->count())
                <a title="Eport Attendance" href="{{ route('admin.attendances.export', $offering->id) }}"
                  class="btn p-2 h-8 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors mr-2"
                  title="Attendance">
                  <i class="fa-solid fa-right-from-bracket me-2"></i>
                  Export Attendance
                </a>
              @endif

              <a title="Eport Attendance" href="{{ route('admin.course_offerings.export', $offering->id) }}"
                class="btn p-2 h-8 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors mr-2"
                title="Attendance">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Export Score
              </a>
            </div>

          </div>

          <div class="p-4 space-y-3">
            <x-info.item name="{{ $offering->teacher->name ?? 'Unassigned' }}" icon="fa-solid fa-user-tie text-xl"
              label="Teacher" labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />

            <x-info.item
              name="{{ $offering->classroom->name ?? 'Location TBD' }}
                                        ({{ $offering->classroom?->capacity }}
                                        Seats)"
              icon="ri-door-open-fill text-xl" label="Classroom" labelcolor="text-gray-500 dark:text-gray-400"
              color="" position="left" />
            <x-info.item
              name="${{ number_format($offering->fee, 2) }} - ({{ ucfirst($offering->payment_type) }} Payment)"
              icon="ri-currency-fill text-xl" label="Fee" labelcolor="text-gray-500 dark:text-gray-400" color=""
              position="left" />
          </div>

          <div
            class="items-center px-4 py-0.5 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <div class="flex gap-1">

              @if (\Carbon\Carbon::parse($offering->join_end)->isFuture())
                @if (Auth::user()->hasPermissionTo('view_attendance'))
                  <a href="{{ route('admin.attendances.index', ['course_offering_id' => $offering->id]) }}"
                    class="h-8 btn pl-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                    title="Attendance">
                    <i class="fa-regular fa-calendar-days me-2"></i>
                    {{ __('message.attendance') }}
                  </a>
                @endif
              @endif

              @if (Auth::user()->hasPermissionTo('view_exam'))
                <a href="{{ route('admin.exams.index', ['course_offering_id' => $offering->id]) }}"
                  class="h-8  btn pl-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                  title="Exam">
                  <i class="ri-contract-fill text-lg me-2"></i>
                  {{ __('message.exam') }}
                </a>
              @endif

              @if (\Carbon\Carbon::parse($offering->join_end)->isFuture())
                @if (Auth::user()->hasPermissionTo('view_enrollment'))
                  @if ($offering->students->count() >= $offering->classroom?->capacity)
                    <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $offering->id]) }}"
                      class="h-8 btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                      title="Admission Register">
                      <i class="fa-solid fa-check me-2"></i>
                      {{ __('message.class_full') }}
                    </a>
                  @else
                    <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $offering->id]) }}"
                      class="h-8 btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                      title="Admission Register">
                      <i class="fa-solid fa-book-atlas me-2"></i>
                      {{ __('message.enroll') }}
                    </a>
                  @endif
                @endif
              @endif

            </div>

            <div class="flex">
              <a href="{{ route('admin.course_offerings.show', $offering->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="Show Details">
                <i class="fa-regular fa-eye me-2"></i>
              </a>

              @if (\Carbon\Carbon::parse($offering->join_end)->isFuture())
                @if (Auth::user()->hasPermissionTo('update_course-offering'))
                  <a href="{{ route('admin.course_offerings.edit', $offering->id) }}"
                    class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-500 dark:text-yellow-500 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                    title="Edit">
                    <i class="fa-solid fa-pen-to-square me-2"></i>
                  </a>
                @endif
              @endif

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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">
              {{ __('message.no_course_offerings_found') }}</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">
              {{ __('message.create_your_first_course_offering_to_schedule_a_class') }}
            </p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $courseOfferings->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
