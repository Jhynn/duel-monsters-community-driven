<?php

use App\Jobs\FusionMaterialMonsters;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\{
    Artisan,
    Schedule
};

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(FusionMaterialMonsters::class);
