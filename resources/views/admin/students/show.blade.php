@extends('layouts.admin')
@section('title', 'Student Details: ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
        <i class="ri-user-2-fill text-2xl"></i>
      </div>
      {{ $student->name }} Details
    </h3>
    <div class="flex space-x-3">
      @if (Auth::user()->hasPermissionTo('update_student'))
        <a href="{{ route('admin.students.edit', $student) }}"
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <i class="fa-solid fa-user-pen"></i>
          Edit
        </a>
      @endif

      <a href="{{ route('admin.students.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <i class="fa-regular fa-house"></i>
        Back to List
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-10">
        <div
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
          <div class="mb-4">
            <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}"
              class="size-56 mx-auto rounded-full object-cover border-4 border-indigo-200 dark:border-indigo-700 shadow-md">
          </div>
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $student->name }}</h2>
          <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">{{ $student->email }}</p>

          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">Student Metrics</h3>
            <div class="flex justify-around text-center">
              {{-- Ensure your controller loaded counts (e.g., withCount(['fees', 'attendances'])) --}}
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->fees_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Fee Records</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->attendances_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Attendance</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->scores_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Scores</div>
              </div>
            </div>
          </div>
        </div>

        @if (Auth::user()->hasPermissionTo('delete_student'))
          <div
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-2 border-dashed border-red-500 dark:border-red-700 mt-6">
            <h3 class="text-md font-semibold text-red-600 dark:text-red-400 mb-3">Danger Zone</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              Permanently delete this student and all associated records. This action cannot be undone.
            </p>
            <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this student: {{ $student->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                Delete Student
              </button>
            </form>
          </div>
        @endif

      </div>
    </div>

    {{-- Right Column: Detailed Information (SCROLLABLE) --}}
    <div class="lg:col-span-2">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Personal & Contact Info</h3>

        </div>

        {{-- Details Grid --}}
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-4">

          {{-- General Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Gender',
              'value' => $student->gender ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Date of Birth',
              'value' => $student->date_of_birth
                  ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Phone',
              'value' => $student->phone ?? 'N/A',
          ])

          {{-- Admission/Status Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Admission Date',
              'value' => $student->admission_date
                  ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Account Created',
              'value' => \Carbon\Carbon::parse($student->created_at)->format('M d, Y'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Nationality',
              'value' => $student->nationality ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Religion',
              'value' => $student->religion ?? 'N/A',
          ])

          {{-- Work/Address Info (Full Width) --}}
          @if ($student->occupation || $student->company)
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Occupation / Company</dt>
              <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                @if ($student->occupation)
                  {{ $student->occupation }}
                @endif
                @if ($student->company)
                  @if ($student->occupation)
                    at
                  @endif
                  {{ $student->company }}
                @endif
                @if (!$student->occupation && !$student->company)
                  N/A
                @endif
              </dd>
            </div>
          @endif
          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $student->address ?? 'N/A' }}</dd>
          </div>
        </dl>
      </div>

      {{-- Assigned Courses --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">

        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Assigned Courses</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Details about courses this student is currently enrolled in.
        </p>
        @if ($student->courseOfferings->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">This student is not currently enrolled in any courses.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Subject
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Teacher
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Final Grade
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Schedule
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->courseOfferings as $offering)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $offering->subject->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering->teacher->name ?? 'Unassigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering?->enrollment?->status ? ucfirst(str_replace('_', ' ', $offering->enrollment->status)) : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100">
                        {{ $offering->enrollment->grade_final ?? 'N/A' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering->schedule ?? 'N/A' }}
                      ({{ $offering->start_time ? \Carbon\Carbon::parse($offering->start_time)->format('h:i A') : 'N/A' }}
                      -
                      {{ $offering->end_time ? \Carbon\Carbon::parse($offering->end_time)->format('h:i A') : 'N/A' }})
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
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Fee Records</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          List of fees billed to this student, including payment status.
        </p>

        @if ($student->fees->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">No fee records found for this student.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Type
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Amount
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Paid Amount
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Due Date
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student?->fees as $fee)
                  @php
                    $paidAmount = $fee?->payments?->sum('amount');
                    $status = $fee?->status; // Uses the getStatusAttribute accessor from the Fee model
                  @endphp
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $fee->feeType->name ?? 'General Fee' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      ${{ number_format($fee->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      ${{ number_format($paidAmount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($status === 'paid') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif ($status === 'unpaid') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @elseif ($status === 'partially_paid') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @elseif ($status === 'overpaid') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100 @endif">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Exam Scores --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Exam Scores</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Individual scores recorded for exams in various courses.
        </p>

        @if ($student->scores->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">No exam scores found for this student.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Exam Type / Course
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Date
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Score / Total
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Grade
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Remarks
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->scores as $score)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      <span class="font-bold">{{ $score->exam->type ?? 'N/A' }}</span>
                      <p class="text-xs text-gray-500 dark:text-gray-400">
                        ({{ $score->exam->courseOffering->subject->name ?? 'Unknown Course' }})
                      </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->exam->date ? \Carbon\Carbon::parse($score->exam->date)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->score }} / {{ $score->exam->total_marks ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if ($score->grade) @if (in_array(strtoupper($score->grade), ['A', 'B'])) bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                @elseif (in_array(strtoupper($score->grade), ['C', 'D'])) bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                @elseif (in_array(strtoupper($score->grade), ['F'])) bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100 @endif
@else
bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100
                            @endif">
                        {{ $score->grade ?? 'N/A' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->remarks ?? '-' }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Attendance Log --}}
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6 mb-10">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Attendance Log</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Daily attendance status for enrolled courses.
        </p>

        @if ($student->attendances->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">No attendance records found for this student.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Date
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Course
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Remarks
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->attendances->sortByDesc('date') as $attendance)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $attendance->courseOffering->subject->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if ($attendance->status === 'Present') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif ($attendance->status === 'Absent') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 @endif">
                        {{ $attendance->status }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $attendance->remarks ?? '-' }}
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
