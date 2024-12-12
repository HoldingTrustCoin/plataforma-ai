<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\Auth\AccountController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\OtpController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BotController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\P2pController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawalController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->prefix('admin')->group(function () {
    Route::middleware(['admin.noauth'])->group(function () {

        //login route
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'loginValidate'])->name('login-validate');
        Route::post('login-verify', [LoginController::class, 'loginVerify'])->name('login-verify');

        // password
        Route::prefix('forgot-password')->name('forgot-password.')->group(function () {
            Route::get('/', [ForgotPasswordController::class, 'index'])->name('index');
            Route::post('/', [ForgotPasswordController::class, 'forgotPassword'])->name('send');
            Route::post('/validate', [ForgotPasswordController::class, 'forgotPasswordValidate'])->name('validate');
        });
    });

    //dashboard 
    Route::middleware(['admin.auth'])->group(function () {
        Route::post('logout', [LoginController::class, 'logOut'])->name('logout');
        Route::post('resend-otp', [OtpController::class, 'resend'])->name('resend-otp');
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        //user profile 
        Route::name('profile.')->prefix('profile')->group(function () {
            Route::get('/', [AccountController::class, 'profile'])->name('index');
            Route::get('edit', [AccountController::class, 'editProfile'])->name('edit');
            Route::post('edit', [AccountController::class, 'editProfileValidate'])->name('edit-validate')->middleware('demo.mode');
            Route::post('password', [AccountController::class, 'updatePassword'])->name('password')->middleware('demo.mode');
            Route::post('photo', [AccountController::class, 'updatePhoto'])->name('photo')->middleware('demo.mode');
        });

        // User management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{id}', [UserController::class, 'viewUser'])->name('view');
            Route::post('/{id}/status', [UserController::class, 'status'])->name('status')->middleware('demo.mode');
            Route::post('/{id}/edit', [UserController::class, 'edit'])->name('edit')->middleware('demo.mode');
            Route::post('/{id}/credit-debit', [UserController::class, 'creditDebit'])->name('credit-debit');
            Route::post('/{id}/send-email', [UserController::class, 'sendEmail'])->name('sendEmail');
            Route::post('/{id}/change-password', [UserController::class, 'changePassword'])->name('change-password')->middleware('demo.mode');
            Route::post('/{id}/login-as-user', [UserController::class, 'loginAsUser'])->name('login-as-user');
            Route::post('/{id}/delete', [UserController::class, 'delete'])->name('delete')->middleware('demo.mode');
        });

        // Kyc records management
        Route::prefix('kyc')->name('kyc.')->group(function () {
            Route::get('/', [KycController::class, 'index'])->name('index');
            Route::get('{id}', [KycController::class, 'viewKyc'])->name('view');
            Route::post('{id}/process', [KycController::class, 'process'])->name('process');
        });

        // Manage deposit
        Route::prefix('deposits')->name('deposits.')->group(function () {
            Route::get('/', [DepositController::class, 'index'])->name('index');
            Route::get('{id}', [DepositController::class, 'viewDeposit'])->name('view');
            Route::post('{id}/process', [DepositController::class, 'process'])->name('process');
        });

        // Manage withdrawals
        Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('index');
            Route::get('{id}', [WithdrawalController::class, 'viewWithdrawal'])->name('view');
            Route::post('{id}/process', [WithdrawalController::class, 'process'])->name('process');
            Route::post('wallets/{id}/delete', [WithdrawalController::class, 'deleteWallet'])->name('delete-wallet');
        });

        // Manage bot
        Route::prefix('bots')->name('bots.')->group(function () {
            Route::get('/', [BotController::class, 'index'])->name('index');
            Route::post('create', [BotController::class, 'create'])->name('create')->middleware('demo.mode');
            Route::post('{id}/edit', [BotController::class, 'edit'])->name('edit')->middleware('demo.mode');
            Route::post('{id}/delete', [BotController::class, 'deleteBot'])->name('delete')->middleware('demo.mode');
            Route::post('activations/{id}/manage', [BotController::class, 'manageActivation'])->name('activations.manage')->middleware('demo.mode');
            Route::post('history/{id}/delete', [BotController::class, 'deleteHistory'])->name('history.delete')->middleware('demo.mode');
        });

        // settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::middleware('demo.mode')->group(function () {
                Route::post('system-overview', [SettingController::class, 'systemOverview'])->name('system-overview');
                Route::post('core', [SettingController::class, 'core'])->name('core');
                Route::post('email', [SettingController::class, 'email'])->name('email');
                Route::post('email-test', [SettingController::class, 'emailTest'])->name('email-test');
                Route::post('deposit', [SettingController::class, 'deposit'])->name('deposit');
                Route::post('withdrawal', [SettingController::class, 'withdrawal'])->name('withdrawal');
                Route::post('bot', [SettingController::class, 'bot'])->name('bot');
                Route::post('security', [SettingController::class, 'security'])->name('security');
                Route::post('contact', [SettingController::class, 'contact'])->name('contact');
                Route::post('transfer', [SettingController::class, 'transfer'])->name('transfer');
                Route::post('referral', [SettingController::class, 'referral'])->name('referral');
                Route::post('misc', [SettingController::class, 'misc'])->name('misc');
                Route::post('seo', [SettingController::class, 'seo'])->name('seo');
                Route::post('telegram', [SettingController::class, 'telegram'])->name('telegram');
            });
        });

        // pages
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::post('/', [PageController::class, 'create'])->name('create')->middleware('demo.mode');
            Route::get('/{id}/edit', [PageController::class, 'edit'])->name('edit');
            Route::post('/{id}/edit', [PageController::class, 'editValidate'])->name('edit-validate')->middleware('demo.mode');
            Route::post('/{id}/delete', [PageController::class, 'delete'])->name('delete')->middleware('demo.mode');
        });

        //transactions
        Route::prefix('transactions')->name('transactions.')->group(function(){
            Route::get('/', [TransactionController::class, 'index'])->name('index');
            Route::post('/{id}/delete', [TransactionController::class, 'delete'])->name('delete')->middleware('demo.mode');
           

        });


        //p2p
        Route::prefix('transfers')->name('transfers.')->group(function(){
            Route::get('/', [P2pController::class, 'index'])->name('index');
            Route::post('/{id}/delete', [P2pController::class, 'delete'])->name('delete')->middleware('demo.mode');
           

        });

        //p2p
        Route::prefix('backups')->name('backups.')->group(function(){
            Route::get('/', [BackupController::class, 'index'])->name('index');
            Route::get('/{file}', [BackupController::class, 'downloadBackup'])->name('download')->middleware('demo.mode');
           

        });
    });
});
