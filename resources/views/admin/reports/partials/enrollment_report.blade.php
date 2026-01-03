<div class="overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    {{-- Table Header --}}
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">Student Name</th>
        <th scope="col" class="px-6 py-3">Course / Subject</th>
        <th scope="col" class="px-6 py-3">Time Slot</th>
        <th scope="col" class="px-6 py-3">Enroll Date</th>
        <th scope="col" class="px-6 py-3">Status</th>
        <th scope="col" class="px-6 py-3">Final Grade</th>
      </tr>
    </thead>
    <tbody>
      @forelse($data as $enrollment)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          {{-- Student Name --}}
          <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $enrollment->student->name }}
          </th>
          {{-- Course / Subject --}}
          <td class="px-6 py-4">
            {{ $enrollment->courseOffering->subject->name ?? 'N/A' }}
          </td>
          {{-- Time Slot --}}
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $enrollment->courseOffering->time_slot ?? 'N/A' }}
          </td>
          {{-- Enroll Date --}}
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $enrollment->created_at->format('M d, Y') }}
          </td>
          {{-- Status (using badge colors similar to your expense view) --}}
          <td class="px-6 py-4">
            @php
              $statusClass =
                  [
                      'studying' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                      'completed' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                      'suspended' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                      'dropped' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                  ][$enrollment->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
            @endphp
            <span class="font-medium px-2.5 py-0.5 rounded-full text-xs {{ $statusClass }}">
              {{ ucfirst($enrollment->status) }}
            </span>
          </td>
          {{-- Final Grade --}}
          <td class="px-6 py-4 font-semibold text-gray-800 dark:text-gray-200">
            {{ $enrollment->grade_final ?? 'N/A' }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            No enrollments found matching the criteria.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
