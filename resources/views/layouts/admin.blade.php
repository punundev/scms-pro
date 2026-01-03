<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.partials.metatag')

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mainjq.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/slim-select@2.8.0/dist/slimselect.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/slim-select@2.8.0/dist/slimselect.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('style')

  </head>

  <body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 text-sm">
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-20 hidden opacity-0"></div>
    <div class="h-screen">
      @include('admin.partials.sidebar')
      <div class="flex-1 flex flex-col transition-all duration-300 md:ml-64" id="main-content">
        @include('admin.partials.header')

        <main class="flex-1 mt-15 md:mt-0 bg-violet-50 dark:bg-gray-900">
          <div class="sm:p-4">
            @yield('content')
          </div>
        </main>
        @include('admin.partials.footer')
      </div>
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/mainjq.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

    <script>
      (function smoothTitleScroll() {
        const originalTitle = document.title;
        const maxLength = 18;

        if (originalTitle.length <= maxLength) return;

        const spacer = "   •   ";
        const scrollText = originalTitle + spacer;
        let index = 0;

        setInterval(() => {
          document.title =
            scrollText.substring(index) +
            scrollText.substring(0, index);

          index = (index + 1) % scrollText.length;
        }, 220);
      })();
    </script>

    @stack('scripts')
    @stack('script')

  </body>

</html>
