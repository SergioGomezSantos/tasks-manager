<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
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
        request()->session()->flash('success', 'Task created successfully.');
    }
}
