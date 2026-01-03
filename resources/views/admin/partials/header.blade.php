<header
  class="flex items-center justify-between px-6 py-3 bg-white dark:bg-slate-800 fixed w-full md:sticky top-0 z-10 border-b border-gray-200 dark:border-gray-700">
  <!-- Left side - Toggle button -->
  <div class="flex items-center">
    <button id="toggle-sidebar"
      class="rounded-full cursor-pointer size-9 flex justify-center items-center text-gray-600 dark:text-gray-300
                        hover:text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-900 dark:hover:text-indigo-400 focus:outline-none">
      <i class="fas fa-bars text-lg"></i>
    </button>
  </div>

  <!-- Right side - User actions -->
  <div class="flex items-center space-x-4">
    <div class="ml-4 relative hidden lg:block" id="search-container">
      {{-- <div class="relative">
        <input type="text" id="search-input" placeholder="Search..."
          class="bg-slate-50 border border-slate-300 dark:border-gray-500 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded-full pl-11 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-80">
        <i class="fas fa-search absolute left-4 top-3 text-gray-500 dark:text-gray-400"></i>
      </div> --}}

      <!-- Dropdown results -->
      <div id="search-results"
        class="hidden absolute p-4 z-10 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 max-h-96 overflow-y-auto">
        <!-- Results will be inserted here by JavaScript -->
      </div>
    </div>

    <!-- Dark mode toggle -->
    <button id="dark-mode-toggle"
      class="rounded-full size-9 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900
                        dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none ">
      <!-- Moon icon (shown in light mode) -->
      <svg class="size-4 dark:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor">
        <path
          d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
      </svg>
      <!-- Sun icon (shown in dark mode) -->
      <svg id="sun-icon" class="size-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
        </path>
      </svg>
    </button>

    @php
      $currentLocale = app()->getLocale();

      $locales = [
          'en' => ['name' => 'EN', 'icon' => '🇰🇭'],
          'km' => ['name' => 'KM', 'icon' => '🇺🇸'],
      ];

      $otherLocaleKey = $currentLocale === 'en' ? 'km' : 'en';
      $otherLocale = $locales[$otherLocaleKey];
    @endphp

    <a href="{{ route('lang.switch', ['locale' => $otherLocaleKey]) }}" id="lang-switch-toggle"
      title="Switch to {{ $otherLocale['name'] }}"
      class="rounded-full size-9 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900
           dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none">
      <span class="font-bold text-lg">{{ $otherLocale['icon'] }}</span>
    </a>

    <!-- Notifications -->
    <div class="relative" x-data="{ open: false }" @click.away="open = false" {{-- Closes the dropdown when clicking outside --}}>
      {{-- 1. Notification Button (Toggle) --}}

      <button @click="open = !open"
        class="relative flex items-center justify-center size-10 rounded-full border border-indigo-200 dark:border-indigo-800
           text-indigo-600 dark:text-indigo-300 bg-white dark:bg-gray-800 hover:bg-indigo-50 dark:hover:bg-gray-700
           transition">
        <i class="fas fa-bell text-lg"></i>

        @if (Auth::user()->unreadNotifications->count() > 0)
          <span
            class="absolute -top-1 -right-3 min-w-[18px] h-[18px] px-1.5 flex items-center justify-center bg-red-600 text-white
               text-xs font-bold rounded-full shadow-md">
            {{ Auth::user()->unreadNotifications->count() }}
          </span>
        @endif
      </button>

      <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" id="notification-dropdown"
        class="absolute right-0 z-50 mt-2 w-lg rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700"
        role="menu" aria-orientation="vertical">
        <div class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300 font-semibold">
          Notifications ({{ Auth::user()->unreadNotifications->count() }})
        </div>

        <div class="py-1 max-h-60 overflow-y-auto">
          @forelse (Auth::user()->unreadNotifications->take(5) as $notification)
            <a href="{{ $notification->data['link'] ?? '#' }}"
              class="block px-4 py-3 text-sm hover:bg-indigo-50 dark:hover:bg-gray-700 {{ is_null($notification->read_at) ? 'bg-indigo-50 dark:bg-gray-700/50' : '' }}"
              role="menuitem">
              <p class="font-medium text-gray-900 dark:text-white">{{ $notification->data['title'] ?? 'New Alert' }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                {{ $notification->data['body'] ?? 'Click to view details.' }}</p>
              <span
                class="text-xs text-indigo-500 dark:text-indigo-400">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
          @empty
            <div class="block px-4 py-3 text-sm text-gray-500 dark:text-gray-400 italic">
              {{ __('message.you_have_no_new_notifications') }}
            </div>
          @endforelse
        </div>

        @if (Auth::user()->notifications->count() > 0)
          <div class="px-4 py-2 text-center text-sm">
            <a href="{{ route('admin.notifications.index') }}"
              class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800">
              {{ __('message.view_all_notifications') }}
            </a>
          </div>
        @endif
      </div>
    </div>
    {{-- <div class="relative">
      <button
        class="rounded-full size-9 cursor-pointer border border-indigo-100 text-indigo-600 dark:text-indigo-300 dark:border-indigo-900 dark:hover:bg-gray-700
                             hover:bg-indigo-50 dark:indigo-gray-300 focus:outline-none">
        <i class="fas fa-bell text-xl"></i>
        <span class="notification-dot absolute bg-red-500 rounded-full w-2 h-2"></span>
      </button>
    </div> --}}

    <div class="relative group">
      <!-- User profile button -->
      <button class="cursor-pointer flex items-center focus:outline-none" id="user-menu-button">
        @if (auth()->user()->avatar)
          <img src="{{ asset(auth()->user()->avatar) }}" alt="User"
            class="size-9 rounded-full border-2 border-indigo-500 dark:border-white">
        @else
          <img src="{{ asset('assets/images/cambodia.png') }}" alt="User"
            class="size-9 rounded-full border-2 border-indigo-500 dark:border-white">
        @endif
      </button>

      <!-- Dropdown -->
      <div id="user-dropdown"
        class="border border-gray-200 dark:border-gray-700 absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden animate-fadeIn z-20">
        <a href="{{ route('admin.profile.show') }}"
          class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
          <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          {{ __('message.profile') }}
        </a>

        <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

        <form method="POST" action="{{ route('logout') }}" class="block hover:bg-indigo-100 dark:hover:bg-gray-700">
          @csrf
          <button type="submit" class="flex items-center w-full pl-5 px-4 py-2 text-red-500 cursor-pointer">
            <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
              </path>
            </svg>
            {{ __('message.logout') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</header>
