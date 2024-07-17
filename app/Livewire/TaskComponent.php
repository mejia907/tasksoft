<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $id;
    public $title;
    public $description;
    public $modal = false;

    public function mount()
    {
        $this->geTasks();
    }

    public function geTasks()
    {
        $this->tasks = auth()->user()->tasks;
    }

    public function render()
    {
        return view('livewire.task-component');
    }

    public function clearInputs()
    {
        $this->title = '';
        $this->description = '';
    }

    public function toggleModal()
    {
        $this->clearInputs();
        $this->modal = !$this->modal;
    }

    public function addOrUpdateTask()
    {
        Task::updateOrCreate([
            'id' => $this->id
        ], [
            'title' => $this->title,
            'description' => $this->description,
            'status' => 'new',
            'user_id' =>  auth()->user()->id
        ]);

        $this->geTasks();
        $this->toggleModal();
    }

    public function updateTask(Task $task)
    {
        $this->id = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;

        $this->modal = true;
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->geTasks();
    }
}
