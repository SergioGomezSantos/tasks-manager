
<div class="mt-6 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Task Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <x-tasks.task-info-field label="Title" :value="$task->title" />
            <x-tasks.task-info-field label="Slug" :value="$task->slug" />
            <x-tasks.task-info-field label="Status" :value="Str::of($task->status->value)->headline()" />
            <x-tasks.task-info-field label="Priority" :value="Str::of($task->priority->value)->headline()" />
            <x-tasks.task-info-field label="Description" :value="$task->description" class="border-t-2 border-gray-500 dark:border-white pb-2 col-span-2 mt-4 pt-4" />
            <x-tasks.task-info-field label="Created At" :value="$task->created_at->format('M d, Y H:i:s')" />
            <x-tasks.task-info-field label="Updated At" :value="$task->updated_at->format('M d, Y H:i:s')" />
        </div>
    </div>
</div>