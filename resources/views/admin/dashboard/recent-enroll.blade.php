    <!-- Recently Enrolled Students Table -->
    <div
      class="box bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden mb-4">
      <div class="p-4 md:flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3 md:mb-0">{{ __('message.recently_enrolled_students') }}
        </h2>
        <div class="flex items-center gap-2">
          <div class="relative">
            <input type="text" placeholder="Search students..."
              class="bg-gray-100 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>
          <button
            class="p-2 h-8 w-8 flex items-center justify-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg transition-colors">
            <i class="fas fa-redo text-gray-600 dark:text-gray-300 text-sm"></i>
          </button>
        </div>
      </div>
      <div class="table-respone overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
            <tr>
              <th scope="col" class="px-6 py-3">{{ __('message.student') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.status') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.join_date') }}</th>
              <th scope="col" class="px-6 py-3"><span class="sr-only">{{ __('message.actions') }}</span></th>
            </tr>
          </thead>
          <tbody>

            @if (count($recentStudents) > 0)
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody>
                  @foreach ($recentStudents as $recent)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                      <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div class="flex items-center">
                          <img class="w-9 h-9 rounded-full" src="{{ $recent->student->avatar_url }}"
                            alt="{{ $recent->student->name }} image">
                          <div class="pl-3">
                            <div class="text-base font-semibold">
                              {{ $recent->student->name }}
                            </div>
                            <div class="font-normal text-gray-500">
                              {{ $recent->student->email }}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4">
                        <span
                          class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                      </td>
                      <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($recent->created_at)->format('Y-m-d') }}</td>
                      <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.students.show', $recent->student->id) }}"
                          class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">{{ __('message.details') }}</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="p-4 text-center text-red-500 dark:text-gray-400">
                {{ __('message.no_recent_students_found') }}
              </div>
            @endif
          </tbody>
        </table>
      </div>
    </div>
