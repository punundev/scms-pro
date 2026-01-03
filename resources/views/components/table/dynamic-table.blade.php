<table class="w-full text-sm text-left">
  <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
    <tr class="text-nowrap">
      @foreach ($headers as $key => $header)
        <th scope="col" class="px-4 py-4">{{ is_array($header) ? $header['label'] : $header }}</th>
      @endforeach

      @if ($actions)
        {{-- Increased padding for better button space --}}
        <th scope="col" class="px-4 py-4 text-center">Actions</th>
      @endif

      @if ($checkbox)
        <th scope="col" class="px-2 py-4 w-20 flex gap-1.5 items-center">
          <x-fields.checkbox id="selectAllCheckbox" name="" class="" value="" />
          <span>All</span>
        </th>
      @endif
    </tr>
  </thead>
  <tbody>
    @if (count($items) > 0)
      @foreach ($items as $item)
        <x-table.tr>
          @foreach ($headers as $key => $header)
            <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize {{ $tdclass }}">
              @if (is_array($header) && isset($header['component']))
                <x-dynamic-component :component="$header['component']" :item="$item" />
              @else
                {{ \App\View\Components\Table\DynamicTable::getDisplayValue($item, is_array($header) ? $key : $header) }}
              @endif
            </td>
          @endforeach

          @if ($actions)
            {{-- ACTIONS COLUMN: Replaced Dropdown with Direct Buttons --}}
            <td class="px-4 py-2 text-right">
              <div class="flex items-center justify-end space-x-2 text-nowrap">

                @if (in_array('edit', $actionItems))
                  <a href="{{ $endpoint ? route('admin.' . $endpoint . '.edit', $item->id) : '#' }}"
                    title="Edit Id({{ $item->id }})"
                    class="edit-btn text-indigo-600 dark:text-indigo-500 hover:text-indigo-800 dark:hover:text-indigo-400 transition-colors p-1"
                    data-id="{{ $item->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                  </a>
                @endif

                @if (in_array('detail', $actionItems))
                  <a href="#" title="Details Id({{ $item->id }})"
                    class="detail-btn text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-400 transition-colors p-1"
                    data-id="{{ $item->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                        clip-rule="evenodd" />
                    </svg>
                  </a>
                @endif

                @if (in_array('delete', $actionItems))
                  <button type="button" title="Delete Id({{ $item->id }})"
                    class="delete-btn text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors p-1"
                    data-id="{{ $item->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                    </svg>
                  </button>
                @endif
              </div>
            </td>
          @endif

          @if ($checkbox)
            <td class="px-2 py-2">
              <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                value="{{ $item->id }}" />
            </td>
          @endif
        </x-table.tr>
      @endforeach
    @else
      <tr>
        <td colspan="{{ count($headers) + ($actions ? 1 : 0) + ($checkbox ? 1 : 0) }}" class="p-4 text-center">
          <x-not-found-data title="{{ $emptyMessage }}" />
        </td>
      </tr>
    @endif
  </tbody>
</table>

@if ($checkbox)
  <x-bulkactions />
@endif

{{-- <table class="w-full text-sm text-left">
  <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
    <tr class="text-nowrap">
      @foreach ($headers as $key => $header)
        <th scope="col" class="px-4 py-4">{{ is_array($header) ? $header['label'] : $header }}</th>
      @endforeach

      @if ($actions)
        <th scope="col" class="px-4 py-4">Actions</th>
      @endif

      @if ($checkbox)
        <th scope="col" class="px-2 py-4 w-20 flex gap-1.5 items-center">
          <x-fields.checkbox id="selectAllCheckbox" name="" class="" value="" />
          <span>All</span>
        </th>
      @endif
    </tr>
  </thead>
  <tbody>
    @if (count($items) > 0)
      @foreach ($items as $item)
        <x-table.tr>
          @foreach ($headers as $key => $header)
            <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize {{ $tdclass }}">
              @if (is_array($header) && isset($header['component']))
                <x-dynamic-component :component="$header['component']" :item="$item" />
              @else
                {{ \App\View\Components\Table\DynamicTable::getDisplayValue($item, is_array($header) ? $key : $header) }}
              @endif
            </td>
          @endforeach

          @if ($actions)
            <td class="px-4 py-2 text-right">
              <div class="relative size-8">
                <button
                  class="btn-toggle-dropdown btn-action font-medium text-indigo-600 dark:text-indigo-500 p-1 size-8 flex items-center justify-center
                                          border border-indigo-100 dark:border-gray-600 dark:hover:bg-gray-700 hover:bg-indigo-200 rounded-full cursor-pointer transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div
                  class="dropdown-menu hidden absolute w-auto right-0 z-10 mt-2 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
                  role="menu">
                  <div class="py-1" role="none">
                    @if (in_array('edit', $actionItems))
                      <a href="{{ $endpoint ? route('admin.' . $endpoint . '.edit', $item->id) : '#' }}"
                        title="Edit Id({{ $item->id }})"
                        class="edit-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                        data-id="{{ $item->id }}">
                        <span class="btn-content flex items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                          </svg>
                          Edit
                        </span>
                      </a>
                    @endif

                    @if (in_array('detail', $actionItems))
                      <a href="#" title="Details Id({{ $item->id }})"
                        class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 detail-btn"
                        data-id="{{ $item->id }}">
                        <span class="btn-content flex items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                              clip-rule="evenodd" />
                          </svg>
                          Details
                        </span>
                      </a>
                    @endif

                    @if (in_array('delete', $actionItems))
                      <button href="#" title="Delete Id({{ $item->id }})"
                        class="delete-btn text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
                        data-id="{{ $item->id }}">
                        <span class="btn-content flex items-center gap-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd" />
                          </svg>
                          Delete
                        </span>
                      </button>
                    @endif
                  </div>
                </div>
              </div>
            </td>
          @endif

          @if ($checkbox)
            <td class="px-2 py-2">
              <x-fields.checkbox id="" name="selected_ids[]" class="row-checkbox"
                value="{{ $item->id }}" />
            </td>
          @endif
        </x-table.tr>
      @endforeach
    @else
      <tr>
        <td colspan="{{ count($headers) + ($actions ? 1 : 0) + ($checkbox ? 1 : 0) }}" class="p-4 text-center">
          <x-not-found-data title="{{ $emptyMessage }}" />
        </td>
      </tr>
    @endif
  </tbody>
</table>

@if ($checkbox)
  <x-bulkactions />
@endif --}}
