<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// Schedule::command('cwd:cek-pengembalian-terlambat')->dailyAt('00:01');
Schedule::command('cwd:cek-pengembalian-terlambat')->dailyAt('00:01');
Schedule::command('auth:clear-resets')->everyFifteenMinutes();