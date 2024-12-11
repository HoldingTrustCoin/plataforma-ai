<?php

use App\Http\Controllers\InstallationController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\WithdrawalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('payment-callback', [DepositController::class, 'depositCallback'])->name('payment-callback');
Route::post('withdrawal-callback', [WithdrawalController::class, 'withdrawalCallback'])->name('withdrawal-callback');

// coinpayment
Route::post('payment-callback-coinpayment', [DepositController::class, 'depositCallbackCoinpayment'])->name('payment-callback-coinpayment');

// installation
Route::prefix('install')->group(function(){
    Route::post('set-database', [InstallationController::class, 'setDatabase']);
    Route::post('import-database', [InstallationController::class, 'importDatabase']);
});
