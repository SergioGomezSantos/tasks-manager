<?php

namespace App\Livewire\Tasks;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class TasksCount extends Component
{
    #[Reactive]
    public $tasksByStatus;
    
    #[Reactive]
    public $selectedStatus;

    public function filterByStatus($status)
    {
        if ($this->selectedStatus === $status) {
            $this->dispatch('clear-status-filter');
            
        } else {
            $this->dispatch('filter-by-status', status: $status);
        }
    }

    public function render()
    {
        return view('livewire.tasks.tasks-count');
    }
}
