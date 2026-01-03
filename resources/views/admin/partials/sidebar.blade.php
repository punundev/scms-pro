@php
  $academicsRoutes = [
      'admin.subjects.*',
      'admin.exams.*',
      'admin.scores.*',
      'admin.course_offerings.*',
      'admin.classrooms.*',
      'admin.attendances.*',
      'admin.enrollments.*',
  ];
  $isAcademicsActive = request()->routeIs($academicsRoutes);

  $organizationRoutes = ['admin.teachers.*', 'admin.students.*'];
  $isOrganizationActive = request()->routeIs($organizationRoutes);

  $financeRoutes = ['admin.fee_types.*', 'admin.expense_categories.*', 'admin.expenses.*', 'admin.expenses.*'];
  $isFinanceActive = request()->routeIs($financeRoutes);

  $administratorRoutes = ['admin.users.*', 'admin.roles.*'];
  $isAdministratorActive = request()->routeIs($administratorRoutes);
@endphp

<aside id="sidebar"
  class="sidebar bg-indigo-800 dark:bg-slate-800 border-r border-gray-200 dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-64 md:translate-x-0 -translate-x-full">
  <div class="flex items-center justify-between p-4 border-b border-indigo-700 dark:border-gray-700">
    <div class="flex items-center space-x-2">
      <img
        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' width='24' height='24'%3E%3Cpath d='M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z'/%3E%3C/svg%3E"
        alt="Logo" class="hidden md:block w-8 h-8">
      <h1 class="text-lg font-bold sidebar-text text-hidden">SCMS G2</h1>
    </div>
    <button id="close-sidebar"
      class="md:hidden text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
        </path>
      </svg>
    </button>
  </div>
  <nav class="pt-4 flex-grow overflow-y-auto">
    <ul>
      @if (Auth::user()->hasPermissionTo('view_dashboard'))
        <li class="menu-item relative">
          <a href="{{ route('admin.deshboard') }}"
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200
          {{ request()->routeIs('admin.deshboard*') ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fas fa-tachometer-alt text-center"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.dashboard') }}</span>
            </div>
            <span class="menu-tooltip">{{ __('message.dashboard') }}</span>
          </a>
        </li>
      @endif

      @if (Auth::user()->hasPermissionTo('view_classroom') ||
              Auth::user()->hasPermissionTo('view_subject') ||
              Auth::user()->hasPermissionTo('view_course-offering'))
        <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2"></li>

        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
          {{ $isAcademicsActive ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="ri-graduation-cap-fill text-lg"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.academics') }}</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">{{ __('message.academics') }}</span>
          </div>
          <div class="submenu {{ $isAcademicsActive ? 'active' : '' }}">
            <ul class="pl-4 pr-4">
              @if (Auth::user()->hasPermissionTo('view_classroom'))
                <li>
                  <a href="{{ route('admin.classrooms.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.classrooms.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">{{ __('message.classrooms') }}</a>
                </li>
              @endif

              @if (Auth::user()->hasPermissionTo('view_subject'))
                <li>
                  <a href="{{ route('admin.subjects.index') }}"
                    class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.subjects.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                    {{ __('message.subjects') }}
                  </a>
                </li>
              @endif

              @if (Auth::user()->hasPermissionTo('view_course-offering'))
                <li>
                  <a href="{{ route('admin.course_offerings.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.course_offerings.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">{{ __('message.course_offering') }}
                  </a>
                </li>
              @endif

            </ul>
          </div>
        </li>
      @endif

      @if (Auth::user()->hasPermissionTo('view_teacher') || Auth::user()->hasPermissionTo('view_student'))
        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
          {{ $isOrganizationActive ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fa-solid fa-lock"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.organization') }}</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">{{ __('message.organization') }}</span>
          </div>
          <div class="submenu {{ $isOrganizationActive ? 'active' : '' }}">
            <ul class="pl-4 pr-4">
              @if (Auth::user()->hasPermissionTo('view_teacher'))
                <li>
                  <a href="{{ route('admin.teachers.index') }}"
                    class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.teachers.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                    <span class="ml-2">{{ __('message.teachers') }}</span>
                  </a>
                </li>
              @endif

              @if (Auth::user()->hasPermissionTo('view_student'))
                <li>
                  <a href="{{ route('admin.students.index') }}"
                    class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.students.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                    <span class="ml-2">{{ __('message.students') }}</span>
                  </a>
                </li>
              @endif

            </ul>
          </div>
        </li>

        <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
        </li>
      @endif

      @if (Auth::user()->hasPermissionTo('view_fee-type') || Auth::user()->hasPermissionTo('view_expense-category'))
        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg
                            mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
                            {{ $isFinanceActive ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fas fa-money-bill-wave text-center"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.finance') }}</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">{{ __('message.finance') }}</span>
          </div>
          <div class="submenu {{ $isFinanceActive ? 'active' : '' }}">
            <ul class="pl-2 pr-2">

              @if (Auth::user()->hasPermissionTo('view_fee-type'))
                <li>
                  <a href="{{ route('admin.fee_types.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.fee_types.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                    {{ __('message.fee_collection') }}
                  </a>
                </li>
              @endif

              @if (Auth::user()->hasPermissionTo('view_expense-category'))
                <li>
                  <a href="{{ route('admin.expense_categories.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.expense_categories.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                    {{ __('message.expense_cost') }}
                  </a>
                </li>
              @endif

            </ul>
          </div>
        </li>
      @endif

      <li class="menu-item relative">
        <a href="{{ route('admin.notifications.create') }}"
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200
          {{ request()->routeIs('admin.notifications*') ? 'bg-indigo-700' : '' }}">
          <div class="wr-icon flex items-center">
            <i class="fa-regular fa-bell"></i>
            <span class="ml-3 sidebar-text text-hidden">{{ __('message.notification') }}</span>
          </div>
          <span class="menu-tooltip">{{ __('message.notification') }}</span>
        </a>
      </li>

      @if (Auth::user()->hasPermissionTo('view_report'))
        <li class="menu-item relative">
          <a href="{{ route('admin.reports') }}"
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200
          {{ request()->routeIs('admin.reports') ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fas fa-tachometer-alt text-center"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.report') }}</span>
            </div>
            <span class="menu-tooltip">{{ __('message.report') }}</span>
          </a>
        </li>

        <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
        </li>
      @endif

      @if (Auth::user()->hasRole('admin'))
        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
            {{ $isAdministratorActive ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fa-solid fa-lock"></i>
              <span class="ml-3 sidebar-text text-hidden">{{ __('message.administrator') }}</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">{{ __('message.administrator') }}</span>
          </div>
          <div class="submenu {{ $isAdministratorActive ? 'active' : '' }}">
            <ul class="pl-4 pr-4">
              @if (Auth::user()->hasPermissionTo('view_user'))
                <li>
                  <a href="{{ route('admin.users.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                  {{ request()->routeIs('admin.users.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">{{ __('message.users') }}</a>
                </li>
              @endif

              @if (Auth::user()->hasPermissionTo('view_role'))
                <li>
                  <a href="{{ route('admin.roles.index') }}"
                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                  {{ request()->routeIs('admin.roles.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">{{ __('message.roles') }}</a>
                </li>
              @endif
          </div>
        </li>
      @endif
    </ul>
  </nav>
</aside>
