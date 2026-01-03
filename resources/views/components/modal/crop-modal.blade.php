<!-- Cropper Modal (same as create page but with edit-specific IDs) -->
<div id="cropModal"
    class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-lg bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="img-container">
                    <img id="editImageToCrop" class="max-w-full max-h-[60vh]" src="" alt="Image to crop">
                </div>
            </div>

            <div class="md:w-64 flex flex-col gap-3">
                <div class="preview-container overflow-hidden w-[200px] h-[200px] rounded-full"></div>
                <div class="flex gap-2 mt-2">
                    <button type="button" id="editRotateLeft"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    </button>
                    <button type="button" id="editRotateRight"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
                        </svg>
                    </button>
                    <button type="button" id="editFlipHorizontal"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </button>
                </div>

                <div class="flex gap-2 mt-auto pt-4">
                    <button type="button" id="applyEditCrop"
                        class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex-1">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
