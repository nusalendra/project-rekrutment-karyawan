<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;

// Guest Controller
use App\Http\Controllers\Guest\BerandaController;
use App\Http\Controllers\Guest\LoginController;
use App\Http\Controllers\Guest\RegisterController;
use App\Http\Controllers\Guest\LamaranPekerjaanController;

// HRD Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HRD\PeriodeController;
use App\Http\Controllers\HRD\LowonganPekerjaanController;
use App\Http\Controllers\HRD\AntrianPelamarController;
use App\Http\Controllers\HRD\PelamarDisetujuiController;
use App\Http\Controllers\HRD\PelamarDitolakController;
use App\Http\Controllers\HRD\HasilValidasiController;

// Manajer Controller
use App\Http\Controllers\Manajer\JabatanController;
use App\Http\Controllers\Manajer\KriteriaController;
use App\Http\Controllers\Manajer\SubkriteriaController;

// Pelamar Controller
use App\Http\Controllers\Pelamar\MelamarPekerjaanController;
use App\Http\Controllers\Pelamar\ProfilPelamarController;
use App\Http\Controllers\Pelamar\LamaranSayaController;
use App\Http\Controllers\Pelamar\NotifikasiController;


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

Route::get('/', [BerandaController::class, 'beranda']);

Route::get('/lamaran-pekerjaan', [LamaranPekerjaanController::class, 'index']);
Route::get('/get-detail-jabatan/{id}', [LamaranPekerjaanController::class, 'getDetail'])->name('detail-jabatan');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::POST('/login', [LoginController::class, 'store']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::middleware(['auth:sanctum', 'verified', 'role:HRD'])->group(function () {
    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard-hrd', [DashboardController::class, 'indexHRD'])->name('dashboardHRD');

    Route::prefix('periode')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('periode');
        Route::get('/create', [PeriodeController::class, 'create'])->name('periodeCreate');
        Route::post('/create', [PeriodeController::class, 'store'])->name('periodeStore');
        Route::get('/edit/{id}', [PeriodeController::class, 'edit'])->name('periodeEdit');
        Route::put('/edit/{id}', [PeriodeController::class, 'update'])->name('periodeUpdate');
        Route::get('/delete/{id}', [PeriodeController::class, 'destroy'])->name('periodeDestroy');
    })->name('periode');

    Route::prefix('lowongan-pekerjaan')->group(function () {
        Route::get('/', [LowonganPekerjaanController::class, 'index'])->name('lowonganPekerjaan');
        Route::get('/create', [LowonganPekerjaanController::class, 'create'])->name('lowonganPekerjaanCreate');
        Route::post('/create', [LowonganPekerjaanController::class, 'store'])->name('lowonganPekerjaanStore');
        Route::get('/edit/{id}', [LowonganPekerjaanController::class, 'edit'])->name('lowonganPekerjaanEdit');
        Route::put('/edit/{id}', [LowonganPekerjaanController::class, 'update'])->name('lowonganPekerjaanUpdate');
        Route::get('/delete/{id}', [LowonganPekerjaanController::class, 'destroy'])->name('lowonganPekerjaanDestroy');
    })->name('lowongan-pekerjaan');

    Route::prefix('antrian-pelamar')->group(function () {
        Route::get('/', [AntrianPelamarController::class, 'index'])->name('antrianPelamar');
        Route::get('/detail/{id}', [AntrianPelamarController::class, 'edit'])->name('antrianPelamarDetail');
        Route::POST('/detail', [AntrianPelamarController::class, 'update'])->name('antrianPelamarUpdate');
    })->name('antrian-pelamar');

    Route::prefix('pelamar-disetujui')->group(function () {
        Route::get('/', [PelamarDisetujuiController::class, 'index'])->name('pelamarDisetujui');
        Route::get('/detail/{id}', [PelamarDisetujuiController::class, 'edit'])->name('pelamarDisetujuiDetail');
    })->name('pelamar-disetujui');

    Route::prefix('pelamar-ditolak')->group(function () {
        Route::get('/', [PelamarDitolakController::class, 'index'])->name('pelamarDitolak');
        Route::get('/detail/{id}', [PelamarDitolakController::class, 'edit'])->name('pelamarDitolakDetail');
    })->name('pelamar-ditolak');

    Route::prefix('hasil-validasi')->group(function () {
        Route::get('/', [HasilValidasiController::class, 'index'])->name('hasil-validasi');
    })->name('hasil-validasi');

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
        Route::get('/show/{id}', [JabatanController::class, 'show'])->name('jabatanShow');
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
    Route::get('/profil', [ProfilPelamarController::class, 'index'])->name('profil');
    Route::get('/profil/data-pribadi/{id}', [ProfilPelamarController::class, 'editDataPribadi'])->name('edit-data-pribadi');
    Route::POST('/profil/data-pribadi/{id}', [ProfilPelamarController::class, 'updateDataPribadi'])->name('update-data-pribadi');
    Route::get('/profil/kontak-pribadi/{id}', [ProfilPelamarController::class, 'editKontakPribadi'])->name('edit-kontak-pribadi');
    Route::POST('/profil/kontak-pribadi/{id}', [ProfilPelamarController::class, 'updateKontakPribadi'])->name('update-kontak-pribadi');
    Route::get('/profil/lengkapi-dokumen/{id}', [ProfilPelamarController::class, 'editLengkapiDokumen'])->name('edit-lengkapi-dokumen');
    Route::POST('/profil/lengkapi-dokumen/{id}', [ProfilPelamarController::class, 'updateLengkapiDokumen'])->name('update-lengkapi-dokumen');
    
    Route::get('/beranda', [BerandaController::class, 'berandaPelamar']);

    Route::get('/melamar-pekerjaan', [MelamarPekerjaanController::class, 'index'])->name('melamar-pekerjaan');
    Route::get('/get-detail-jabatanId/{id}', [MelamarPekerjaanController::class, 'getDetail'])->name('detail-jabatan');
    Route::get('/lamar/{id}', [MelamarPekerjaanController::class, 'create'])->name('lamarCreate');
    Route::POST('/lamar/{id}', [MelamarPekerjaanController::class, 'store'])->name('lamarStore');

    Route::get('/lamaran-saya', [LamaranSayaController::class, 'index'])->name('lamaran-saya');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
});
