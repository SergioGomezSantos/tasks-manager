<div class="p-6 pt-0 lg:col-span-2">
    <div class="flex justify-between items-center w-full">
        <div class="w-full sm:w-2/3">
            <livewire:tasks.tasks-count :$tasksByStatus />
        </div>
        <div class="w-full sm:w-1/3">
            <livewire:tasks.tasks-search />
        </div>
    </div>

    @if (empty($tasks))
        <p class="text-gray-500 text-center">No tasks available. Create a new one!</p>
    @endif

    @foreach ($tasks as $task)
        <div class="mb-4">
            <x-tasks.task-card 
                :task="$task" 
                :truncate-description="true"
                :show-view-button="true"
                :task-id="$task->id"
                :delete-method="'delete(' . $task->id . ')'"
            />
        </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</div>