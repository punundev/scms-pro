<!-- Detail Modal -->
<div id="Modaldetail" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div
        class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl transform transition-all duration-300 opacity-0 scale-95 border border-gray-200 dark:border-gray-600">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                    <path
                        d="M3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762z" />
                    <path
                        d="M9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z" />
                    <path d="M6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                </svg>
                Teacher <span class="title"></span>
            </h3>
            {{-- <x-button.btnclose id="close"/> --}}
        </div>

        <!-- Content -->
        <div class="bg-white dark:bg-slate-800 overflow-y-auto max-h-[80vh]">
            <!-- Profile Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-28 flex items-end justify-center">
                <!-- Circular Avatar -->
                <div class="absolute -bottom-12">
                    <div
                        class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 overflow-hidden shadow-lg">
                        <img id="detail_avatar" src="" alt="" class="w-full h-full object-cover">
                        <div id="detail_initials"
                            class="w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600 hidden">
                            <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Body -->
            <div class="pt-16 pb-5 px-5">
                <!-- Name and Title -->
                {{-- <div class="text-center mb-4">
                    <h3 id="detail_name" class="text-xl font-bold text-gray-800 dark:text-white"></h3>
                    <p id="detail_specialization" class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">
                    </p>
                    <span id="detail_department"
                        class="inline-block mt-1 px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 hidden">
                    </span>
                </div> --}}

                <!-- Stats -->
                <div
                    class="grid grid-cols-3 gap-4 text-center border-y border-gray-100 dark:border-slate-700 py-3 mb-4">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Experience</p>
                        <p class="font-bold text-gray-700 dark:text-gray-200">
                            <span id="detail_experience"></span><span class="text-xs font-normal"> yrs</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Qualification</p>
                        <p id="detail_qualification" class="font-bold text-gray-700 dark:text-gray-200 text-sm">
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Since</p>
                        <p id="detail_joining_date" class="font-bold text-gray-700 dark:text-gray-200 text-sm">
                        </p>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-3 text-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300">
                            <div
                                class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700 text-indigo-600 dark:text-indigo-400">
                                <i class="ri-mail-line"></i>
                            </div>
                            <span id="detail_email" class="truncate"></span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300">
                            <div
                                class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700 text-indigo-600 dark:text-indigo-400">
                                <i class="ri-phone-line"></i>
                            </div>
                            <span id="detail_phone"></span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300">
                            <div
                                class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700 text-indigo-600 dark:text-indigo-400">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <span id="detail_date_of_birth"></span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300">
                            <div
                                class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700 text-indigo-600 dark:text-indigo-400">
                                <i class="ri-money-dollar-circle-line"></i>
                            </div>
                            <span id="detail_salary" class="truncate"></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-gray-600 dark:text-gray-300">
                        <div class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700 text-indigo-600 dark:text-indigo-400">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <p id="detail_address"></p>
                    </div>
                    <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">CV/Resume</h4>
                        <div id="cv_preview_container" class="hidden">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div
                                    class="p-4 rounded-lg bg-white dark:bg-gray-600 text-indigo-600 dark:text-indigo-400">
                                    <i class="ri-file-text-line text-4xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p id="cv_filename"
                                        class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate"></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Click to view</p>
                                </div>
                                <a id="cv_download_btn" href="#" download
                                    class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-gray-600 rounded-full">
                                    <i class="ri-download-line"></i>
                                </a>
                            </div>
                        </div>
                        <div id="no_cv_message" class="text-sm text-gray-500 dark:text-gray-400 italic">
                            No CV/resume uploaded
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="flex justify-end p-4 border-t border-gray-200 dark:border-gray-700">
            <button type="button" id="closeDetailModalBtn"
                class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors flex items-center gap-2">
                Close
            </button>
        </div>
    </div>
</div>
