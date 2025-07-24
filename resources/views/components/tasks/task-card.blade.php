<div class="border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
    <div class="pt-8 pl-8 pb-4 pr-4">
        <div class="flex justify-between">
            <h{{ $headingLevel ?? 3 }} class="{{ $titleClasses ?? 'text-lg font-bold' }}">
                @if($showLink ?? true)
                    <a href="/{{ $task->slug }}">{{ $task->title }}</a>
                @else
                    {{ $task->title }}
                @endif
            </h{{ $headingLevel ?? 3 }}>
            
            <x-tasks.task-priority-badge :task="$task" />
        </div>

        @if($showDescription ?? true)
            <p class="mb-4 font-normal text-gray-700 dark:text-gray-400">
                {{ $truncateDescription ? Str::limit($task->description, 50) : $task->description }}
            </p>
        @endif

        <div class="flex justify-between text-sm">
            <x-tasks.task-status-buttons :task="$task" />
            <x-tasks.task-action-buttons :task="$task" :show-view="$showViewButton ?? true" />
        </div>
    </div>
</div>