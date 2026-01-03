<div class="relative">
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
      <a href="#" title="Edit Id({{ $id }})"
        class="edit-btn text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
        data-id="{{ $id }}">
        <span class="btn-content flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
          Edit
        </span>
      </a>
      <a href="#" title="Details Id({{ $id }})"
        class="text-gray-700 dark:text-gray-300 px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2 detail-btn"
        data-id="{{ $id }}">
        <span class="btn-content flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
              clip-rule="evenodd" />
          </svg>
          Details
        </span>
      </a>
      <button title="Delete Id({{ $id }})"
        class="delete-btn text-red-600 dark:text-red-400 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors flex items-center gap-2"
        data-id="{{ $id }}">
        <span class="btn-content flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
              clip-rule="evenodd" />
          </svg>
          Delete
        </span>
      </button>
    </div>
  </div>
</div>
