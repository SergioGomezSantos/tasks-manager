<div
    class="p-4 mb-4 border border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl flex justify-around items-center">
    @foreach ($tasksByStatus as $statusValue => $count)
        @php
            $statusEnum = App\Enums\StatusType::from($statusValue);
            $isSelected = $selectedStatus === $statusEnum->value;
        @endphp

        <button 
            wire:click="filterByStatus('{{ $statusEnum->value }}')"
        @class([
                'flex items-center gap-2 py-2 px-4 border-2 rounded-xl cursor-pointer',
                $statusEnum->borderColor(),
                $isSelected ? $statusEnum->backgroundColorSelected() : $statusEnum->backgroundColor(),
                $isSelected ? $statusEnum->textColorSelected() : $statusEnum->textColor(),
            ])>
            <span class="text-sm text-black">
                {{ Str::of($statusValue)->headline() }}
            </span>
            <span class="text-base font-bold">{{ $count }}</span>
        </button>
    @endforeach
</div>
