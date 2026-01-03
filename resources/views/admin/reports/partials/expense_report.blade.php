@if (isset($data['summary']))
  <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">Financial Summary</h4>
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Total Expenses in Report Period:
      <span class="text-2xl font-extrabold text-red-700 dark:text-red-300 ml-2">
        ${{ number_format($data['summary']['total_expenses'] ?? 0, 2) }}
      </span>
    </p>
  </div>
@endif

<div class="overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    {{-- Table Header --}}
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">Date</th>
        <th scope="col" class="px-6 py-3">Title</th>
        <th scope="col" class="px-6 py-3">Amount</th>
        <th scope="col" class="px-6 py-3">Category</th>
        <th scope="col" class="px-6 py-3">Recorded By</th>
        <th scope="col" class="px-6 py-3">Description</th>
      </tr>
    </thead>
    <tbody>
      @forelse($data['list'] ?? [] as $expense)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          {{-- Date --}}
          <td class="px-6 py-4 font-semibold text-gray-800 dark:text-gray-200">
            {{ $expense->date }}
          </td>
          {{-- Title --}}
          <th scope="row" class="px-6 py-4 font-medium text-red-600 whitespace-nowrap dark:text-red-400">
            {{ $expense->title }}
          </th>
          {{-- Amount --}}
          <td class="px-6 py-4 text-lg font-bold text-red-700 dark:text-red-300">
            ${{ number_format($expense->amount, 2) }}
          </td>
          {{-- Category --}}
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $expense->expenseCategory->name ?? 'N/A' }}
          </td>
          {{-- Created By --}}
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $expense->createdBy->name ?? 'System' }}
          </td>
          {{-- Description --}}
          <td class="px-6 py-4 italic text-gray-500 dark:text-gray-400">
            {{ Str::limit($expense->description, 50) }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            No expenses found matching the criteria.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
