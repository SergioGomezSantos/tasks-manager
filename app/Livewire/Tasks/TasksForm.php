<?php

namespace App\Livewire\Tasks;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;
use \App\Enums\StatusType;
use \App\Enums\PriorityType;

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

    public function render()
    {
        return view('livewire.tasks.tasks-form');
    }
}
