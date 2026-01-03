<!-- Bulk Delete Confirmation Toast Modal -->
<div id="bulkDeleteToastModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 opacity-0 scale-95 border border-gray-200 dark:border-gray-700">
        <div class="p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Delete Confirmation</h3>
            <div class="mt-2 text-sm text-gray-500 dark:text-gray-300">
                <p>Are you sure you want to delete <span id="selectedCountText" class="font-semibold">0</span> selected departments?</p>
            </div>
            <div class="mt-4 flex justify-center space-x-4">
                <button type="button" id="cancelBulkDeleteBtn"
                    class="px-4 py-2 border cursor-pointer border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Cancel
                </button>
                <button type="button" id="confirmBulkDeleteBtn"
                    class="px-4 py-2 cursor-pointer bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>