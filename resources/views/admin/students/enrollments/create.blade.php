@extends('layouts.admin')

@section('title', 'Enroll Student: ' . $student->name)

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Enroll Student --}}
          <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 20h0v-4a4 4 0 0 0-4-4H4a4 4 0 0 0-4 4v4h24v-4a4 4 0 0 0-4-4H12z" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          Enroll **{{ $student->name }}** in a Course
        </h3>
        {{-- Back Button --}}
        <a href="{{ route('admin.students.enrollments.index', $student) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          Back to Courses
        </a>
      </div>

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

      <form action="{{ route('admin.students.enrollments.store', $student) }}" method="POST" class="p-0">
        @csrf

        <div class="space-y-6">

          {{-- HIDDEN FIELDS --}}
          <input type="hidden" name="status" value="studying">
          <input type="hidden" name="grade_final" value="{{ old('grade_final', '') }}">
          <input type="hidden" name="student_id" value="{{ $student->id }}">

          {{-- Course Offering and Payment Status Selects (2 Columns) --}}
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- 1. Course Offering Selection Field (Select) --}}
            <div>
              <label for="course_offering_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Select Course Offering <span class="text-red-500">*</span>
              </label>
              <select id="course_offering_id" name="course_offering_id" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('course_offering_id') border-red-500 @enderror">
                <option value="">-- Choose a course --</option>
                @foreach ($availableCourses as $course)
                  <option value="{{ $course->id }}" {{ old('course_offering_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->subject->name ?? 'N/A Subject' }} - Teacher: {{ $course->teacher->name ?? 'N/A' }}
                    (Fee: ${{ number_format($course->fee, 0) }})
                  </option>
                @endforeach
              </select>
              @error('course_offering_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 2. Payment Status Field (Select) --}}
            <div>
              <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Payment Status <span class="text-red-500">*</span>
              </label>
              <select id="payment_status" name="payment_status" required
                class="w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('payment_status') border-red-500 @enderror">
                <option value="" disabled>Select Payment Status</option>
                @foreach (['pending', 'paid', 'overdue', 'free'] as $p)
                  <option value="{{ $p }}" {{ old('payment_status', 'pending') == $p ? 'selected' : '' }}>
                    {{ ucfirst($p) }}
                  </option>
                @endforeach
              </select>
              @error('payment_status')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

          </div>

          {{-- Remarks Field (Textarea) --}}
          <div class="border-t pt-6 border-gray-200 dark:border-gray-700">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Remarks (Optional)
            </label>
            <textarea name="remarks" id="remarks" rows="5" placeholder="Any special notes about this student's enrollment."
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('remarks') border-red-500 @enderror">{{ old('remarks') }}</textarea>
            @error('remarks')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Submit Button Row --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-8">
          <a href="{{ route('admin.students.enrollments.index', $student) }}"
            class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
            Cancel
          </a>
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Confirm Enrollment
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
