@extends('layouts.admin')

@section('title', 'Teachers List')
@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    <h3 class="mb-2 text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-indigo-50 text-indigo-600 border border-indigo-300 dark:border-indigo-800 dark:text-indigo-50 dark:bg-slate-800">
        <i class="ri-teacher-fill text-2xl"></i>
      </div>
      Teachers List
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

    <form action="{{ route('admin.teachers.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-lg border-gray-200 dark:border-gray-700 bg-indigo-50 dark:bg-slate-800">

        @if (Auth::user()->hasPermissionTo('create_teacher'))
          <a href="{{ route('admin.teachers.create') }}"
            class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus me-2"></i>
            Add New Teacher
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search by name, email, or specialty..."
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
          <a href="{{ route('admin.teachers.index') }}"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 rounded-lg transition-colors dark:text-white"
            title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- START: Card View for Teachers --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-4">
      @forelse ($teachers as $teacher)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Card Header --}}
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <div class="flex items-center gap-3">
              <img src="{{ asset($teacher->avatar ?? 'defaults/avatar.png') }}"
                class="w-14 h-14 rounded-full object-cover border-2 border-white shadow">
              <div>
                <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                  class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize hover:text-indigo-600 dark:hover:text-indigo-400">
                  {{ $teacher->name }}
                </a>
                <p class="text-xs text-indigo-500 font-medium">{{ $teacher->specialization ?? 'No Specialization' }}</p>
              </div>
            </div>
          </div>

          {{-- Card Body --}}
          <div class="p-4 space-y-3">
            {{-- Email --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-gray-50 dark:bg-slate-700 text-gray-600 dark:text-gray-300">
                <i class="fa-solid fa-at size-5 text-center"></i>
              </div>
              <div class="truncate">
                <p class="text-xs text-gray-500 dark:text-gray-400">Email Address</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 truncate" title="{{ $teacher->email }}">
                  {{ $teacher->email }}
                </p>
              </div>
            </div>

            {{-- Phone --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <i class="fa-solid fa-phone size-5 text-center"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Phone</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">{{ $teacher->phone ?? 'N/A' }}</p>
              </div>
            </div>

            {{-- Salary & Joining Date --}}
            <div class="grid grid-cols-2 gap-2">
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-yellow-50 dark:bg-slate-700 text-yellow-600 dark:text-yellow-300">
                  <i class="fa-solid fa-money-bill-wave size-5 text-center"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Salary</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">${{ number_format($teacher->salary, 2) }}</p>
                </div>
              </div>

              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                  <i class="fa-solid fa-calendar-check size-5 text-center"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Joined</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    {{ $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y') : 'N/A' }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          {{-- Card Footer --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between items-center">

            <div class="flex gap-2">
              @if ($teacher->cv)
                <a href="{{ asset($teacher->cv) }}" target="_blank"
                  class="text-xs bg-white dark:bg-slate-600 border border-gray-200 dark:border-slate-500 px-2 py-1 rounded text-gray-600 dark:text-gray-200 hover:bg-gray-50">
                  <i class="fa-solid fa-file-pdf me-1 text-red-500"></i> CV
                </a>
              @endif
            </div>

            <div class="flex items-center gap-1">
              <a href="{{ route('admin.teachers.show', $teacher->id) }}"
                class="p-2 rounded-full text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="View Details">
                <i class="fa-regular fa-eye"></i>
              </a>

              @if (Auth::user()->hasPermissionTo('update_teacher'))
                <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                  class="p-2 rounded-full text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                  title="Edit Teacher">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
              @endif

              @if (Auth::user()->hasPermissionTo('delete_teacher'))
                <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
                  onsubmit="return confirm('Delete teacher {{ $teacher->name }}?');" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="p-2 rounded-full text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </form>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <p class="text-gray-500 dark:text-gray-400">No teachers found.</p>
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $teachers->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
