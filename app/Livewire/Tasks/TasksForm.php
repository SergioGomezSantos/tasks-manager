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

    public ?Task $task = null;
    public string $formTitle = 'Create New Task';

    public $flashMessage = '';
    public $flashType = '';
    public $showFlash = false;

    public function mount(?Task $task = null, ?string $formTitle = null)
    {
        if ($task && $task->exists) {
            $this->task = $task;
            $this->form->setTask($task);
            $this->formTitle = $formTitle ?? 'Edit Task';
            
        } else {
            $this->form->status = StatusType::PENDING->value;
            $this->form->priority = PriorityType::LOW->value;
            $this->formTitle = $formTitle ?? 'Create New Task';
        }
    }

    public function save()
    {
        $this->form->store();

        $this->showFlashMessage([
            'type' => 'success',
            'message' => 'Task Created'
        ]);
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

        $this->showFlashMessage([
            'type' => 'success',
            'message' => 'Task Updated'
        ]);
        $this->dispatch('task-updated');
    }

    public function resetForm()
    {
        $this->hideFlash();
        $this->form->reset();
        $this->task = null;
        $this->formTitle = 'Create New Task';
        
        $this->form->status = StatusType::PENDING->value;
        $this->form->priority = PriorityType::LOW->value;
    }

    #[On('show-flash-message')]
    public function showFlashMessage($data)
    {
        $this->hideFlash();
        $this->js('setTimeout(() => {
            $wire.set("flashMessage", "' . $data['message'] . '");
            $wire.set("flashType", "' . $data['type'] . '");
            $wire.set("showFlash", true);
        }, 50)');
    }

    #[On('hide-flash')]
    public function hideFlash()
    {
        $this->showFlash = false;
        $this->flashMessage = '';
        $this->flashType = '';
    }

    public function render()
    {
        return view('livewire.tasks.tasks-form', [
            'editMode' => $this->form->editMode
        ]);
    }
}
