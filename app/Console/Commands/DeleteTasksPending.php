<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use function Laravel\Prompts\form;

class DeleteTasksPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deletetasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar tareas que estan en sofdeleted';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if($this->confirm('¿Deseas borrar definitivamente las tareas marcadas como eliminadas?')){
            Task::where('deleted_at', '!=', null)
            ->where('deleted_at', '<', now()->subDays(5))
            ->forceDelete();
            info('Las tareas han sido eliminadas');
        }
    }
}
