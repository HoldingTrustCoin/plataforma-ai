<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class QueueController extends Controller
{
    public function queueWork()
    {
        Artisan::call('schedule:run');
        // Artisan::call('queue:work');
        // Artisan::call('backup:database');
    }
}
