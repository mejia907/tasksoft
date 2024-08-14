<?php

use App\Console\Commands\DeleteTasksPending;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/// php artisan schedule:work
Schedule::command(DeleteTasksPending::class)->timezone('America/Bogota')->everyMinute();
