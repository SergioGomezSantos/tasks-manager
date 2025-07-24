<div class="flex justify-between items-center gap-2">
    @if($showView ?? false)
        <x-button>
            <a href="/{{ $task->slug }}">View</a>
        </x-button>
    @endif
    
    @if($showBack ?? false)
        <x-button class="cursor-pointer !border-gray-500 !text-gray-500">
            <a href="{{ route('tasks') }}" class="flex items-center">← Back</a>
        </x-button>
    @endif
    
    @if($showEdit ?? true)
        <x-button class="cursor-pointer !border-blue-500 !text-blue-500"
                  wire:click="$dispatch('edit-task', {taskId: {{ $task->id }}})">
            Edit
        </x-button>
    @endif
    
    <x-button class="cursor-pointer !border-red-500 !text-red-500"
              wire:click="delete('{{ $task->id }}')"
              wire:confirm="{{ $deleteConfirmMessage ?? 'Are you sure you want to delete this task?' }}">
        X
    </x-button>
</div>