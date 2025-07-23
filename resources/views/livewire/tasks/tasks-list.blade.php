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
                <h3 class="text-lg font-bold">{{ $task->title }}</h3>
                {{-- <p class="text-sm mb-2 text-right">{{ $task->slug }}</p> --}}
                <p class="mt-2 mb-4 font-normal text-gray-700 dark:text-gray-400">{{ $task->description }}</p>
                <div class="flex justify-end text-sm">

                    <div class="flex gap-2">
                        @foreach (App\Enums\StatusType::cases() as $case)
                            <button type="button" wire:click="changeStatus({{ $task->id }}, '{{ $case->value }}')"
                                @class([
                                    'px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-white/10 shadow-sm',
                                    'disabled:opacity-25 transition ease-in-out duration-150',
                                    'cursor-not-allowed' => $case->value == $task->status->value,
                                    $case->borderColor(),
                                    $case->textColor(),
                                ])
                                {{ $case->value == $task->status->value ? 'disabled' : '' }}>
                                {{ Str::of($case->value)->headline() }}
                            </button>
                        @endforeach
                    </div>

                    <span
                        class="ml-auto px-2 py-1 border-2 border-zinc-200 dark:border-white/10 bg-white dark:bg-white/10 rounded-lg">
                        {{ $task->deadline->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach

    <div>
        {{ $tasks->links() }}
    </div>
</div>
