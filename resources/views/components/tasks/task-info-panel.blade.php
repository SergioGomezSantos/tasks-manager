<div class="mt-6 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 text-lg rounded-xl">
    <div class="p-6">
        <h3
            class="mb-4 border-b-2 border-gray-500 dark:border-white font-semibold text-gray-900 dark:text-white text-xl">
            Task Information</h3>

        <x-tasks.task-info-field label="Title" :value="$task->title" />
        <x-tasks.task-info-field label="Slug" :value="$task->slug" class="ml-4" />

        <x-tasks.task-info-field label="Completed Description" :value="$task->description"
            class="border-t-2 border-gray-500 dark:border-white mt-4 pt-4" :block="true" />

        <x-tasks.task-info-field label="Status" :value="Str::of($task->status->value)->headline()"
            class="border-t-2 border-gray-500 dark:border-white mt-4 pt-4" />
        <x-tasks.task-info-field label="Priority" :value="Str::of($task->priority->value)->headline()" />
        <x-tasks.task-info-field label="Deadline" :value="$task->deadline->format('d/m/Y') . ' - ' . $task->deadline->diffForHumans()" />

        <x-tasks.task-info-field label="Created At" :value="$task->created_at->format('H:i - d/m/Y')" 
            class="border-t-2 border-gray-500 dark:border-white mt-4 pt-4" />
        <x-tasks.task-info-field label="Updated At" :value="$task->updated_at->format('H:i - d/m/Y')" />
    </div>
</div>