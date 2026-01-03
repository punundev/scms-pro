@if ($paginator->hasPages() && $paginator->total() > 0)
    <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-4 pt-3 sm:px-6">
        {{-- Desktop Pagination Controls --}}
        <div class="sm:flex sm:flex-1 sm:items-center sm:justify-between">
            {{-- Showing Results --}}
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Showing <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of <span class="font-medium">{{ $paginator->total() }}</span> results
                </p>
            </div>
            <div class="flex items-center">
                <span class="text-sm text-gray-700 dark:text-gray-300 mr-2">Rows per page:</span>
                <select id="perPageSelect" name="per_page"
                    class="text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:text-gray-300">
                    <option value="8" {{ $paginator->perPage() == 8 ? 'selected' : '' }}>8</option>
                    <option value="15" {{ $paginator->perPage() == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $paginator->perPage() == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $paginator->perPage() == 25 ? 'selected' : '' }}>25</option>
                </select>
            </div>
            {{-- Page Links --}}
            <div class="flex items-center space-x-2">
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">

                    {{-- Previous Page --}}
                    @if ($paginator->onFirstPage())
                        <span
                            class="pagination-link relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 cursor-not-allowed"
                            data-page="{{ $paginator->currentPage() - 1 }}">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <a href="#"
                            class="pagination-link relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                            data-page="{{ $paginator->currentPage() - 1 }}">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Numbered Pages --}}
                    @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                class="pagination-link active relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white"
                                data-page="{{ $page }}">
                                {{ $page }}
                            </span>
                        @else
                            <a href="#"
                                class="pagination-link relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                                data-page="{{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($paginator->hasMorePages())
                        <a href="#"
                            class="pagination-link relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700"
                            data-page="{{ $paginator->currentPage() + 1 }}">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span
                            class="pagination-link relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 dark:text-gray-500 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 cursor-not-allowed"
                            data-page="{{ $paginator->currentPage() + 1 }}">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5 rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif

                </nav>
            </div>
        </div>
    </div>
@endif
