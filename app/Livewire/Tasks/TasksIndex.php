<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tasks')] 
class TasksIndex extends Component
{
    public function render()
    {
        return view('livewire.tasks.tasks-index', []);
    }
}