@if ($paginator->hasPages())
  @php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();

    $start = max(1, $current - 2);
    $end = min($last, $current + 2);

    if ($end - $start < 4) {
        if ($start === 1) {
            $end = min(5, $last);
        } elseif ($end === $last) {
            $start = max(1, $last - 4);
        }
    }
  @endphp

  <nav class="flex items-center justify-center gap-1">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
      <span
        class="px-4 py-2 text-sm rounded-lg bg-gray-200 text-gray-400 dark:bg-gray-700 dark:text-gray-500 cursor-not-allowed">
        <i class="fa-solid fa-arrow-left"></i>
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}"
        class="px-4 py-2 text-sm rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 transition
                  dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    @endif

    {{-- First page --}}
    @if ($start > 1)
      <a href="{{ $paginator->url(1) }}"
        class="px-4 py-2 text-sm rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-indigo-50 transition
                      dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
        1
      </a>
      <span class="px-2 text-gray-400">…</span>
    @endif

    {{-- Pages --}}
    @for ($page = $start; $page <= $end; $page++)
      @if ($page == $current)
        <span class="px-4 py-2 text-sm font-semibold rounded-lg bg-indigo-600 text-white shadow">
          {{ $page }}
        </span>
      @else
        <a href="{{ $paginator->url($page) }}"
          class="px-4 py-2 text-sm rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-indigo-50 transition
                      dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
          {{ $page }}
        </a>
      @endif
    @endfor

    {{-- Last page --}}
    @if ($end < $last)
      <span class="px-2 text-gray-400">…</span>
      <a href="{{ $paginator->url($last) }}"
        class="px-4 py-2 text-sm rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-indigo-50 transition
                      dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
        {{ $last }}
      </a>
    @endif

    {{-- Next --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}"
        class="px-4 py-2 text-sm rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 transition
                  dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    @else
      <span
        class="px-4 py-2 text-sm rounded-lg bg-gray-200 text-gray-400 dark:bg-gray-700 dark:text-gray-500 cursor-not-allowed">
        <i class="fa-solid fa-arrow-right"></i>
      </span>
    @endif

  </nav>
@endif
