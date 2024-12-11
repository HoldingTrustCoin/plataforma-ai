<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Updater\Http\Controllers\UpdaterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/updater', function () {
    
// });


Route::post('/check-update', [UpdaterController::class, 'checkUpdate'])->name('check-update');
Route::post('/download-update', [UpdaterController::class, 'downloadUpdate'])->name('download-update');
Route::post('/extract-update', [UpdaterController::class, 'extractUpdate'])->name('extract-update');
Route::post('/post-update', [UpdaterController::class, 'postUpdate'])->name('post-update');
