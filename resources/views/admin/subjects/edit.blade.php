@extends('layouts.admin')
@section('title', 'Edit Subject: ' . $subject->name)
@section('content')
  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
          viewBox="0 0 24 24" fill="currentColor">
          <path d="M7 17.013v1.987h10v-1.987l-5-5-5 5zM17 5v1.987l-5 5-5-5v-1.987h10z" />
        </svg>
        Edit Subject: {{ $subject->name }}
      </h3>
      <a href="{{ route('admin.subjects.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to List
      </a>
    </div>

    <form method="POST" action="{{ route('admin.subjects.update', $subject->id) }}">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        {{-- Name --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subject Name <span
              class="text-red-500">*</span></label>
          <input type="text" name="name" id="name" value="{{ old('name', $subject->name) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('name') border-red-500 @else border-gray-400 @enderror"
            required>
          @error('name')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>

        {{-- Code --}}
        <div>
          <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subject Code <span
              class="text-red-500">*</span></label>
          <input type="text" name="code" id="code" value="{{ old('code', $subject->code) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('code') border-red-500 @else border-gray-400 @enderror"
            required>
          @error('code')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>

        {{-- Credit Hours --}}
        <div>
          <label for="credit_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Credit Hours
            <span class="text-red-500">*</span></label>
          <input type="number" name="credit_hours" id="credit_hours" max="10"
            value="{{ old('credit_hours', $subject->credit_hours) }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                     dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('credit_hours') border-red-500 @else border-gray-400 @enderror"
            min="1" required>
          @error('credit_hours')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror
        </div>
      </div>

      {{-- Description --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description
          (Optional)</label>
        <textarea name="description" id="description" rows="3"
          class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('description') border-red-500 @else border-gray-400 @enderror">{{ old('description', $subject->description) }}</textarea>
        @error('description')
          <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
      </div>

      <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.subjects.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Update Subject
        </button>
      </div>
    </form>
  </div>
@endsection
