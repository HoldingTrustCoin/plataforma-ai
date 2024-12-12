<?php

use App\Models\CronJob;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cron_jobs', function (Blueprint $table) {
            $table->string('type')->default('link')->after('last_run');
        });

        // insert
        $job = new CronJob();
        $job->name = 'schedule-run';
        $job->last_run = time();
        $job->type = 'php';
        $job->save();
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cron_jobs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
