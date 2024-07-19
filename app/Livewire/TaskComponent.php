<?php

namespace App\Livewire;

use App\Mail\SharedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class TaskComponent extends Component
{
    public $tasks = [];
    public $users = [];
    public $id;
    public $title;
    public $description;
    public $user_id;
    public $permission;
    public $modal = false;
    public $modalShared = false;

    public function mount()
    {
        $this->geTasks();
    }

    public function loadTasksAll(){
        $this->geTasks();
    }

    public function geTasks()
    {
        $user = auth()->user();
        $myTasks = auth()->user()->tasks;
        $tasksShared = $user->sharedTask;
        $this->tasks = $myTasks->merge($tasksShared)->sortByDesc('id');
        $this->users = User::where('id', '!=', $user->id)->get();
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

    public function toggleModalShared(Task $task)
    {
        $this->id = $task->id;        
        $this->modalShared = !$this->modalShared;
    }

    public function addOrUpdateTask()
    {
        if ($this->id) {
            $task = Task::find($this->id);
            $task->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
        } else {
            $task = Task::create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => 'new',
                'user_id' => auth()->user()->id
            ]);
        }

        $this->geTasks();
        $this->toggleModal();
    }

    public function sharedTask()
    {     
           
        $task = Task::find($this->id);
        $user = User::find($this->user_id);
        $user->sharedTask()->attach($task->id, ['permission' => $this->permission]);        
        $this->geTasks();
        $this->modalShared = false;
        ///Enviar correos de notificación
        Mail::to($user)->send(new SharedTask($task, auth()->user()));
        /// Colas de trabajo
        // Mail::to($user)->queue(new SharedTask($task, auth()->user()));
    }

    public function unSharedTask(Task $task)
    {
        $user = User::find(auth()->user()->id);
        $user->sharedTask()->detach($task->id);
        $this->geTasks();
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
