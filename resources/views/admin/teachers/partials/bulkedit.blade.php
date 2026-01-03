<!-- Bulk Edit Modal -->
<div id="bulkEditModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-white dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Bulk Edit Subject (<span id="bulkEditCount">0</span>/5)
            </h3>
            <button id="closeBulkEditModal"
                class="text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="bulkEditForm" action="{{ route('admin.teachers.bulkUpdate') }}" method="POST" class="p-4 pt-0">
            @csrf
            @method('PUT')

            <div id="bulkEditContainer" class="pt-4 overflow-y-auto">
                <!--fields will be added here -->
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button type="button" id="cancelBulkEditModal"
                    class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2"
                    id="bulkEditSubmitBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
