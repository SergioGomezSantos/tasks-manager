<?php

namespace App\Livewire\Tasks;

use App\Enums\StatusType;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskShow extends Component
{
    public Task $task;
    public $flashMessage = '';
    public $flashType = '';
    public $showFlash = false;

    public function mount($slug)
    {
        $this->task = Task::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();
    }

    public function changeStatus($status)
    {
        $this->task->status = StatusType::from($status);
        $this->task->save();

        $this->dispatch('show-flash-message', [
            'type' => 'success',
            'message' => 'Task Status Updated'
        ]);
    }

    public function delete()
    {
        $this->task->delete();
        
        $this->dispatch('show-flash-message', [
            'type' => 'success',
            'message' => 'Task Deleted'
        ]);
        return redirect()->route('tasks');
    }

    public function render()
    {
        return view('livewire.tasks.task-show');
    }
}