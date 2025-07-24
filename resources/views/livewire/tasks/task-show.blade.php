<div class="justify-center items-start flex h-full w-full p-4">
    <div class="w-full max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="p-6 pt-0 lg:col-span-2">
                <x-tasks.task-card 
                    :task="$task" 
                    :show-view-button="false"
                    :show-edit-button="false"
                    title-classes="text-xl font-bold"
                />
                
                <x-tasks.task-info-panel :task="$task" />
            </div>

            <livewire:tasks.tasks-form :task="$task" />
        </div>
    </div>
</div>