<div class="p-6 pt-0 lg:col-span-2">
    <div class="mb-4 flex items-center justify-between">
        <div class="h-20 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl w-full"></div>
    </div>

    @foreach (range(1, 3) as $item)
        <div class="mb-4 flex items-center justify-between">
            <div class="h-46 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl w-full"></div>
        </div>
    @endforeach
</div>
