<?php

use App\Console\Commands\EsvpImportCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(EsvpImportCommand::class)->weeklyOn(1, '8:00');
