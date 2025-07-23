<?php

namespace App\Livewire\Tasks;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;

    public function placeholder()
    {
        return view('skeleton');
    }

    #[On('task-created')]
    public function render()
    {
        $tasks = Task::where('user_id', Auth::id());
        return view('livewire.tasks.tasks-list', [
            'tasks' => $tasks->paginate(4),
            'count' => $tasks->count()
        ]);
    }
}
