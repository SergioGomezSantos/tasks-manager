<div class="justify-center items-center flex h-full w-full">

    <div>
        <h1 class="mb-2 border-b-2">Tasks</h1>

        <input type="text" wire:model="task" class="m-2 p-2 border-2">
        <button wire:click="add" class="bg-indigo-500 p-2 m-2 border-2 rounded-md cursor-pointer">Add Task</button>

        <ul>
            @foreach ($tasks as $task)
                <li>{{ $task }}</li>
            @endforeach
        </ul>
    </div>

</div>
