<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/live-trades', [HomeController::class, 'trades'])->name('trades');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/tos', [HomeController::class, 'tos'])->name('tos');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactValidate'])->name('contact-validate');
Route::get('/p/{slug}', [HomeController::class, 'page'])->name('page');

