@if (count($teachers) > 0)
    @foreach ($teachers as $teacher)
        <div
            class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Profile Header -->
            <div class="relative bg-gradient-to-r from-indigo-500 to-purple-600 h-24 flex items-end justify-center">
                <!-- Circular Avatar -->
                <div class="absolute -bottom-15">
                    <div data-id="{{ $teacher->id }}"
                        class="detail-btn size-32 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 overflow-hidden shadow-lg">
                        @if ($teacher->avatar)
                            <img src="{{ asset($teacher->avatar) }}" alt="{{ $teacher->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600">
                                <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300">
                                    {{ substr($teacher->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Body -->
            <div class="pt-16 pb-5 px-5">
                <!-- Name and Title -->
                <div class="text-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $teacher->name }}</h3>
                    <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">
                        {{ $teacher->specialization ?? 'Teacher' }}
                    </p>
                    @if ($teacher->department)
                        <span
                            class="inline-block mt-1 px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200">
                            {{ $teacher->department->name }}
                        </span>
                    @endif
                </div>

                <!-- Stats -->
                <div class="flex justify-around text-center border-y border-gray-100 dark:border-slate-700 py-3 mb-4">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Experience</p>
                        <p class="font-bold text-gray-700 dark:text-gray-200">
                            {{ $teacher->experience ?? '0' }}<span class="text-xs font-normal"> yrs</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Qualification</p>
                        <p class="font-bold text-gray-700 dark:text-gray-200 text-sm">
                            {{ $teacher->qualification_short ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs">Since</p>
                        <p class="font-bold text-gray-700 dark:text-gray-200 text-sm">
                            {{ optional($teacher->joining_date)->format('Y') ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="space-y-2 text-sm">
                    <x-info.item label="Email" icon="ri-mail-line" name="{{ $teacher->email ?? 'Not provided' }}" />
                    <x-info.item label="Phone" icon="ri-phone-line" name="{{ $teacher->phone ?? 'Not provided' }}" />
                    <x-info.item label="Salary" icon="ri-money-dollar-circle-line" name="${{ $teacher->salary }}" />
                </div>
            </div>

            <!-- Footer Actions -->
            <div
                class="px-5 py-3 bg-gray-50 dark:bg-slate-700/30 border-t border-gray-100 dark:border-slate-700 flex justify-between">
                {{-- <a href="{{ route('teachers.show', $teacher->id) }}">pro</a> --}}
                <a data-id="{{ $teacher->id }}" title="view"
                    class="detail-btn flex items-center cursor-pointer text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 text-sm font-medium">
                    <span class="btn-content"><i class="ri-profile-line mr-2"></i> Profile</span>
                </a>

                <div class="flex gap-2">
                    <button
                        class="btn edit-btn p-2 rounded-full flex items-center justify-center size-8 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                        data-id="{{ $teacher->id }}" title="Edit">
                        <i class="ri-pencil-line text-sm"></i>
                    </button>
                    <button
                        class="delete-btn p-2 rounded-full flex items-center justify-center size-8 cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                        data-id="{{ $teacher->id }}" title="Delete">
                        <i class="ri-delete-bin-line text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <x-not-found-data title="teachers" />
@endif
