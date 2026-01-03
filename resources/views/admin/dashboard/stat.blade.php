    <div class="box grid sm:grid-cols-2 grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
      <!-- Fees Collected -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-amber-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.fees_collected') }}</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
              ${{ number_format($feesCollected, 2) }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-dollar-sign text-amber-100 dark:text-amber-200 text-xl"></i>
          </div>
        </div>
        <div>
          <p class="text-red-500 dark:text-red-400 text-sm font-medium">{{ __('message.fees_pending') }}</p>
          <h3 class="text-xl font-bold text-red-800 dark:text-white mt-1">
            - ${{ number_format($feesUnpaid, 2) }}</h3>
        </div>
        <div class="flex items-center justify-end mt-4">
          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-amber-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu" aria-orientation="vertical" tabindex="-1">
              <div class="py-1" role="none">
                <a href="{{ route('admin.fees.index') }}"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.view_details') }}
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.export_data') }}
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Fees Collected -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-amber-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.expense_cost') }}</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
              ${{ number_format($totalExpense, 2) }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-dollar-sign text-amber-100 dark:text-amber-200 text-xl"></i>
          </div>

        </div>
        <div>
          <p class="text-red-500 dark:text-red-400 text-sm font-medium">{{ __('message.expense_pending') }}</p>
          <h3 class="text-xl font-bold text-red-800 dark:text-white mt-1">
            - ${{ number_format($pendingExpense, 2) }}</h3>
        </div>
        <div class="flex items-center justify-end mt-4">

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-amber-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu" aria-orientation="vertical" tabindex="-1">
              <div class="py-1" role="none">
                <a href="{{ route('admin.expenses.index') }}"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.view_details') }}
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.export_data') }}
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Total Students -->
      <div
        class="bg-white dark:hover:bg-blue-950 dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm relative"
        id="student-card">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.total_students') }}</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalStudents }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-user-graduate text-blue-100 dark:text-blue-200 text-xl"></i>
          </div>
        </div>
        <div>
          <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.total_teachers') }}</p>
          <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalTeachers }}</h3>
        </div>
        <div class="flex items-center justify-end mt-4">

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button type="button"
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-900 hover:text-blue-500 transition-colors"
                aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu">
              <div class="py-1" role="none">
                <a href="{{ route('admin.students.index') }}"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.view_details') }}
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.export_data') }}
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Active Classes -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-green-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('message.active_course') }}</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $activeCourse }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-book text-green-100 dark:text-green-200 text-xl"></i>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div>
            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> 3.1%
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">{{ __('message.vs_last_month') }}</span>
          </div>

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-green-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu" aria-orientation="vertical" tabindex="-1">
              <div class="py-1" role="none">
                <a href="{{ route('admin.course_offerings.index') }}"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.view_details') }}
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  {{ __('message.export_data') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
