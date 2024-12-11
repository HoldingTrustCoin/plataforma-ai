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
        Schema::create('cron_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_run');
            $table->timestamps();
        });

        $names = ['bot-cron-one', 'delete-logs'];
        foreach ($names as $name) {
            $insert = new CronJob();
            $insert->name = $name;
            $insert->last_run = time();
            $insert->save();
        }

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cron_jobs');
    }
};
