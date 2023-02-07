<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/kendaraan', [KendaraanController::class, 'index']);
    Route::get('/kendaraan/input', [KendaraanController::class, 'create']);
    Route::get('/pemesanan', [PemesananController::class, 'index']);
    Route::get('/pemesanan/input', [PemesananController::class, 'create']);
    Route::get('/pemesanan/laporan', [PemesananController::class, 'laporan']);
    Route::get('/pemesanan/excel', [PemesananController::class, 'excel']);
    Route::get('/driver', [DriverController::class, 'index']);
    Route::get('/driver/input', [DriverController::class, 'create']);
    Route::post('/kendaraan/store', [KendaraanController::class, 'store']);
    Route::post('/driver/store', [DriverController::class, 'store']);
    Route::post('/kendaraan/delete', [KendaraanController::class, 'destroy']);
    Route::post('/driver/delete', [DriverController::class, 'destroy']);
    Route::post('/kendaraan/update', [KendaraanController::class, 'update']);
    Route::post('/driver/update', [DriverController::class, 'update']);
    Route::post('/pemesanan/store', [PemesananController::class, 'store']);
    Route::post('/pemesanan/update', [PemesananController::class, 'update']);
    Route::post('/pemesanan/delete', [PemesananController::class, 'destroy']);
    Route::post('/pemesanan/setuju/1', [PemesananController::class, 'setuju1']);
    Route::post('/pemesanan/setuju/2', [PemesananController::class, 'setuju2']);
});
