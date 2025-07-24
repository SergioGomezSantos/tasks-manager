<div class="justify-center items-start flex h-full w-full p-4">
    <div class="w-full max-w-7xl mx-auto">

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="p-6 pt-0 lg:col-span-2">

                <div class="border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
                    <div class="pt-8 pl-8 pb-4 pr-4">

                        <div class="flex justify-between">
                            <h1 class="text-2xl font-bold">{{ $task->title }}</h1>

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

                        <p class="my-6 font-normal text-gray-700 dark:text-gray-400 text-base">{{ $task->description }}
                        </p>

                        <div class="flex justify-between text-sm">
                            <div class="flex gap-2">
                                @foreach (App\Enums\StatusType::cases() as $case)
                                    @php
                                        $isCurrentStatus = $case->value == $task->status->value;
                                    @endphp

                                    <button type="button" wire:click="changeStatus('{{ $case->value }}')"
                                        wire:target="changeStatus('{{ $case->value }}')" @class([
                                            'px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-white/10 shadow-sm',
                                            'disabled:opacity-25 transition ease-in-out duration-150',
                                            'cursor-not-allowed' => $case->value == $task->status->value,
                                            'cursor-pointer' => $case->value != $task->status->value,
                                            $case->borderColor(),
                                            $case->textColor(),
                                        ])
                                        @if ($isCurrentStatus) disabled @endif>

                                        <span wire:loading.remove wire:target="changeStatus('{{ $case->value }}')">
                                            {{ Str::of($case->value)->headline() }}
                                        </span>
                                        <span wire:loading wire:target="changeStatus('{{ $case->value }}')"
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
                                <x-button class="cursor-pointer !border-gray-500 !text-gray-500">
                                    <a href="{{ route('tasks') }}" class="flex items-center">
                                        ← Back
                                    </a>
                                </x-button>
                                <x-button class="cursor-pointer !border-red-500 !text-red-500" wire:click="deleteTask"
                                    wire:confirm='Are you sure you want to delete this task? This action cannot be undone.'>
                                    X
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Task Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-400">Title:</span>
                                <span class="text-gray-900 dark:text-white ml-2">{{ $task->title }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-400">Slug:</span>
                                <span class="text-gray-900 dark:text-white ml-2">{{ $task->slug }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-400">Status:</span>
                                <span
                                    class="text-gray-900 dark:text-white ml-2">{{ Str::of($task->status->value)->headline() }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-400">Priority:</span>
                                <span
                                    class="text-gray-900 dark:text-white ml-2">{{ Str::of($task->priority->value)->headline() }}</span>
                            </div>
                            <div class="border-t-2 border-gray-500 dark:border-white pb-2 col-span-2 mt-4 pt-4">
                                <span class="font-medium text-gray-400">Description:</span>
                                <span class="text-gray-900 dark:text-white ml-2">{{ $task->description }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-400">Created At:</span>
                                <span
                                    class="text-gray-900 dark:text-white ml-2">{{ $task->created_at->format('M d, Y H:i:s') }}</span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-400">Updated At:</span>
                                <span
                                    class="text-gray-900 dark:text-white ml-2">{{ $task->updated_at->format('M d, Y H:i:s') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <livewire:tasks.tasks-form :task="$task" />
        </div>
    </div>
</div>
