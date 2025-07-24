<div class="p-6 pt-0 lg:col-span-2">
    <div class="flex justify-between items-center w-full">
        <div class="w-full sm:w-2/3">
            <livewire:tasks.tasks-count :$tasksByStatus :selected-status="$selectedStatus" />
        </div>
        <div class="w-full sm:w-1/3">
            <livewire:tasks.tasks-search />
        </div>
    </div>

    @if (empty($tasks->items()))
        <div class="text-center py-12">
            @if ($selectedStatus)
                <p class="text-gray-500 text-lg mb-2">
                    No tasks found with status: <strong>{{ Str::of($selectedStatus)->headline() }}</strong>
                </p>
            @else
                <p class="text-gray-500 text-lg">No tasks available. Create a new one!</p>
            @endif
        </div>
    @else
        @foreach ($tasks as $task)
            <div class="mb-4">
                <x-tasks.task-card 
                    :task="$task"
                    :show-back-button="false" 
                    :task-id="$task->id" />
            </div>
        @endforeach

        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    @endif
</div>
