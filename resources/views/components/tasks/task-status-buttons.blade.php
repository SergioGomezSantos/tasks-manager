<div class="flex gap-2">
    @foreach (App\Enums\StatusType::cases() as $case)
        @php
            $isCurrentStatus = $case->value == $task->status->value;
        @endphp

        <button type="button" 
                wire:click="changeStatus({{ isset($taskId) ? $taskId : '' }}{{ isset($taskId) ? ', ' : '' }}'{{ $case->value }}')"
                wire:target="changeStatus{{ isset($taskId) ? "({$taskId}, '{$case->value}')" : "('{$case->value}')" }}" 
                @class([
                    'px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-white/10 shadow-sm',
                    'disabled:opacity-25 transition ease-in-out duration-150',
                    'cursor-not-allowed' => $isCurrentStatus,
                    'cursor-pointer' => !$isCurrentStatus,
                    $case->borderColor(),
                    $case->textColor(),
                ])
                @if($isCurrentStatus) disabled @endif>

            <span wire:loading.remove wire:target="changeStatus{{ isset($taskId) ? "({$taskId}, '{$case->value}')" : "('{$case->value}')" }}">
                {{ Str::of($case->value)->headline() }}
            </span>
            <span wire:loading wire:target="changeStatus{{ isset($taskId) ? "({$taskId}, '{$case->value}')" : "('{$case->value}')" }}" class="flex items-center">
                <x-loading-spinner />
            </span>
        </button>
    @endforeach
</div>