<?php

namespace App\Livewire;

use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];

    public function mount()
    {
        $this->tasks = auth()->user()->tasks;
    }

    public function render()
    {
        return view('livewire.task-component');
    }
}
