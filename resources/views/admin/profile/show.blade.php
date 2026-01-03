@extends('layouts.admin')
@section('title', 'My Profile: ' . $user->name)
@section('content')

  {{-- Status/Success Message --}}
  @if (session('status'))
    <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
      role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="8.5" cy="7" r="4"></circle>
        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
      My Profile
      {{-- Display primary role for quick identification --}}
      @if ($user->roles->isNotEmpty())
        <span class="text-base font-semibold text-gray-500 dark:text-gray-400">
          ({{ $user->roles->first()->name }})
        </span>
      @endif
    </h3>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-10">
        <div
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
          <div class="mb-4">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
              class="size-56 mx-auto rounded-full object-cover border-4 border-green-200 dark:border-green-700 shadow-md">
          </div>
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $user->name }}</h2>
          <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">{{ $user->email }}</p>

          {{-- Spatie Roles Display --}}
          <div class="mt-2 flex justify-center flex-wrap gap-1">
            @foreach ($user->roles as $role)
              <span
                class="px-2 py-0.5 text-xs font-semibold rounded-full capitalize
                  @if ($role->name === 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                  @elseif ($role->name === 'teacher') bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200
                  @elseif ($role->name === 'student') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                  @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                {{ $role->name }}
              </span>
            @endforeach
          </div>

          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">Metrics</h3>
            <div class="flex justify-around text-center">

              @if ($user->hasRole('student'))
                <div class="p-2">
                  <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $user->course_offerings_count ?? 0 }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Courses</div>
                </div>
                <div class="p-2">
                  <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $user->fees_count ?? 0 }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Fees</div>
                </div>
              @endif

              @if ($user->hasRole('teacher'))
                <div class="p-2">
                  <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $user->teaching_courses_count ?? 0 }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Courses Taught</div>
                </div>
                <div class="p-2">
                  <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $taughtStudentsCount }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Students Taught</div>
                </div>
              @endif

              @if ($user->hasRole('admin') || $user->hasRole('staff'))
                <div class="p-2">
                  <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $user->approved_expenses_count ?? 0 }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">Expenses Approved</div>
                </div>
              @endif

              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $user->attendances_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Attendance Log</div>
              </div>
            </div>
          </div>
        </div>

        {{-- Removed Delete Button Card --}}

      </div>
    </div>

    {{-- Right Column: Detailed Information --}}
    <div class="lg:col-span-2">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 pb-4">Personal & Contact Info</h3>

        {{-- Details Grid --}}
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-4">

          {{-- General Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Gender',
              'value' => $user->gender ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Date of Birth',
              'value' => $user->date_of_birth
                  ? \Carbon\Carbon::parse($user->date_of_birth)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', ['label' => 'Phone', 'value' => $user->phone ?? 'N/A'])
          @include('admin.components.detail-item', [
              'label' => 'Nationality',
              'value' => $user->nationality ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Religion',
              'value' => $user->religion ?? 'N/A',
          ])

          {{-- Role-Specific Dates --}}
          @if ($user->hasRole('student'))
            @include('admin.components.detail-item', [
                'label' => 'Admission Date',
                'value' => $user->admission_date
                    ? \Carbon\Carbon::parse($user->admission_date)->format('M d, Y')
                    : 'N/A',
            ])
            @include('admin.components.detail-item', [
                'label' => 'Parent Occupation',
                'value' => ($user->occupation ?? 'N/A') . ($user->company ? ' at ' . $user->company : ''),
            ])
          @else
            @include('admin.components.detail-item', [
                'label' => 'Joining Date',
                'value' => $user->joining_date
                    ? \Carbon\Carbon::parse($user->joining_date)->format('M d, Y')
                    : 'N/A',
            ])
            @include('admin.components.detail-item', [
                'label' => 'Occupation / Company',
                'value' => ($user->occupation ?? 'N/A') . ($user->company ? ' at ' . $user->company : ''),
            ])
          @endif

          {{-- Teacher/Staff Specific Info --}}
          @if ($user->hasRole('teacher') || $user->hasRole('admin') || $user->hasRole('staff'))
            @include('admin.components.detail-item', [
                'label' => 'Qualification',
                'value' => $user->qualification ?? 'N/A',
            ])
            @include('admin.components.detail-item', [
                'label' => 'Specialization',
                'value' => $user->specialization ?? 'N/A',
            ])
            @include('admin.components.detail-item', [
                'label' => 'Experience (Yrs)',
                'value' => $user->experience ?? 'N/A',
            ])
            @include('admin.components.detail-item', [
                'label' => 'Annual Salary',
                'value' => $user->salary ? '$' . number_format($user->salary, 2) : 'N/A',
            ])
            @if ($user->cv)
              <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">CV / Resume</dt>
                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                  {{-- Storage::url() is correct for publicly stored files --}}
                  <a href="{{ Storage::url($user->cv) }}" target="_blank"
                    class="text-blue-600 dark:text-blue-400 hover:underline">View File</a>
                </dd>
              </div>
            @endif
          @endif

          {{-- Address Info (Full Width) --}}
          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Address</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $user->address ?? 'N/A' }}</dd>
          </div>
        </dl>
      </div>

      {{-- TEACHER: Courses Taught Section --}}
      @if ($user->hasRole('teacher'))
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Courses Taught & Students</h3>

          <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Teaching Courses
            ({{ $user->teaching_courses_count }})</h4>
          @if ($user->teachingCourses->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">You are not currently assigned to teach any courses.</p>
          @else
            <div class="flex flex-wrap gap-2 mb-4">
              @foreach ($user->teachingCourses as $courseOffering)
                <span
                  class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                  {{ $courseOffering->subject->name ?? 'N/A' }}
                  ({{ \Carbon\Carbon::parse($courseOffering->start_time)->format('h:i A') }} -
                  Students: {{ $courseOffering->students_count }})
                </span>
              @endforeach
            </div>
          @endif

          <h4 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2 mt-4">Total Unique Students Taught
            ({{ $taughtStudentsCount }})</h4>
          <p class="text-sm text-gray-500 dark:text-gray-400">This number reflects all unique students enrolled across
            the
            courses you teach.</p>

        </div>
      @endif

      {{-- STUDENT: Enrollment, Fees, Scores, Attendance Sections --}}
      @if ($user->hasRole('student'))

        {{-- Assigned Courses (Enrollment) --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Enrolled Courses
            ({{ $user->course_offerings_count }})</h3>

          @if ($user->courseOfferings->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">You are not currently enrolled in any courses.</p>
          @else
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Subject</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Teacher</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Final Grade</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                      Schedule</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                  @foreach ($user->courseOfferings as $offering)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ $offering->subject->name ?? 'N/A' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $offering->teacher->name ?? 'Unassigned' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $offering->enrollment->grade_final ?? 'Pending' }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $offering->schedule ?? 'N/A' }}
                        ({{ $offering->start_time ? \Carbon\Carbon::parse($offering->start_time)->format('h:i A') : '' }}
                        -
                        {{ $offering->end_time ? \Carbon\Carbon::parse($offering->end_time)->format('h:i A') : '' }})
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>

        {{-- Fee Records (Invoices/Bills) --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Fee Records ({{ $user->fees_count }})
          </h3>

          @if ($user->fees->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No fee records found for your account.</p>
          @else
            <div class="overflow-x-auto">
              {{-- Fee table data here... --}}
              {{-- Since you didn't provide the fee table, this is a placeholder. --}}
              <p class="text-sm text-gray-500 dark:text-gray-400">Fee table implementation needed.</p>
            </div>
          @endif
        </div>

        {{-- Exam Scores --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Exam Scores
            ({{ $user->scores->count() }})</h3>

          @if ($user->scores->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No exam scores found for your account.</p>
          @else
            <div class="overflow-x-auto">
              {{-- Score table data here... --}}
              {{-- Since you didn't provide the score table, this is a placeholder. --}}
              <p class="text-sm text-gray-500 dark:text-gray-400">Score table implementation needed.</p>
            </div>
          @endif
        </div>
      @endif

      {{-- Generic: Attendance Log --}}
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6 mb-10">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Attendance Log
          ({{ $user->attendances_count }})</h3>

        @if ($user->attendances->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">No attendance records found for your account.</p>
        @else
          <div class="overflow-x-auto">
            {{-- Attendance table data here... --}}
            {{-- Since you didn't provide the attendance table, this is a placeholder. --}}
            <p class="text-sm text-gray-500 dark:text-gray-400">Attendance table implementation needed.</p>
          </div>
        @endif
      </div>

    </div>
  </div>
@endsection
