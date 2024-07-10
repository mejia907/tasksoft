<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $task = new Task();
        $task->title = 'Task 1';
        $task->description = 'Task 1 description';
        $task->status = 'new';
        $task->user_id = 1;
        $task->save();

        $task2 = new Task();
        $task2->title = 'Task 2';
        $task2->description = 'Task 2 description';
        $task2->status = 'new';
        $task2->user_id = 1;
        $task2->save();

        $task3 = new Task();
        $task3->title = 'Task 3';
        $task3->description = 'Task 3 description';
        $task3->status = 'new';
        $task3->user_id = 2;
        $task3->save();
    }
}
