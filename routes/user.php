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

use App\Http\Controllers\User\Auth\AccountController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\G2faController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\OtpController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\AutoWalletController;
use App\Http\Controllers\User\BotController;
use App\Http\Controllers\User\CoinpaymentController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\KycController;
use App\Http\Controllers\User\P2pController;
use App\Http\Controllers\User\ReferralController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\WithdrawalController;
use Illuminate\Support\Facades\Route;


Route::name('user.')->group(function () {
    Route::middleware(['user.noauth'])->group(function () {
        //register route
        Route::get('register', [RegisterController::class, 'register'])->name('register');
        Route::post('register', [RegisterController::class, 'registerValidate'])->name('register-validate')->middleware('demo.mode');
        Route::post('register-verify', [RegisterController::class, 'registerVerify'])->name('register-verify');

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
    Route::middleware(['user.auth'])->prefix('user')->group(function () {
        Route::post('logout', [LoginController::class, 'logOut'])->name('logout');
        Route::post('resend-otp', [OtpController::class, 'resend'])->name('resend-otp');
        // g2fa validation
        Route::prefix('g2fa')->name('g2fa.')->group(function(){
            Route::get('/', [G2faController::class, 'index'])->name('index');
            Route::post('/', [G2faController::class, 'g2fa'])->name('g2fa');
        });
        // require g2fa
        Route::middleware(['user.g2fa'])->group(function () {
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            //user profile 
            Route::name('profile.')->prefix('profile')->group(function () {
                Route::get('/', [AccountController::class, 'profile'])->name('index');
                Route::get('edit', [AccountController::class, 'editProfile'])->name('edit');
                Route::post('edit', [AccountController::class, 'editProfileValidate'])->name('edit-validate')->middleware('demo.mode');
                Route::post('password', [AccountController::class, 'updatePassword'])->name('password')->middleware('demo.mode');
                Route::post('g2fa', [AccountController::class, 'g2FaUpdate'])->name('g2fa')->middleware('demo.mode');
                Route::post('photo', [AccountController::class, 'updatePhoto'])->name('photo')->middleware('demo.mode');
            });
            //kyc routes
            Route::name('kyc.')->prefix('kyc')->group(function () {
                Route::get('/', [KycController::class, 'index'])->name('index');
                Route::post('/', [KycController::class, 'create'])->name('upload')->middleware('demo.mode');
            });
            //kyc verified only
            Route::middleware(['user.kyc'])->group(function () {
                //deposit route
                Route::prefix('deposits')->name('deposits.')->group(function () {
                    Route::get('/', [DepositController::class, 'index'])->name('index');
                    Route::post('/', [DepositController::class, 'newDeposit'])->name('new');
                    Route::get('/view/{ref}', [DepositController::class, 'deposit'])->name('view');
                });

                //withdrawal route
                Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
                    Route::get('/', [WithdrawalController::class, 'index'])->name('index');
                    Route::post('/new', [WithdrawalController::class, 'newWithdrawal'])->name('new');
                });

                //autowallet route
                Route::prefix('auto-wallets')->name('auto-wallets.')->group(function () {
                    Route::post('/', [AutoWalletController::class, 'create'])->name('new');
                });

                // ai bots
                Route::prefix('bots')->name('bots.')->group(function () {
                    Route::get('/', [BotController::class, 'index'])->name('index');
                    Route::post('/', [BotController::class, 'activateBot'])->name('new');
                    Route::get('/activations/{id}', [DepositController::class, 'deposit'])->name('view');
                });

                //transactions
                Route::prefix('transactions')->name('transactions.')->group(function () {
                    Route::get('/', [TransactionController::class, 'index'])->name('index');
                });

                //p2p
                Route::prefix('transfers')->name('transfers.')->group(function () {
                    Route::get('/', [P2pController::class, 'index'])->name('index');

                    Route::post('/', [P2pController::class, 'newTransfer'])->name('new');
                    Route::post('user', [P2pController::class, 'getUser'])->name('user');
                });

                // referral
                Route::get('referrals', [ReferralController::class, 'index'])->name('referrals');
            });
        });
    });
});
