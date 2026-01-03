<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">#</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Student</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Course</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Date</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Status</th>
      </tr>
    </thead>

    <tbody class="bg-white dark:bg-gray-800">
      @forelse ($data as $index => $row)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->student->name ?? 'N/A' }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->course->name ?? 'N/A' }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->date }}</td>
          <td class="px-4 py-2">
            <span
              class="px-3 py-1 rounded-full text-sm
              @if ($row->status === 'present') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200
              @elseif($row->status === 'absent') bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200
              @else bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 @endif">
              {{ ucfirst($row->status) }}
            </span>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 italic">
            No attendance records found.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
