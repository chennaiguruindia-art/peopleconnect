<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Scheduled Background Tasks
|--------------------------------------------------------------------------
| Automatically fetches live Virudhunagar district news twice daily
*/
Schedule::command('news:fetch-virudhunagar')->twiceDaily(8, 18);

