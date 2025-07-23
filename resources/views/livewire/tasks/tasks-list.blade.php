<div class="p-6 lg:col-span-2">

    
    <div class="flex justify-between items-center mb-4 border-b-2">
        <h1 class="text-2xl">Tasks</h1>
        <livewire:tasks.tasks-count :count="$count" />
    </div>


    @if (empty($tasks))
        <p class="text-gray-500 text-center">No tasks available. Create a new one!</p>
    @endif

    @foreach ($tasks as $task)
        <div class="mb-4 bg-white dark:bg-white/10 rounded-xl">
            <div class="p-4">
                <h3 class="text-lg border-b-2">{{ $task->title }}</h3>
                <p class="text-sm mb-2 text-right">{{ $task->slug }}</p>
                <p class="my-6">{{ $task->description }}</p>
                <div class="flex justify-between items-center text-sm">
                    <span
                        class="px-2 py-1 border rounded">{{ ucwords(strtolower(str_replace('_', ' ', $task->status->value))) }}</span>
                    <span
                        class="px-7 py-1 border rounded">{{ ucwords(strtolower(str_replace('_', ' ', $task->priority->value))) }}</span>
                    <span class="px-2 py-1 border rounded">{{ $task->deadline->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</div>
