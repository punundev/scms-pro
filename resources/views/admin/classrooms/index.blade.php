@extends('layouts.admin')

@section('title', 'Classrooms List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Classrooms (using a location/room theme) --}}
      <div
        class="size-8 rounded-full flex justify-center items-center p-1 bg-cyan-50 text-cyan-600 dark:text-cyan-50 dark:bg-cyan-900">
        <i class="fa-solid fa-people-roof"></i>
      </div>
      {{ __('message.classrooms_list') }}
    </h3>

    {{-- Success/Error Messages --}}
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

    <form action="{{ route('admin.classrooms.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-cyan-50 dark:bg-slate-800">

        {{-- Create Button (Redirects to Create Page) --}}
        @if (Auth::user()->hasPermissionTo('create_classroom'))
          <a href="{{ route('admin.classrooms.create') }}"
            class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            {{ __('message.create_new') }}
          </a>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2 min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search classrooms (name or room number)..."
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
          <a href="{{ route('admin.classrooms.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- Classroom Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse ($classrooms as $classroom)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border-3 border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 @if ($classroom->deleted_at) border-3 border-dashed border-red-400 dark:border-red-500 @endif">

          <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $classroom->name }}
                  @if ($classroom->deleted_at)
                    <strong class="text-red-400"> (Disabled)</strong>
                  @endif
                </h4>
              </div>

              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ __('message.room_number') }}<span class="font-medium text-indigo-500 dark:text-indigo-400">
                  {{ $classroom->room_number }}
                </span>
              </p>

              {{-- Detail Button (Redirects to Show Page) --}}
              {{-- <a href="{{ route('admin.classrooms.show', $classroom->id) }}"
                class="btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-900 transition-colors"
                title="View Details">
                <span class="btn-content">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </span>
              </a> --}}
            </div>

          </div>

          <div class="p-4 space-y-3">
            {{-- Capacity --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 20h5v-2a3 3 0 00-3-3h-2a3 3 0 00-3 3v2h5zM7 20H2v-2a3 3 0 013-3h2a3 3 0 013 3v2H7zM10 10a3 3 0 100-6 3 3 0 000 6z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.capacity') }}</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-indigo-600 dark:text-indigo-400">{{ $classroom->capacity }}
                    Seats</span>
                </p>
              </div>
            </div>
          </div>

          {{-- Actions (Edit Link + Delete Form) --}}
          <div
            class="px-4 py-0.5 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            @if (Auth::user()->hasPermissionTo('update_classroom'))
              <a href="{{ route('admin.classrooms.edit', $classroom->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  {{ __('message.edit') }}
                </span>
              </a>
            @endif

            {{-- Delete Button (Full form submission) --}}
            @if ($classroom->deleted_at)
              <form action="{{ route('admin.classrooms.restore', $classroom->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete">
                  <i class="fa-solid fa-trash-arrow-up me-2"></i>
                  {{ __('message.restore') }}
                </button>
              </form>
            @else
              <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete the classroom {{ $classroom->name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete">
                  <i class="fa-solid fa-ban me-2"></i>
                  {{ __('message.disabled') }}
                </button>
              </form>
            @endif

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
              {{ __('message.no_classrooms_found') }}
            </h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">
              {{ __('message.create_your_first_classroom_to_get_started') }}</p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $classrooms->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
