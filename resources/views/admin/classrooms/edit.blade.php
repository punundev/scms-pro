@extends('layouts.admin')
@section('title', 'Edit Classroom: ' . $classroom->name)
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Classrooms (Using Cyan theme for differentiation) --}}
        <div
          class="size-8 rounded-full flex justify-center items-center p-1 bg-cyan-50 text-cyan-600 dark:text-cyan-50 dark:bg-cyan-900">
          <i class="ri-door-closed-fill"></i>
        </div>
        {{ __('message.edit_classroom') }}<span class="text-indigo-600 dark:text-indigo-400">{{ $classroom->name }}</span>
      </h3>
      {{-- Back button updated for classrooms --}}
      <a href="{{ route('admin.classrooms.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    {{-- Form action updated to the classroom update route and uses PUT method --}}
    <form action="{{ route('admin.classrooms.update', $classroom) }}" method="POST" id="editForm" class="p-0">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

        {{-- Classroom Name Field --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.classroom_name') }} <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" value="{{ old('name', $classroom->name) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('name') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., Lecture Hall A" required>
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Room Number Field --}}
        <div>
          <label for="room_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.room_number') }} <span class="text-red-500">*</span>
          </label>
          <input type="text" id="room_number" name="room_number"
            value="{{ old('room_number', $classroom->room_number) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('room_number') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., R101 or Lab-B" required>
          @error('room_number')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Capacity Field --}}
        <div>
          <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.capacity_(max_seats)') }} <span class="text-red-500">*</span>
          </label>
          <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $classroom->capacity) }}"
            max="50" maxlength="2"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('capacity') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., 45" required min="1">
          @error('capacity')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        {{-- Cancel button updated to classroom index route --}}
        <a href="{{ route('admin.classrooms.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>

        @if (Auth::user()->hasPermissionTo('update_classroom'))
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            {{ __('message.update_classroom') }}
          </button>
        @endif

      </div>
    </form>

  </div>
@endsection
