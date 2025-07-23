<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;
use \App\Enums\StatusType;
use \App\Enums\PriorityType;
use App\Models\Task;
use Livewire\Attributes\On;

class TasksForm extends Component
{

    public TaskForm $form;

    public function mount()
    {
        $this->form->status = StatusType::PENDING->value;
        $this->form->priority = PriorityType::LOW->value;
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('task-created');
    }

    #[On('edit-task')]
    public function edit($taskId)
    {
        $task = Task::findOrFail($taskId);
        $this->form->setTask($task);
        $this->dispatch('task-updated');
    }

    public function update()
    {
        $this->form->update();
        $this->dispatch('task-updated');
    }

    public function resetForm()
    {
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.tasks.tasks-form', [
            'editMode' => $this->form->editMode
        ]);
    }
}
