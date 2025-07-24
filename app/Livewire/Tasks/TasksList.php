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

    public $selectedStatus = null;

    public function placeholder()
    {
        return view('skeleton');
    }

    public function changeStatus($taskId, $status)
    {
        $task = Task::find($taskId);
        $task->status = StatusType::from($status);
        $task->save();

        $this->dispatch('show-flash-message', [
            'type' => 'success',
            'message' => 'Task Satus Updated'
        ]);
        $this->dispatch('task-updated');
    }

    public function delete($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->delete();

            $this->dispatch('show-flash-message', [
                'type' => 'success',
                'message' => 'Task Deleted'
            ]);
            $this->dispatch('task-deleted');
        }
    }

    #[On('filter-by-status')]
    public function filterByStatus($status)
    {
        $this->selectedStatus = $status;
        $this->resetPage();
    }

    #[On('clear-status-filter')]
    public function clearStatusFilter()
    {
        $this->selectedStatus = null;
        $this->resetPage();
    }

    #[On(['task-created', 'task-updated', 'task-deleted'])]
    public function render()
    {
        $tasksQuery = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        if ($this->selectedStatus) {
            $tasksQuery->where('status', $this->selectedStatus);
        }

        $statusCounts = Task::where('user_id', Auth::id())
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
            'tasks' => $tasksQuery->paginate(4),
            'tasksByStatus' => $tasksByStatus,
            'selectedStatus' => $this->selectedStatus
        ]);
    }
}
