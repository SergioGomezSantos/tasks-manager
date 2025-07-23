<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

class TasksSearch extends Component
{
    #[Url(as: 'q', history: true)]
    public $search;

    public function render()
    {
        $results = [];

        if (strlen($this->search) >= 3) {
            $results = Task::where('user_id', Auth::id())
                ->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%');
                })->get();
        }

        return view('livewire.tasks.tasks-search', [
            'results' => $results,
        ]);
    }
}
