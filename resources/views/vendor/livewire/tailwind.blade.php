@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            {{-- Mobile Previous Link --}}
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-md dark:bg-zinc-800 dark:border-zinc-700">
                    @lang('pagination.previous')
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300 dark:hover:text-gray-200">
                    @lang('pagination.previous')
                </button>
            @endif

            {{-- Mobile Next Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled"
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300 dark:hover:text-gray-200">
                    @lang('pagination.next')
                </button>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-default rounded-md dark:bg-zinc-800 dark:border-zinc-700">
                    @lang('pagination.next')
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-300">
                    @lang('Showing')
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    @lang('to')
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @lang('of')
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    @lang('results')
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-200 cursor-default rounded-l-md dark:bg-zinc-800 dark:border-zinc-700"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage" wire:loading.attr="disabled" aria-label="@lang('pagination.previous')"
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-l-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300 active:bg-gray-100 active:text-gray-600 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300 dark:hover:text-gray-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-200 cursor-default dark:bg-zinc-800 dark:border-zinc-700">
                                    {{ $element }}
                                </span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-gray-200 border border-gray-200 cursor-default dark:bg-zinc-600 dark:border-zinc-600 dark:text-white">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-200 hover:text-gray-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300 dark:hover:text-gray-200"
                                        aria-label="@lang('Go to page :page', ['page' => $page])">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" wire:loading.attr="disabled" aria-label="@lang('pagination.next')"
                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-r-md hover:text-gray-500 focus:z-10 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-300 active:bg-gray-100 active:text-gray-600 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-700 dark:text-gray-300 dark:hover:text-gray-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span
                                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-200 cursor-default rounded-r-md dark:bg-zinc-800 dark:border-zinc-700"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
