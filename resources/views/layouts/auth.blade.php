<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.partials.metatag')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body>
    <div id="app">
      <!-- Dark mode toggle -->
      <button id="dark-mode-toggle"
        class="rounded-full size-9 fixed top-4 right-4 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900
                        dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none ">
        <!-- Moon icon (shown in light mode) -->
        <svg class="size-4 dark:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="currentColor">
          <path
            d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
        </svg>
        <!-- Sun icon (shown in dark mode) -->
        <svg class="size-4 hidden dark:block text-indigo-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
          fill="currentColor">
          <path
            d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z" />
        </svg>
      </button>
      <main>
        @yield('content')
      </main>
    </div>
    @stack('scripts')
    <script>
      const darkModeToggle = document.getElementById('dark-mode-toggle');
      // Dark Mode
      const applyDarkMode = (isDark) => {
        if (isDark) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      };
      const toggleDarkMode = () => {
        const isDark = !document.documentElement.classList.contains('dark');
        localStorage.setItem('dark-mode', isDark);
        applyDarkMode(isDark);
      };
      darkModeToggle.addEventListener('click', toggleDarkMode);
      const prefersDark = localStorage.getItem('dark-mode') === 'true' ||
        (!localStorage.getItem('dark-mode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
      applyDarkMode(prefersDark);
    </script>
  </body>

</html>
