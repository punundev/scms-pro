@extends('layouts.admin')

@section('title', 'Students List')
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    <h3 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <div class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
            <i class="ri-user-2-fill text-2xl"></i>
          </div>
          Students List
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

    <form action="{{ route('admin.students.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-blue-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_student'))
          <a href="{{ route('admin.students.create') }}"
            class="text-nowrap px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus me-2"></i>
            Enroll New Student
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search students by name or email..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 rounded-lg transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.students.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-indigo-900 dark:hover:bg-indigo-600 rounded-lg transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- START: Card View for Students (Role Style) --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
      @forelse ($students as $student)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Card Header: Student Name and Actions --}}
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">

            <div class="flex items-center gap-3">
              <img src="{{ $student->avatar_url }}"
                class="w-14 h-14 rounded-full object-cover border-2 border-white shadow @if ($student->deleted_at) border-red-600 @endif">

              <a href="{{ route('admin.students.show', $student->id) }}"
                class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize truncate hover:text-blue-600 dark:hover:text-blue-400">
                {{ $student->name }}
              </a>
            </div>

          </div>

          {{-- Card Body: Stats --}}
          <div class="p-4 space-y-3">

            {{-- Email --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-yellow-50 dark:bg-slate-700 text-yellow-600 dark:text-yellow-300">
                <i class="fa-solid fa-at size-5"></i>
              </div>
              <div class="truncate">
                <p class="text-xs text-gray-500 dark:text-gray-400">Email</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 truncate" title="{{ $student->email }}">
                  {{ $student->email }}
                </p>
              </div>
            </div>

            {{-- Admission Date --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-cyan-50 dark:bg-slate-700 text-cyan-600 dark:text-cyan-300">
                <i class="fa-solid fa-calendar-alt size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Admission Date</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-cyan-600 dark:text-cyan-400">
                    {{ $student->admission_date ? $student->admission_date->format('M d, Y') : 'N/A' }}
                  </span>
                </p>
              </div>
            </div>

            {{-- Courses Enrolled Count --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <i class="fa-solid fa-book size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Courses Enrolled</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-blue-600 dark:text-blue-400">{{ $student->courseOfferings->count() }}</span>
                  Courses
                </p>
              </div>
            </div>

            {{-- Attendance Count --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <i class="fa-solid fa-check-circle size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Attendance Records</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-green-600 dark:text-green-400">{{ $student->attendances_count }}</span>
                  Records
                </p>
              </div>
            </div>
          </div>

          {{-- Card Footer: Primary Actions --}}
          <div
            class="px-4 py-1 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between">

            <div class="flex items-center">
              @if (Auth::user()->hasPermissionTo('view_enrollment'))
                <a href="{{ route('admin.students.enrollments.index', $student->id) }}"
                  class="btn p-2 py-1 rounded-full flex justify-center items-center cursor-pointer text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit Student">
                  <i class="fa-solid fa-file-circle-plus me-2"></i>
                  Enroll
                </a>
              @endif

              @if (Auth::user()->hasPermissionTo('view_fee'))
                <a href="{{ route('admin.students.fees.index', $student->id) }}"
                  class="btn pl-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit Student">
                  <i class="fa-solid fa-dollar-sign me-2"></i>
                  Payment
                </a>
              @endif

            </div>

            <div class="flex items-center">
              {{-- View Details Button --}}
              <a href="{{ route('admin.students.show', $student->id) }}"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="View Student Details">
                <i class="fa-regular fa-eye me-2"></i>
                {{-- View --}}
              </a>

              @if (Auth::user()->hasPermissionTo('update_student'))
                <a href="{{ route('admin.students.edit', $student->id) }}"
                  class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit Student">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  {{-- Edit --}}
                </a>
              @endif

              {{-- Delete Form/Button --}}
              {{-- <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete the student \'{{ $student->name }}\'? This will soft-delete the user record.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn px-2 py-1 rounded-full flex items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete Student">
                  <i class="fa-regular fa-trash-can me-2"></i>
                </button>
              </form> --}}
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Students Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">There are no students matching your criteria.</p>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Students --}}

    <div class="mt-6">
      {{ $students->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
