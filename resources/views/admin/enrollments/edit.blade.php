@extends('layouts.admin')

@section('title', 'Edit Admission for ' . ($courseOffering->subject->name ?? 'N/A'))

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      @php
        $courseName = $courseOffering->subject->name ?? 'Course';
        $courseOfferingId = $courseOffering->id;
      @endphp

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Edit Admission --}}
          <svg class="size-8 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd"
              d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
              clip-rule="evenodd" />
          </svg>
           {{ __('message.edit_admission_for') }}<span class="ml-1 text-green-600 dark:text-green-400">
            {{ $courseName }} - {{ $student->name }}
          </span>
        </h3>
        {{-- Back to Register Button --}}
        <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId]) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          {{ __('message.back_to_register') }}
        </a>
      </div>

      {{-- Form action uses the pivot keys (student_id, course_offering_id) --}}
      <form
        action="{{ route('admin.enrollments.update', [
            'student_id' => $enrollment->student_id,
            'course_offering_id' => $courseOfferingId,
        ]) }}"
        method="POST" class="p-0">

        @csrf
        @method('PUT')

        <div class="space-y-6">

          <input type="hidden" name="student_id" value="{{ $enrollment->student_id }}">
          <input type="hidden" name="course_offering_id" value="{{ $courseOfferingId }}">

          {{-- 3. Status Field (Select) --}}
          <div>
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              {{ __('message.admission_status') }} <span class="text-red-500">*</span>
            </label>
            <select name="status" id="status" required
              class="w-full px-3 py-2 border rounded-lg focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('status') border-red-500 @enderror">
              @foreach ($statuses as $status)
                <option value="{{ $status }}" {{ old('status', $enrollment->status) == $status ? 'selected' : '' }}>
                  {{ ucfirst($status) }}
                </option>
              @endforeach
            </select>
            @error('status')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- 6. Remarks Field (Textarea) --}}
          <div class="border-t pt-6 border-gray-200 dark:border-gray-700">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              {{ __('message.remarks_(optional)') }}
            </label>
            <textarea name="remarks" id="remarks" rows="5"
              placeholder="Any special notes about this student's admission or progress."
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 @error('remarks') border-red-500 @enderror">{{ old('remarks', $enrollment->remarks) }}</textarea>
            @error('remarks')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Submit Button Row --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-8">
          <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId]) }}"
            class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-lg flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
            Cancel
          </a>

          @if (Auth::user()->hasPermissionTo('update_enrollment'))
            <button type="submit"
              class="px-4 py-2 cursor-pointer bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
              {{ __('message.update_enrollment') }}
            </button>
          @endif

        </div>
      </form>
    </div>
  </div>

@endsection
