<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    public ?Task $task;
    public $editMode = false;

    #[Validate('required|string|min:5')]
    public $title;

    #[Validate('required|string|min:5')]
    public $slug;

    #[Validate('required|string|min:5')]
    public $description;

    #[Validate('required')]
    public $status;

    #[Validate('required')]
    public $priority;

    #[Validate('required|date')]
    public $deadline;

    public function setTask(Task $task)
    {
        $this->editMode = true;
        $this->task = $task;
        $this->title = $task->title;
        $this->slug = $task->slug;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->priority = $task->priority;
        $this->deadline = $task->deadline->format('Y-m-d');
    }

    public function store()
    {
        $this->validate();
        Task::create(
            [
                'user_id' => Auth::id(),
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'deadline' => $this->deadline,
            ]
        );

        $this->reset();
    }

    public function update()
    {
        $this->validate();

        $this->task->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'deadline' => $this->deadline,
        ]);

        $this->reset();
    }
}
