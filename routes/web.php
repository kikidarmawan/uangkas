<?php

use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'loginAction'])->name('login.action');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'registerAction'])->name('register.action');

Route::group([
    'middleware' => 'auth',
    'as' => 'dashboard.'
], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    // Dompet
    Route::get('/dompet', [App\Http\Controllers\DompetController::class, 'index'])->name('dompet.index');
    // transaksi
    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class)->except(['show', 'update', 'destroy']);

    // Report
    Route::group(['prefix' => 'report/transaksi'], function () {
        Route::get('/harian', [App\Http\Controllers\ReportController::class, 'dailyReport'])->name('report.transaksi.harian');
        Route::get('/bulanan', [App\Http\Controllers\ReportController::class, 'monthlyReport'])->name('report.transaksi.bulanan');
        Route::get('/tahunan', [App\Http\Controllers\ReportController::class, 'annualReport'])->name('report.transaksi.tahunan');
    });
});
