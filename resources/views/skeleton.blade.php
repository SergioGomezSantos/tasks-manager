<div class="p-6 lg:col-span-2">
    <h1 class="text-2xl mb-4 border-b-2">Tasks</h1>

    @foreach (range(1, 4) as $item)
        <div class="mb-4 flex items-center justify-between">
            <div class="h-46 bg-white dark:bg-white/10 rounded-xl w-full"></div>
        </div>
    @endforeach
</div>
