<div
    class="relative pr-4 ml-4 mb-4 border border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl flex justify-center items-center">

    <div
        class="p-2 ml-4 my-4 border border-zinc-200 dark:border-white/10 bg-white dark:bg-white/10 rounded-tl-lg rounded-bl-lg h-10 flex items-center">
        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </div>

    <input wire:model.live.throttle.5ms="search" type="text"
        class="p-2 my-4 bg-white dark:bg-white/10 rounded-tr-lg rounded-br-lg max-w-40 h-10"
        placeholder="Title Search..." />

    @if(count($results) > 0)
        <div class="absolute top-full left-0 mt-1 w-full bg-white dark:bg-gray-700 rounded-md shadow-lg z-10">
            @foreach ($results as $result)
                <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-white/20 cursor-pointer">
                    <a href="/{{ $result->slug }}" class="flex justify-between items-center">
                        <span>{{ Str::limit($result->title, 10) }}</span>
                        <span>{{ $result->deadline->diffForHumans() }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
