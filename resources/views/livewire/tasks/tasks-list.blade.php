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
        <div class="mb-4 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
            <div class="pt-8 pl-8 pb-4 pr-4">

                <div class="flex justify-between">

                    <h3 class="text-lg font-bold">
                        <a href="/{{ $task->slug }}">{{ $task->title }}</a>
                    </h3>

                    <div @class([
                        'flex items-center',
                        'opacity-50' => $task->status->value == 'completed',
                    ])>

                        @php
                            $priorityEnum = App\Enums\PriorityType::from($task->priority->value);
                        @endphp

                        <span @class([
                            'px-2 py-1 border-1 bg-white dark:bg-white/10 rounded-tl-lg rounded-bl-lg',
                            $priorityEnum->borderColor(),
                            $priorityEnum->textColor(),
                        ])>
                            {{ Str::of($task->priority->value)->headline() }}
                        </span>
                        <span
                            class="px-2 py-1 border-1 border-zinc-200 dark:border-white/10 bg-white dark:bg-white/10 rounded-tr-lg rounded-br-lg">
                            {{ $task->deadline->diffForHumans() }}
                        </span>
                    </div>
                </div>

                {{-- <p class="text-sm mb-2 text-right">{{ $task->slug }}</p> --}}
                <p class="mb-4 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($task->description, 50) }}
                </p>

                <div class="flex justify-between text-sm">
                    <div class="flex gap-2">
                        @foreach (App\Enums\StatusType::cases() as $case)
                            @php
                                $isCurrentStatus = $case->value == $task->status->value;
                            @endphp

                            <button type="button" wire:click="changeStatus({{ $task->id }}, '{{ $case->value }}')"
                                wire:target="changeStatus('{{ $case->value }}')" @class([
                                    'px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-white/10 shadow-sm',
                                    'disabled:opacity-25 transition ease-in-out duration-150',
                                    'cursor-not-allowed' => $case->value == $task->status->value,
                                    'cursor-pointer' => $case->value != $task->status->value,
                                    $case->borderColor(),
                                    $case->textColor(),
                                ])
                                @if ($isCurrentStatus) disabled @endif>

                                <span wire:loading.remove
                                    wire:target="changeStatus({{ $task->id }}, '{{ $case->value }}')">
                                    {{ Str::of($case->value)->headline() }}
                                </span>
                                <span wire:loading
                                    wire:target="changeStatus({{ $task->id }}, '{{ $case->value }}')"
                                    class="flex items-center">
                                    <svg class="animate-spin h-3 w-3" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center gap-2">
                        <x-button>
                            <a href="/{{ $task->slug }}">View</a>
                        </x-button>
                        <x-button class="cursor-pointer !border-blue-500 !text-blue-500"
                            wire:click="$dispatch('edit-task', {taskId: {{ $task->id }}})">
                            Edit
                        </x-button>
                        <x-button class="cursor-pointer !border-red-500 !text-red-500"
                            wire:click="delete({{ $task->id }})"
                            wire:confirm='Are you sure you want to delete this task?'>
                            X
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</div>
