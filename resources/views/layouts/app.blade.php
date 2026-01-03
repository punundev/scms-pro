<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wat Damnak Learning Centre</title>
    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
      body {
        font-family: sans-serif;
      }

      .swiper-slide {
        width: auto;
      }

      /* Offcanvas transitions */
      .offcanvas {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
      }

      .offcanvas.open {
        transform: translateX(0);
      }

      .backdrop {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
      }

      .backdrop.open {
        opacity: 1;
        visibility: visible;
      }

      /* small helper for smooth submenu transitions */
      .submenu {
        display: none;
      }

      .no-select {
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      /* Hero video cover */
      .hero-video {
        object-fit: cover;
        width: 100%;
        height: 100%;
      }

      .footer-gradient {
        background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
      }

      .dark .footer-gradient {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
      }

      .gradient-text {
        background: linear-gradient(to right, white, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      .dark .gradient-text {
        background: linear-gradient(to right, #e2e8f0, #60a5fa);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      .hero-gradient {
        background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
      }
    </style>
    @include('layouts.partials.metatag')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-50 text-gray-800 transition-colors duration-300">
    <!-- Container -->
    <div class="min-h-screen flex flex-col">
      <!-- Header / Nav -->
      <header class="bg-white/90 backdrop-blur sticky top-0 z-40 shadow-sm border-b border-slate-300">
        <div class="max-w-7xl xl:max-w-[96rem] mx-auto px-4 py-3 flex items-center justify-between">
          <div class="flex items-center gap-4">
            <a href="{{ route('app.home') }}" class="flex items-center gap-3">
              <img src="assets{{ '/images/scms.png' }}" alt="logo" class="size-14 rounded-full border" />
              <div class="hidden sm:block">
                <div class="font-semibold text-lg">Wat Damnak</div>
                <div class="text-xs text-gray-500">Learning Centre</div>
              </div>
            </a>
          </div>

          <!-- Desktop Navigation -->
          <nav class="hidden lg:flex items-center gap-6">
            <ul class="flex gap-2 items-center">
              <li class="group relative">
                <a href="{{ route('app.home') }}"
                  class="border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500 px-3 py-2 transition-colors duration-200">Home</a>
              </li>
              <li class="group relative">
                <a href="{{ route('app.about') }}"
                  class="border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500 px-3 py-2
                                transition-colors duration-200">Who
                  i am</a>
              </li>

              <li class="group relative">
                <a href="{{ route('app.whatwedo') }}"
                  class="border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500 px-3 py-2 transition-colors duration-200">
                  What we do
                </a>
              </li>

              <li class="group relative">
                <button
                  class="border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500 px-3 py-2 flex items-center gap-2 submenu-toggle no-select transition-colors duration-200">Activity
                  <svg class="w-3 h-3 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                      clip-rule="evenodd" />
                  </svg>
                </button>
                <ul class="submenu absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 border border-gray-200">
                  <li><a href="#events"
                      class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">Events</a>
                  </li>

                  <li>
                    <a href="#clubs" class="block px-4 py-2 hover:bg-gray-100 transition-colors duration-200">News</a>
                  </li>
                </ul>
              </li>

              <li>
                <a href="{{ route('app.contact') }}"
                  class="border-b-2 border-transparent hover:border-orange-500 hover:text-orange-500 px-3 py-2 transition-colors duration-200">
                  Contact Us
                </a>
              </li>
            </ul>
          </nav>
          <div class="relative">
            {{-- <a href="{{ route('app.donation') }}"
                        class="px-3 py-2 border border-orange-500 rounded-md bg-orange-500 hover:bg-transparent hover:text-orange-500 text-slate-100 transition-colors duration-200 cursor-pointer">
                        <i
                            class="fas fa-hand-holding-heart w-5 group-hover:text-blue-500 transition-colors duration-200"></i>
                        Donation
                    </a> --}}
            <a href="{{ route('app.donation') }}"
              class="group relative inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-md shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
              <!-- Animated background -->
              <span
                class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
              <!-- Shine effect -->
              <span
                class="absolute top-0 left-0 w-full h-full bg-white opacity-0 group-hover:opacity-20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></span>
              <!-- Button content -->
              <span class="relative flex items-center">
                <i
                  class="fas fa-hand-holding-heart w-5 mr-2 transform group-hover:scale-110 transition-transform duration-200"></i>
                Make a Donation
              </span>
            </a>
          </div>
          <!-- Desktop Theme Toggle -->
          <button id="darkToggle"
            class="darkToggle size-9 hidden lg:flex items-center justify-center rounded-full cursor-pointer p-2 border border-slate-300 hover:bg-gray-100 transition-colors duration-200"
            title="Toggle dark mode">
            <i class="fas fa-moon"></i>
          </button>
          <!-- Mobile controls -->
          <div class="flex items-center gap-3 lg:hidden">
            <button id="mobileOpen"
              class="bg-indigo-800 cursor-pointer text-slate-200 size-9 flex items-center justify-center rounded-full p-2
                        border hover:bg-slate-100 hover:text-indigo-800 transition-colors duration-200"
              aria-expanded="false">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </header>

      <!-- Offcanvas Backdrop -->
      <div id="offcanvasBackdrop" class="backdrop fixed inset-0 bg-black/50 z-50 lg:hidden"></div>
      <!-- Offcanvas Menu -->
      <div id="offcanvasMenu"
        class="offcanvas fixed top-0 left-0 h-full w-80 bg-white shadow-xl z-50 lg:hidden overflow-y-auto">
        <!-- Offcanvas Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
          <div class="flex items-center gap-3">
            <img src="assets{{ '/images/scms.png' }}" alt="logo" class="size-12 rounded-full border" />
            <div>
              <div class="font-semibold text-lg">Wat Damnak</div>
              <div class="text-xs text-gray-500">Learning Centre</div>
            </div>
          </div>
          <button id="mobileClose"
            class="size-8 flex justify-center items-center cursor-pointer
                     hover:bg-red-500 hover:text-slate-200 text-red-500 p-2 rounded-md transition-colors duration-200">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <!-- Offcanvas Body -->
        <div class="p-4">
          <nav class="space-y-2">
            <a href="{{ route('app.home') }}"
              class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
              <i class="fas fa-home w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
              <span>Home</span>
            </a>
            <a href="{{ route('app.about') }}"
              class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
              <i class="fas fa-home w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
              <span>Who I Am</span>
            </a>

            <a href="{{ route('app.whatwedo') }}"
              class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
              <i class="fas fa-tasks w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
              <span>What We Do</span>
            </a>

            <!-- Activity Section -->
            <div class="mobile-menu-section">
              {{-- <button
                            class="mobile-menu-toggle w-full flex items-center justify-between px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                            <div class="flex items-center gap-3">
                                <i
                                    class="fas fa-calendar-alt w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                                <span>Activity</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
                        </button> --}}

              <div
                class="w-full flex items-center justify-between px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                <a href="" class="w-full hover:bg-gray-100 transition-colors duration-200">
                  <div class="flex items-center gap-3">
                    <i
                      class="fas fa-calendar-alt w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
                    <span>Activity</span>
                  </div>
                </a>
                <button
                  class="mobile-menu-toggle group cursor-pointer size-6 flex justify-center items-center border border-slate-200 rounded-full hover:bg-gray-200 transition-colors duration-200">
                  <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
                </button>
              </div>

              <div class="mobile-submenu pl-8 hidden">
                <a href="#events" class="block py-2 px-3 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                  Events
                </a>
                <a href="#clubs" class="block py-2 px-3 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                  News
                </a>
              </div>
            </div>

            <a href="{{ route('app.contact') }}"
              class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
              <i
                class="fas fa-envelope w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>
              <span>Contact Us</span>
            </a>

          </nav>

          <div class="mt-6 flex justify-center">
            <button id="darkToggle"
              class="darkToggle size-9 flex items-center justify-center rounded-full cursor-pointer p-2 border border-slate-300 hover:bg-gray-100 transition-colors duration-200"
              title="Toggle dark mode">
              <i class="fas fa-moon"></i>
            </button>
          </div>

          <!-- Social Links in Mobile Menu -->
          <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="font-medium text-gray-700 mb-4">Follow Us</h4>
            <div class="flex space-x-3">
              <a href="#"
                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all duration-300">
                <i class="fab fa-facebook-f text-sm"></i>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-pink-500 hover:text-white transition-all duration-300">
                <i class="fab fa-instagram text-sm"></i>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-300">
                <i class="fab fa-youtube text-sm"></i>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-400 hover:text-white transition-all duration-300">
                <i class="fab fa-telegram text-sm"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Main -->
      <main class="flex-1">
        @yield('content')
      </main>
      @include('app.partials.footer')
    </div>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    @stack('script')
    <script>
      $(document).ready(function() {

        /* -------------------------------
           AOS
        -------------------------------- */
        AOS.init({
          duration: 1000,
          once: true,
          offset: 100
        });

        /* -------------------------------
           Offcanvas Open / Close (Mobile)
        -------------------------------- */
        $('#mobileOpen').on('click', function() {
          $('#offcanvasMenu').addClass('open');
          $('#offcanvasBackdrop').addClass('open');
          $('body').css('overflow', 'hidden');
        });

        function closeOffcanvas() {
          $('#offcanvasMenu').removeClass('open');
          $('#offcanvasBackdrop').removeClass('open');
          $('body').css('overflow', '');
          $('.mobile-submenu').addClass('hidden');
        }

        $('#mobileClose, #offcanvasBackdrop, #offcanvasMenu a').on('click', closeOffcanvas);

        /* -------------------------------
           Mobile Submenu Toggle
        -------------------------------- */
        $('.mobile-menu-toggle').on('click', function() {
          let submenu = $(this).closest('.mobile-menu-section').find('.mobile-submenu');
          let icon = $(this).find('.fa-chevron-down');

          submenu.toggleClass('hidden');
          icon.toggleClass('rotate-180');
        });

        /* -------------------------------
           Desktop Menu Hover Submenu
        -------------------------------- */
        $('.group').hover(
          function() {
            $(this).find('.submenu').stop(true, true).fadeIn(150);
          },
          function() {
            $(this).find('.submenu').stop(true, true).fadeOut(120);
          }
        );

        /* -------------------------------
           Dark Mode
        -------------------------------- */
        function setDarkMode(isDark) {
          $('html').toggleClass('dark', isDark);
          localStorage.setItem('watdamnak_dark', isDark ? '1' : '0');
        }

        let savedMode = localStorage.getItem('watdamnak_dark');
        if (savedMode === null) {
          setDarkMode(window.matchMedia('(prefers-color-scheme: dark)').matches);
        } else {
          setDarkMode(savedMode === '1');
        }

        $('.darkToggle').on('click', function() {
          setDarkMode(!$('html').hasClass('dark'));
        });

        /* -------------------------------
           Escape key closes menu
        -------------------------------- */
        $(document).on('keydown', function(e) {
          if (e.key === 'Escape') closeOffcanvas();
        });

        /* -------------------------------
           Swiper
        -------------------------------- */
        new Swiper('.mySwiper', {
          loop: true,
          autoplay: {
            delay: 4500
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
        });

        new Swiper('.staffSwiper', {
          slidesPerView: 1,
          spaceBetween: 20,
          loop: true,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
          navigation: false,
          breakpoints: {
            640: {
              slidesPerView: 2
            },
            1024: {
              slidesPerView: 3
            }
          },
        });

        new Swiper('.studentSwiper', {
          slidesPerView: 1,
          spaceBetween: 20,
          loop: true,
          autoplay: {
            delay: 3500
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
          navigation: false,
          breakpoints: {
            640: {
              slidesPerView: 2
            },
            1024: {
              slidesPerView: 3
            }
          },
        });

        /* -------------------------------
           Fancybox
        -------------------------------- */
        Fancybox.bind("[data-fancybox]", {});
      });
    </script>
  </body>

</html>
