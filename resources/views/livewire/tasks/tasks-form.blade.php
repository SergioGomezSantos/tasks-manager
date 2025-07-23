<form wire:submit="save" class="p-6 border border-zinc-200 dark:border-white/10 bg-gray-200 dark:bg-white/10 rounded-xl">
    <h1 class="text-2xl mb-6 text-center font-bold border-b-2 border-gray-500 dark:border-white pb-2">
        Welcome,
        <span class="text-blue-300">{{ ucwords(auth()->user()->name) }}</span>
    </h1>

    <div class="mb-4 flex gap-4">
        <div class="flex-2">
            <x-label for="title" class="mb-1 text-xl">Title</x-label>
            <x-input type="text" id="title" wire:model="form.title" class="w-full mt-1 rounded" />
            <div class="mt-1">
                @error('form.title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex-1">
            <x-label for="slug" class="mb-1 text-xl">Slug</x-label>
            <x-input type="text" id="slug" wire:model="form.slug" class="w-full mt-1 rounded" />
            <div class="mt-1">
                @error('form.slug')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="mb-4">
        <x-label for="description" class="mb-1 text-xl">Description</x-label>
        <x-textarea id="description" wire:model="form.description" class="w-full mt-1 rounded"></x-textarea>
        <div class="mt-1">
            @error('form.description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="col-span-2 grid grid-cols-2 gap-4">
            <div>
                <x-label for="status" class="text-xl">Status</x-label>
                <x-select id="status" wire:model="form.status" class="w-full mt-1 rounded">
                    <option value="" selected disabled>Select a status...</option>
                    @foreach (\App\Enums\StatusType::cases() as $status)
                        <option value="{{ $status->value }}">
                            {{ Str::of($status->value)->headline() }}
                        </option>
                    @endforeach
                </x-select>
                @error('form.status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-label for="priority" class="text-xl">Priority</x-label>
                <x-select id="priority" wire:model="form.priority" class="w-full mt-1 rounded">
                    <option value="" selected disabled>Select a priority...</option>
                    @foreach (\App\Enums\PriorityType::cases() as $priority)
                        <option value="{{ $priority->value }}">
                            {{ Str::of($priority->value)->headline() }}
                        </option>
                    @endforeach
                </x-select>
                @error('form.priority')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-span-2">
            <x-label for="deadline" class="text-xl">Deadline</x-label>
            <x-input type="date" id="deadline" wire:model="form.deadline" class="w-full mt-1 rounded" />
            @error('form.deadline')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex justify-end gap-4">

        @if (session()->has('success'))
            <div class="flex-1 p-2 text-center rounded-lg bg-green-300 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <x-button type="submit" class="border-2">Add Task</x-button>
    </div>
</form>
