<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\LoginController;

// HRD Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HRD\PeriodeController;
use App\Http\Controllers\HRD\LowonganPekerjaanController;
use App\Http\Controllers\HRD\PelamarController;

// Manajer Controller
use App\Http\Controllers\Manajer\JabatanController;
use App\Http\Controllers\Manajer\KriteriaController;
use App\Http\Controllers\Manajer\SubkriteriaController;

// Pelamar Controller
use App\Http\Controllers\Pelamar\BerandaController;

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

Route::get('/', [LoginController::class, 'index']);
Route::POST('/', [LoginController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified', 'role:HRD'])->group(function () {
    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard-hrd', [DashboardController::class, 'indexHRD'])->name('dashboardHRD');

    Route::prefix('periode')->group(function () {
        Route::get('/index', [PeriodeController::class, 'index'])->name('periodeIndex');
        Route::get('/create', [PeriodeController::class, 'create'])->name('periodeCreate');
        Route::post('/create', [PeriodeController::class, 'store'])->name('periodeStore');
        Route::get('/edit/{id}', [PeriodeController::class, 'edit'])->name('periodeEdit');
        Route::put('/edit/{id}', [PeriodeController::class, 'update'])->name('periodeUpdate');
        Route::get('/delete/{id}', [PeriodeController::class, 'destroy'])->name('periodeDestroy');
    })->name('periode');

    Route::prefix('lowongan-pekerjaan')->group(function () {
        Route::get('/index', [LowonganPekerjaanController::class, 'index'])->name('lowonganPekerjaanIndex');
        Route::get('/create', [LowonganPekerjaanController::class, 'create'])->name('lowonganPekerjaanCreate');
        Route::post('/create', [LowonganPekerjaanController::class, 'store'])->name('lowonganPekerjaanStore');
        Route::get('/edit/{id}', [LowonganPekerjaanController::class, 'edit'])->name('lowonganPekerjaanEdit');
        Route::put('/edit/{id}', [LowonganPekerjaanController::class, 'update'])->name('lowonganPekerjaanUpdate');
        Route::get('/delete/{id}', [LowonganPekerjaanController::class, 'destroy'])->name('lowonganPekerjaanDestroy');
    })->name('lowongan-pekerjaan');

    Route::prefix('daftar-pelamar')->group(function () {
        Route::get('/index', [PelamarController::class, 'index'])->name('daftarPelamarIndex');
        Route::get('/create', [PelamarController::class, 'create'])->name('daftarPelamarCreate');
        Route::post('/create', [PelamarController::class, 'store'])->name('daftarPelamarStore');
        Route::get('/edit/{id}', [PelamarController::class, 'edit'])->name('daftarPelamarEdit');
        Route::put('/edit/{id}', [PelamarController::class, 'update'])->name('daftarPelamarUpdate');
        Route::get('/delete/{id}', [PelamarController::class, 'destroy'])->name('daftarPelamarDestroy');
    })->name('daftar-pelamar');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});

Route::middleware(['auth:sanctum', 'verified', 'role:Manajer'])->group(function () {
    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard-manajer', [DashboardController::class, 'indexManajer'])->name('dashboardManajer');

    Route::prefix('jabatan')->group(function () {
        Route::get('/index', [JabatanController::class, 'index'])->name('jabatanIndex');
        Route::get('/create', [JabatanController::class, 'create'])->name('jabatanCreate');
        Route::post('/create', [JabatanController::class, 'store'])->name('jabatanStore');
        Route::get('/edit/{id}', [JabatanController::class, 'edit'])->name('jabatanEdit');
        Route::put('/edit/{id}', [JabatanController::class, 'update'])->name('jabatanUpdate');
        Route::get('/delete/{id}', [JabatanController::class, 'destroy'])->name('jabatanDestroy');
    })->name('jabatan');

    Route::prefix('kriteria')->group(function () {
        Route::get('/index', [KriteriaController::class, 'index'])->name('kriteriaIndex');
        Route::get('/create', [KriteriaController::class, 'create'])->name('kriteriaCreate');
        Route::post('/create', [KriteriaController::class, 'store'])->name('kriteriaStore');
        Route::get('/edit/{id}', [KriteriaController::class, 'edit'])->name('kriteriaEdit');
        Route::put('/edit/{id}', [KriteriaController::class, 'update'])->name('kriteriaUpdate');
        Route::get('/delete/{id}', [KriteriaController::class, 'destroy'])->name('kriteriaDestroy');
    })->name('kriteria');

    Route::prefix('subkriteria')->group(function () {
        Route::get('/index', [SubkriteriaController::class, 'index'])->name('subkriteriaIndex');
        Route::get('/create', [SubkriteriaController::class, 'create'])->name('subkriteriaCreate');
        Route::post('/create', [SubkriteriaController::class, 'store'])->name('subkriteriaStore');
        Route::get('/get-kriteria/{jabatanId}', [SubkriteriaController::class, 'getKriteriaByJabatan'])->name('getKriteriaByJabatan');
        Route::get('/edit/{id}', [SubkriteriaController::class, 'edit'])->name('subkriteriaEdit');
        Route::put('/edit/{id}', [SubkriteriaController::class, 'update'])->name('subkriteriaUpdate');
        Route::get('/delete/{id}', [SubkriteriaController::class, 'destroy'])->name('subkriteriaDestroy');
    })->name('subkriteria');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});


Route::middleware(['auth:sanctum', 'verified', 'role:Pelamar'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    
});
