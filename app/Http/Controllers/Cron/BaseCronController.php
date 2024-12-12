<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\CronJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BaseCronController extends Controller
{
    public function botCronOne()
    {

        $days = json_decode(site('trading_days'));
        $today = strtolower(date("l"));
        //end running bots
        endBot();
        if (in_array($today, $days)) {
            //update trade timestamp
            updateTimestamp();

            //run bot
            runBot();
        }

        // update the last run time
        $job = CronJob::where('name', 'bot-cron-one')->first();
        $update = CronJob::find($job->id);
        $update->last_run = time();
        $update->save();

        // check if the backup and withdrawal cronjobs are triggered
        $is_triggered = CronJob::where('name', 'schedule-run')->first();
        if ($is_triggered) {
            if ($is_triggered->last_run < now()->addHours(-1)->timestamp) {
                Artisan::call('schedule:run');
            }
        }

        return true;
    }


    // delete logs
    public function deleteLogs()
    {
        $logPath = storage_path('logs');
        $logFiles = File::files($logPath);

        foreach ($logFiles as $logFile) {
            if (File::size($logFile) > 10 * 1024 * 1024) { // 10MB
                File::delete($logFile);
            }
        }


        // update the last run time
        $job = CronJob::where('name', 'delete-logs')->first();
        $update = CronJob::find($job->id);
        $update->last_run = time();
        $update->save();
        return true;
    }

    // start payment
    
}
