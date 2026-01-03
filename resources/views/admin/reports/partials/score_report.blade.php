<div class="overflow-x-auto">
  <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">#</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Student</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Course</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Score</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Grade</th>
        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Date</th>
      </tr>
    </thead>

    <tbody class="bg-white dark:bg-gray-800">
      @forelse ($data as $index => $row)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->student->name ?? 'N/A' }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->course->name ?? 'N/A' }}</td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300 font-semibold">{{ $row->score ?? '-' }}</td>
          <td class="px-4 py-2">
            @php
              $score = $row->score ?? 0;
              $grade = $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : ($score >= 60 ? 'D' : 'F')));
            @endphp

            <span
              class="px-3 py-1 rounded-full text-sm
              @if ($grade === 'A') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200
              @elseif($grade === 'B') bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200
              @elseif($grade === 'C') bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-200
              @elseif($grade === 'D') bg-orange-100 text-orange-700 dark:bg-orange-900 dark:text-orange-200
              @else bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 @endif
            ">
              {{ $grade }}
            </span>
          </td>
          <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $row->created_at?->format('Y-m-d') ?? '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 italic">
            No score records found.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
