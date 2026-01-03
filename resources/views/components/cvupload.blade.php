<div class="mb-2">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
        CV/Resume
    </label>
    <div class="mt-1">
        <!-- Preview Container -->
        <div id="cvPreview" class="hidden w-full">
            <div
                class="h-[155px] flex items-center p-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700/30">
                <div class="flex-shrink-0 p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                    <svg class="size-15 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <p id="cvFileName" class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate"></p>
                    <p id="fileSize" class="text-xs text-gray-500 dark:text-gray-400"></p>
                </div>
                <button type="button" id="removeCv"
                    class="cursor-pointer ml-2 p-1 text-gray-400 hover:text-red-500 dark:hover:text-red-400 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Upload Area -->
        <div id="cvDropArea"
            class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 bg-gray-50/50 dark:bg-gray-700/50 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/20 transition-colors cursor-pointer">
            <div class="p-3 bg-indigo-100/50 dark:bg-indigo-900/30 rounded-full mb-3">
                <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-1"><span class="font-medium">Click to upload</span>
                or drag and drop</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX (MAX. 5MB)</p>
        </div>
        <input type="file" id="cv" name="cv" class="hidden" accept=".pdf,.doc,.docx" max="5120">
    </div>
    <p class="error-cv mt-1 text-sm text-red-600"></p>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cvInput = document.getElementById('cv');
            const cvDropArea = document.getElementById('cvDropArea');
            const cvPreview = document.getElementById('cvPreview');
            const cvFileName = document.getElementById('cvFileName');
            const fileSize = document.getElementById('fileSize');
            const removeCv = document.getElementById('removeCv');

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlightCv() {
                cvDropArea.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
            }

            function unhighlightCv() {
                cvDropArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
            }
            function handleCvFile(file) {
                const validTypes = [
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];

                if (!validTypes.includes(file.type)) {
                    ShowTaskMessage('error', 'Please select a PDF, DOC, or DOCX file');
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    ShowTaskMessage('error', 'File size exceeds 5MB limit');
                    return;
                }

                cvFileName.textContent = file.name;
                fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                cvPreview.classList.remove('hidden');
                cvDropArea.classList.add('hidden');
            }

            function resetCv() {
                cvInput.value = '';
                cvFileName.textContent = '';
                fileSize.textContent = '';
                cvPreview.classList.add('hidden');
                cvDropArea.classList.remove('hidden');
            }

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                cvDropArea.addEventListener(eventName, preventDefaults, false);
            });
            ['dragenter', 'dragover'].forEach(eventName => {
                cvDropArea.addEventListener(eventName, highlightCv, false);
            });
            ['dragleave', 'drop'].forEach(eventName => {
                cvDropArea.addEventListener(eventName, unhighlightCv, false);
            });

            cvDropArea.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length) handleCvFile(files[0]);
            });

            cvDropArea.addEventListener('click', () => cvInput.click());

            cvInput.addEventListener('change', function() {
                if (this.files && this.files[0]) handleCvFile(this.files[0]);
            });

            removeCv.addEventListener('click', resetCv);
        });
    </script>
@endpush
