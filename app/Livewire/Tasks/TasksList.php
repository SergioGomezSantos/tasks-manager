<?php

namespace App\Livewire\Tasks;

use App\Enums\StatusType;
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

    public function changeStatus($taskId, $status)
    {
        $task = Task::find($taskId);
        $task->status = StatusType::from($status);
        $task->save();

        $this->dispatch('task-updated');
    }    

    #[On('task-created')]
    public function render()
    {
        $tasks = Task::where('user_id', Auth::id());

        $statusCounts  = Task::where('user_id', Auth::id())
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->orderBy('status', 'desc')
            ->pluck('count', 'status')
            ->toArray();

        $tasksByStatus = [];
        foreach (StatusType::cases() as $status) {
            $statusValue = $status->value;
            $tasksByStatus[$statusValue] = $statusCounts[$statusValue] ?? 0;
        }
        return view('livewire.tasks.tasks-list', [
            'tasks' => $tasks->paginate(4),
            'tasksByStatus' => $tasksByStatus
        ]);
    }
}
