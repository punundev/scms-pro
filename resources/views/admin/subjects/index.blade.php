@extends('layouts.admin')
@section('title', 'Subjects List')
@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path
          d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
        <path d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z" />
        <path
          d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z" />
        <path d="M6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
      </svg>
      Subjects List
    </h3>

    <form action="{{ route('admin.subjects.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
        <a href="{{ route('admin.subjects.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <i class="fa-solid fa-plus me-2"></i>
          Create New
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2  min-w-2/3">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search subjects..."
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
          <a href="{{ route('admin.subjects.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
          </a>
        </div>
      </div>
    </form>

    {{-- Subject Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @if (count($subjects) > 0)
        @foreach ($subjects as $subject)
          <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg @if ($subject->deleted_at) border-3 border-dashed border-red-500 dark:border-red-400 @endif">

            <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
              <div class="flex justify-between items-start gap-2">
                <div>
                  <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $subject->name }}
                    @if ($subject->deleted_at)
                      <strong class="text-red-400"> (Disabled)</strong>
                    @endif
                  </h4>
                </div>
              </div>
            </div>

            <div class="p-4 space-y-3">
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M17 20h5v-2a3 3 0 00-3-3h-2a3 3 0 00-3 3v2h5zM7 20H2v-2a3 3 0 013-3h2a3 3 0 013 3v2H7zM10 10a3 3 0 100-6 3 3 0 000 6z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Code</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    <span class="text-sm text-indigo-600 dark:text-indigo-400">{{ $subject->code }}</span>
                  </p>
                </div>
              </div>

              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-purple-50 dark:bg-slate-700 text-purple-600 dark:text-purple-300">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Credit Hours</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    <span>{{ $subject->credit_hours }}</span>
                  </p>
                </div>
              </div>
            </div>

            {{-- Actions --}}
            <div
              class="px-4 py-0.5 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">
              <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  Edit
                </span>
              </a>

              @if ($subject->deleted_at)
                <form action="{{ route('admin.subjects.restore', $subject->id) }}" method="POST">
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
                <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this subject? This action cannot be undone.');">
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
        @endforeach
      @else
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Subjects Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create your first subject to get started</p>
          </div>
        </div>
      @endif
    </div>

    <div class="mt-6">
      {{ $subjects->onEachSide(2)->links('admin.components.tailwind-modern') }}
    </div>

  </div>
@endsection
