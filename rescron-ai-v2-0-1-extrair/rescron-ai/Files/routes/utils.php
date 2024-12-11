<?php

use App\Http\Controllers\Cron\BaseCronController;
use App\Http\Controllers\Cron\QueueController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');

    $to = request()->to ?? url()->previous();
    $currentUrl = url()->current();

    if (!$to || $to == $currentUrl) {
        return 'Cache Cleared successfully';
    }

    return redirect($to);
})->name('cache-clear');


//cron jobs
Route::get('bot-cron-1', [BaseCronController::class, 'botCronOne'])->name('bot-cron-one');
Route::get('delete-logs', [BaseCronController::class, 'deleteLogs'])->name('delete-logs');
Route::get('queue-work', [QueueController::class, 'queueWork'])->name('queue-work');


//places 
Route::get('places', function () {
    $path = resource_path('json/places.json');
    $places = file_get_contents($path);
    return response($places)->header('Content-Type', 'application/json');
})->name('places');

Route::get('sort-out', function () {
    // delete link
    if (File::isDirectory(public_path('storage'))) {
        File::deleteDirectory(public_path('storage'));
    }

    // create symlink
    Artisan::call('storage:link');
    Artisan::call('migrate');

    return 'done';
});
