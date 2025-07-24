@props(['task', 'taskId' => null])

<div class="flex gap-2">
    @foreach (App\Enums\StatusType::cases() as $case)
        @php
            $isCurrentStatus = $case->value === $task->status->value;
            $status = $case->value;
            $wireTarget = isset($taskId)
                ? "changeStatus('{$status}', {$taskId})"
                : "changeStatus('{$status}')";
        @endphp

        <button type="button"
                wire:click="{{ $wireTarget }}"
                wire:target="{{ $wireTarget }}"
                @class([
                    'px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-white/10 shadow-sm',
                    'disabled:opacity-25 transition ease-in-out duration-150',
                    'cursor-not-allowed' => $isCurrentStatus,
                    'cursor-pointer' => !$isCurrentStatus,
                    $case->borderColor(),
                    $case->textColor(),
                ])
                @if($isCurrentStatus) disabled @endif>

            <span wire:loading.remove wire:target="{{ $wireTarget }}">
                {{ Str::of($status)->headline() }}
            </span>
            <span wire:loading wire:target="{{ $wireTarget }}" class="flex items-center">
                <x-loading-spinner />
            </span>
        </button>
    @endforeach
</div>
