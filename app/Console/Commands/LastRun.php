<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CronJob;

class LastRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rescron:last-run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // update the last run time
        $job = CronJob::where('name', 'schedule-run')->first();
        // if (!$job) {
        //     return;
        // }
        $update = CronJob::find($job->id);
        $update->last_run = time();
        $update->save();

        $this->info('Ran successfully');
        return;
    }
}
