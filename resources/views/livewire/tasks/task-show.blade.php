<div class="justify-center items-start flex h-full w-full p-4">
    <div class="w-full max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="p-6 pt-0 lg:col-span-2">
                <x-tasks.task-card 
                    :task="$task" 
                    :truncate-description="false"
                    :show-view-button="false"
                    :show-back-button="true"
                    :heading-level="1"
                    title-classes="text-2xl font-bold"
                    :delete-method="'deleteTask'"
                    delete-confirm-message="Are you sure you want to delete this task? This action cannot be undone."
                />
                
                <x-tasks.task-info-panel :task="$task" />
            </div>

            <livewire:tasks.tasks-form :task="$task" />
        </div>
    </div>
</div>