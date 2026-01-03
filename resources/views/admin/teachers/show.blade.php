@extends('layouts.admin')
@section('title', 'Teacher Details: ' . $teacher->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-indigo-50 text-indigo-600 border border-indigo-300 dark:border-indigo-800 dark:text-indigo-50 dark:bg-slate-800">
        <i class="ri-teacher-fill text-2xl"></i>
      </div>
      Teacher Profile: {{ $teacher->name }}
    </h3>
    <div class="flex space-x-3">
      @if (Auth::user()->hasPermissionTo('update_teacher'))
        <a href="{{ route('admin.teachers.edit', $teacher) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <i class="ri-edit-line"></i>
          Edit Profile
        </a>
      @endif

      <a href="{{ route('admin.teachers.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <i class="ri-arrow-left-line"></i>
        Back to List
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Column: Avatar & Quick Stats --}}
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-10">
        <div
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
          <div class="mb-4">
            <img src="{{ $teacher->avatar_url }}" alt="{{ $teacher->name }}"
              class="size-56 mx-auto rounded-full object-cover border-4 border-indigo-200 dark:border-indigo-700 shadow-md">
          </div>
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $teacher->name }}</h2>
          <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">
            {{ $teacher->specialization ?? 'Faculty Member' }}</p>

          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">Teaching Metrics</h3>
            <div class="flex justify-around text-center">
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $teacher->course_offerings_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Courses</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $teacher->experience ?? 'N/A' }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Exp. Years</div>
              </div>
            </div>
          </div>

          {{-- CV Download Action --}}
          @if ($teacher->cv)
            <div class="mt-4">
              <a href="{{ asset($teacher->cv) }}" target="_blank"
                class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 transition-colors">
                <i class="ri-file-pdf-line mr-2"></i> View Curriculum Vitae
              </a>
            </div>
          @endif
        </div>

        @if (Auth::user()->hasPermissionTo('delete_teacher'))
          <div
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-2 border-dashed border-red-500 dark:border-red-700 mt-6">
            <h3 class="text-md font-semibold text-red-600 dark:text-red-400 mb-3">Danger Zone</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              Permanently delete this teacher's account. This will unassign them from active courses.
            </p>
            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete {{ $teacher->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                Delete Teacher
              </button>
            </form>
          </div>
        @endif
      </div>
    </div>

    {{-- Right Column: Information Tabs/Sections --}}
    <div class="lg:col-span-2 space-y-6">

      {{-- Personal & Professional Info --}}
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <div class="pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Professional Profile</h3>
        </div>

        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-4">
          @include('admin.components.detail-item', [
              'label' => 'Email Address',
              'value' => $teacher->email,
          ])
          @include('admin.components.detail-item', [
              'label' => 'Phone Number',
              'value' => $teacher->phone ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Gender',
              'value' => ucfirst($teacher->gender) ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Qualification',
              'value' => $teacher->qualification ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Specialization',
              'value' => $teacher->specialization ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Joining Date',
              'value' => $teacher->joining_date
                  ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Monthly Salary',
              'value' => $teacher->salary ? '$' . number_format($teacher->salary, 2) : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Nationality',
              'value' => $teacher->nationality ?? 'N/A',
          ])

          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Home Address</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $teacher->address ?? 'N/A' }}</dd>
          </div>
        </dl>
      </div>

      {{-- Assigned Course Offerings --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Current Teaching Schedule</h3>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Courses currently assigned to this teacher for the current term.
        </p>

        @if ($teacher->courseOfferings->isEmpty())
          <div
            class="text-center py-6 bg-gray-50 dark:bg-gray-900 rounded-lg border border-dashed border-gray-300 dark:border-gray-700">
            <p class="text-gray-500 dark:text-gray-400">No active course assignments found.</p>
          </div>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Subject
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Schedule
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Time</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Students
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($teacher->courseOfferings as $offering)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $offering->subject->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering->schedule ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering->start_time ? \Carbon\Carbon::parse($offering->start_time)->format('h:i A') : '--' }}
                      -
                      {{ $offering->end_time ? \Carbon\Carbon::parse($offering->end_time)->format('h:i A') : '--' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 py-1 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 text-xs font-bold">
                        {{ $offering->enrollments_count ?? 0 }} Enrolled
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

    </div>
  </div>
@endsection
