<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.partials.metatag')

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'school-primary': '#1e3a8a',
              'school-secondary': '#3b82f6',
              'school-accent': '#f59e0b',
              'school-dark': '#111827',
              'school-light': '#f3f4f6',
            },
            animation: {
              'bounce-slow': 'bounce 3s ease-in-out infinite',
              'fade-in': 'fadeIn 1.5s ease-in-out',
            },
            keyframes: {
              bounce: {
                '0%, 100%': {
                  transform: 'translateY(0)'
                },
                '50%': {
                  transform: 'translateY(-15px)'
                },
              },
              fadeIn: {
                '0%': {
                  opacity: '0',
                  transform: 'scale(0.95)'
                },
                '100%': {
                  opacity: '1',
                  transform: 'scale(1)'
                },
              },
            },
          },
        },
      };
    </script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

      body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(to bottom, #f3f4f6, #e5e7eb);
        overflow-x: hidden;
      }

      .chalkboard-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231e3a8a' fill-opacity='0.05'%3E%3Cpath d='M0 0h40v40H0z'/%3E%3Cpath d='M20 20l10-10m0 10l-10-10m-10 10l10-10m0 10l-10-10'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        background-size: 40px 40px;
      }

      .book-icon {
        transform: rotate(-10deg);
      }

      .error-text {
        position: relative;
        display: inline-block;
      }

      .error-text::after {
        content: '';
        position: absolute;
        right: -15px;
        top: 0;
        height: 100%;
        width: 6px;
        background-color: #f59e0b;
        animation: blink 1s infinite;
      }

      @keyframes blink {

        0%,
        100% {
          opacity: 1;
        }

        50% {
          opacity: 0;
        }
      }
    </style>
  </head>

  <body class="antialiased chalkboard-pattern min-h-screen flex items-center justify-center px-4">
    @yield('content')
    <script src="{{ asset('js/dontthaitome.js') }}" data-position="top"></script>
  </body>

</html>
