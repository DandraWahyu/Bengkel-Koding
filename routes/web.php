<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('polis', PoliController::class);
        Route::resource('dokter', DokterController::class);
        Route::resource('pasien', PasienController::class);
        Route::resource('obat', ObatController::class);

        // ✅ ROUTE UPDATE STOK OBAT (INI YANG DIPANGGIL)
        Route::post(
            'obat/{id}/stok',
            [ObatController::class, 'updateStok']
        )->name('obat.stok');
    });

/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->as('dokter.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        })->name('dashboard');

        Route::resource('jadwal-periksa', JadwalPeriksaController::class);

        Route::get(
            'periksa-pasien',
            [PeriksaPasienController::class, 'index']
        )->name('periksa-pasien.index');

        Route::get(
            'periksa-pasien/{id}/periksa',
            [PeriksaPasienController::class, 'periksa']
        )->name('periksa-pasien.periksa');

        Route::post(
            'periksa-pasien',
            [PeriksaPasienController::class, 'store']
        )->name('periksa-pasien.store');

        Route::get(
            'riwayat-pasien',
            [RiwayatPasienController::class, 'index']
        )->name('riwayat-pasien.index');

        Route::get(
            'riwayat-pasien/{id}',
            [RiwayatPasienController::class, 'show']
        )->name('riwayat-pasien.show');
    });

/*
|--------------------------------------------------------------------------
| PASIEN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->as('pasien.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        })->name('dashboard');

        Route::get('/daftar-poli', [PasienController::class, 'daftar'])
            ->name('daftar');

        Route::post('/daftar-poli', [PasienController::class, 'storeDaftar'])
            ->name('store');
    });
