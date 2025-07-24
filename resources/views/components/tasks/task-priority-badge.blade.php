@php
    $priorityEnum = App\Enums\PriorityType::from($task->priority->value);
@endphp

<div @class([
    'flex items-center',
    'opacity-50' => $task->status->value == 'completed',
])>
    <span @class([
        'px-2 py-1 border-1 bg-white dark:bg-white/10 rounded-tl-lg rounded-bl-lg',
        $priorityEnum->borderColor(),
        $priorityEnum->textColor(),
    ])>
        {{ Str::of($task->priority->value)->headline() }}
    </span>
    <span class="px-2 py-1 border-1 border-zinc-200 dark:border-white/10 bg-white dark:bg-white/10 rounded-tr-lg rounded-br-lg">
        {{ $task->deadline->diffForHumans() }}
    </span>
</div>