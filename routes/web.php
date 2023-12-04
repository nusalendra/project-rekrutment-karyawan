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
use App\Http\Controllers\HRD\ProsesSeleksiController;
use App\Http\Controllers\HRD\PelamarDiterimaController;
use App\Http\Controllers\HRD\PelamarDitolakController;
use App\Http\Controllers\HRD\HasilValidasiController;
use App\Http\Controllers\HRD\PelamarDisetujuiController;
use App\Http\Controllers\HRD\PelamarTesController;
use App\Http\Controllers\HRD\PelamarWawancara;
use App\Http\Controllers\HRD\PelamarWawancaraController;
use App\Http\Controllers\HRD\TesPotensiAkademikController;

// Manajer Controller
use App\Http\Controllers\Manajer\JabatanController;
use App\Http\Controllers\Manajer\KandidatPosisiController;
use App\Http\Controllers\Manajer\KriteriaController;
use App\Http\Controllers\Manajer\SubkriteriaController;
use App\Http\Controllers\Manajer\PengukuranController;
use App\Http\Controllers\Pelamar\HasilTesTPAController;
// Pelamar Controller
use App\Http\Controllers\Pelamar\MelamarPekerjaanController;
use App\Http\Controllers\Pelamar\ProfilPelamarController;
use App\Http\Controllers\Pelamar\LamaranSayaController;
use App\Http\Controllers\Pelamar\NotifikasiController;
use App\Http\Controllers\Pelamar\TesController;


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
Route::get('/lamaran-pekerjaan/{id}', [LamaranPekerjaanController::class, 'getDetail'])->name('lamaran-pekerjaan-id');
Route::get('/get-detail-jabatan/{id}', [LamaranPekerjaanController::class, 'getDetail'])->name('detail-jabatan-guest');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::POST('/login', [LoginController::class, 'store']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

Route::middleware(['auth:sanctum', 'verified', 'role:HRD'])->group(function () {
    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard-hrd', [DashboardController::class, 'indexHRD'])->name('dashboard-hrd');

    Route::prefix('periode')->group(function () {
        Route::get('/', [PeriodeController::class, 'index'])->name('periode');
        Route::get('/create', [PeriodeController::class, 'create'])->name('periode-create');
        Route::post('/create', [PeriodeController::class, 'store'])->name('periode-store');
        Route::get('/edit/{id}', [PeriodeController::class, 'edit'])->name('periode-edit');
        Route::put('/edit/{id}', [PeriodeController::class, 'update'])->name('periode-update');
        Route::get('/delete/{id}', [PeriodeController::class, 'destroy'])->name('periode-destroy');
    })->name('periode');

    Route::prefix('lowongan-pekerjaan')->group(function () {
        Route::get('/', [LowonganPekerjaanController::class, 'index'])->name('lowongan-pekerjaan');
        Route::get('/create', [LowonganPekerjaanController::class, 'create'])->name('lowongan-pekerjaan-create');
        Route::post('/create', [LowonganPekerjaanController::class, 'store'])->name('lowongan-pekerjaan-store');
        Route::get('/edit/{id}', [LowonganPekerjaanController::class, 'edit'])->name('lowongan-pekerjaan-edit');
        Route::put('/edit/{id}', [LowonganPekerjaanController::class, 'update'])->name('lowongan-pekerjaan-update');
        Route::get('/delete/{id}', [LowonganPekerjaanController::class, 'destroy'])->name('lowongan-pekerjaan-destroy');
    })->name('lowongan-pekerjaan');

    Route::prefix('proses-seleksi')->group(function () {
        Route::get('/', [ProsesSeleksiController::class, 'index'])->name('proses-seleksi');
        Route::get('/data/{id}', [ProsesSeleksiController::class, 'show'])->name('proses-seleksi-data');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [ProsesSeleksiController::class, 'edit'])->name('proses-seleksi-detail');
        Route::POST('/detail/{lowonganPekerjaanId}', [ProsesSeleksiController::class, 'update'])->name('proses-seleksi-update');
        Route::get('/download/{filename}/{pelamarName}', [ProsesSeleksiController::class, 'download'])->name('download-dokumen');
        Route::get('/download-dokumen-seleksi-pelamar/{dokumenName}/{fileName}', [ProsesSeleksiController::class, 'downloadDokumenPelamar'])->name('unduh-dokumen-seleksi-pelamar');
    })->name('proses-seleksi');

    Route::prefix('pelamar-diterima')->group(function () {
        Route::get('/', [PelamarDiterimaController::class, 'index'])->name('pelamar-diterima');
        Route::get('/data/{id}', [PelamarDiterimaController::class, 'show'])->name('pelamar-diterima-data');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [PelamarDiterimaController::class, 'edit'])->name('pelamar-diterima-detail');
        Route::get('/download/{filename}/{pelamarName}', [PelamarDiterimaController::class, 'download'])->name('download-dokumen-pelamar-diterima');
        Route::POST('/validasi/{lowonganPekerjaanId}', [PelamarDiterimaController::class, 'validasi'])->name('validasi');
        Route::get('/download-dokumen-pelamar-diterima/{dokumenName}/{fileName}', [PelamarDiterimaController::class, 'downloadDokumenPelamar'])->name('unduh-dokumen-pelamar-diterima');
    })->name('pelamar-diterima');

    Route::prefix('pelamar-ditolak')->group(function () {
        Route::get('/', [PelamarDitolakController::class, 'index'])->name('pelamar-ditolak');
        Route::get('/data/{id}', [PelamarDitolakController::class, 'show'])->name('pelamar-ditolak-data');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [PelamarDitolakController::class, 'edit'])->name('pelamar-ditolak-detail');
        Route::get('/download/{filename}/{pelamarName}', [PelamarDitolakController::class, 'download'])->name('download-dokumen-pelamar-ditolak');
        Route::get('/download-dokumen-pelamar-ditolak/{dokumenName}/{fileName}', [PelamarDitolakController::class, 'downloadDokumenPelamar'])->name('unduh-dokumen-pelamar-ditolak');
    })->name('pelamar-ditolak');

    Route::prefix('hasil-validasi')->group(function () {
        Route::get('/', [HasilValidasiController::class, 'index'])->name('hasil-validasi');
        Route::get('/data/{id}', [HasilValidasiController::class, 'show'])->name('hasil-validasi-data');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [HasilValidasiController::class, 'edit'])->name('hasil-validasi-detail');
        Route::post('/kirim-notifikasi/{lowonganPekerjaanId}', [HasilValidasiController::class, 'kirimNotifikasi'])->name('kirim-notifikasi-pelamar');
        Route::get('/download/{filename}/{pelamarName}', [HasilValidasiController::class, 'download'])->name('download-dokumen-pelamar-validasi');
        Route::get('/download-dokumen-validasi-pelamar/{dokumenName}/{fileName}', [HasilValidasiController::class, 'downloadDokumenPelamar'])->name('unduh-dokumen-validasi-pelamar');
    })->name('hasil-validasi');

    Route::prefix('tes-potensi-akademik')->group(function () {
        Route::get('/', [TesPotensiAkademikController::class, 'index'])->name('tes-potensi-akademik');
        Route::get('/create', [TesPotensiAkademikController::class, 'create'])->name('tes-potensi-akademik-create');
        Route::post('/create', [TesPotensiAkademikController::class, 'store'])->name('tes-potensi-akademik-store');
        Route::get('/edit/{id}', [TesPotensiAkademikController::class, 'edit'])->name('tes-potensi-akademik-edit');
        Route::put('/edit/{id}', [TesPotensiAkademikController::class, 'update'])->name('tes-potensi-akademik-update');
        Route::get('/delete/{id}', [TesPotensiAkademikController::class, 'destroy'])->name('tes-potensi-akademik-destroy');
        Route::get('/pertanyaan/{id}', [TesPotensiAkademikController::class, 'createPertanyaan'])->name('tes-potensi-akademik-create-pertanyaan');
        Route::post('/pertanyaan/{id}', [TesPotensiAkademikController::class, 'storePertanyaan'])->name('tes-potensi-akademik-store-pertanyaan');
        Route::delete('/pertanyaan/delete/{tesPotensiAkademikId}/{pertanyaanTesPotensiAkademikId}', [TesPotensiAkademikController::class, 'destroyPertanyaan'])->name('tes-potensi-akademik-delete-pertanyaan');
        // Route::get('/pelamar-tes/{id}', [TesPotensiAkademikController::class, 'pelamarTes'])->name('tes-potensi-akademik-pelamar-tes');
    })->name('tes-potensi-akademik');

    Route::prefix('pelamar-tes')->group(function () {
        Route::get('/', [PelamarTesController::class, 'index'])->name('pelamar-tes');
        Route::get('/data/{id}', [PelamarTesController::class, 'show'])->name('pelamar-tes-data');
        Route::post('/kirim-notifikasi-tes/{lowonganPekerjaanId}', [PelamarTesController::class, 'kirimNotifikasi'])->name('kirim-notifikasi-tes');
        Route::post('/lulus-tpa/{lowonganPekerjaanId}', [PelamarTesController::class, 'lulusTPA'])->name('lulus-tpa');
        Route::post('/tidak-lulus-tpa/{lowonganPekerjaanId}', [PelamarTesController::class, 'tidakLulusTPA'])->name('tidak-lulus-tpa');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [PelamarTesController::class, 'edit'])->name('pelamar-tes-detail');
    })->name('pelamar-tes');

    Route::prefix('hasil-tes-potensi-akademik')->group(function () {
        Route::get('/', [HasilTesTPAController::class, 'index'])->name('hasil-tes-potensi-akademik');
        Route::post('/hitung-skor', [HasilTesTPAController::class, 'hitungSkor'])->name('hitung-skor');
        Route::get('/get-pelamar-by-lowongan-pekerjaan/{lowonganPekerjaanId}', [HasilTesTPAController::class, 'getPelamarByLowonganPekerjaan'])->name('get-pelamar-by-lowongan-pekerjaan');
        Route::get('/koreksi-tes/{pelamarTPAId}', [HasilTesTPAController::class, 'create'])->name('koreksi-tes-potensi-akademik');
    })->name('hasil-tes-potensi-akademik');

    Route::prefix('pelamar-wawancara')->group(function () {
        Route::get('/', [PelamarWawancaraController::class, 'index'])->name('pelamar-wawancara');
        Route::get('/data/{id}', [PelamarWawancaraController::class, 'show'])->name('pelamar-wawancara-data');
        Route::post('/kirim-notifikasi/{lowonganPekerjaanId}', [PelamarWawancaraController::class, 'kirimNotifikasi'])->name('kirim-notifikasi-pelamar-wawancara');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [PelamarWawancaraController::class, 'edit'])->name('pelamar-wawancara-detail');
        Route::get('/download-dokumen-pelamar-wawancara/{dokumenName}/{fileName}', [PelamarWawancaraController::class, 'downloadDokumenPelamarWawancara'])->name('unduh-dokumen-pelamar-wawancara');
        Route::POST('/detail/{lowonganPekerjaanId}', [PelamarWawancaraController::class, 'update'])->name('pelamar-wawancara-update');
    })->name('pelamar-wawancara');

    Route::prefix('pelamar-disetujui')->group(function () {
        Route::get('/', [PelamarDisetujuiController::class, 'index'])->name('pelamar-disetujui');
        Route::get('/data/{id}', [PelamarDisetujuiController::class, 'show'])->name('pelamar-disetujui-data');
        Route::post('/kirim-notifikasi/{lowonganPekerjaanId}', [PelamarDisetujuiController::class, 'kirimNotifikasi'])->name('kirim-notifikasi-pelamar-disetujui');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [PelamarDisetujuiController::class, 'edit'])->name('pelamar-disetujui-detail');
        Route::get('/download-dokumen-pelamar-disetujui/{dokumenName}/{fileName}', [PelamarDisetujuiController::class, 'downloadDokumenPelamarDisetujui'])->name('unduh-dokumen-pelamar-disetujui');
        Route::POST('/detail/{lowonganPekerjaanId}', [PelamarDisetujuiController::class, 'update'])->name('pelamar-disetujui-update');
    })->name('pelamar-disetujui');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});

Route::middleware(['auth:sanctum', 'verified', 'role:Manajer'])->group(function () {
    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard-manajer', [DashboardController::class, 'indexManajer'])->name('dashboard-manajer');

    Route::prefix('jabatan')->group(function () {
        Route::get('/', [JabatanController::class, 'index'])->name('jabatan');
        Route::get('/create', [JabatanController::class, 'create'])->name('jabatan-create');
        Route::post('/create', [JabatanController::class, 'store'])->name('jabatan-store');
        Route::get('/edit/{id}', [JabatanController::class, 'edit'])->name('jabatan-edit');
        Route::put('/edit/{id}', [JabatanController::class, 'update'])->name('jabatan-update');
        Route::get('/delete/{id}', [JabatanController::class, 'destroy'])->name('jabatan-destroy');
    })->name('jabatan');

    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria');
        Route::get('/create', [KriteriaController::class, 'create'])->name('kriteria-create');
        Route::post('/create', [KriteriaController::class, 'store'])->name('kriteria-store');
        Route::get('/edit/{id}', [KriteriaController::class, 'edit'])->name('kriteria-edit');
        Route::put('/edit/{id}', [KriteriaController::class, 'update'])->name('kriteria-update');
        Route::get('/delete/{id}', [KriteriaController::class, 'destroy'])->name('kriteria-destroy');
    })->name('kriteria');

    Route::prefix('subkriteria')->group(function () {
        Route::get('/', [SubkriteriaController::class, 'index'])->name('subkriteria');
        Route::get('/create', [SubkriteriaController::class, 'create'])->name('subkriteria-create');
        Route::post('/create', [SubkriteriaController::class, 'store'])->name('subkriteria-store');
        Route::get('/get-kriteria/{jabatanId}', [SubkriteriaController::class, 'getKriteriaByJabatan'])->name('get-kriteria-by-jabatan');
        Route::get('/edit/{id}', [SubkriteriaController::class, 'edit'])->name('subkriteria-edit');
        Route::put('/edit/{id}', [SubkriteriaController::class, 'update'])->name('subkriteria-update');
        Route::get('/delete/{id}', [SubkriteriaController::class, 'destroy'])->name('subkriteria-destroy');
    })->name('subkriteria');

    Route::prefix('pengukuran')->group(function () {
        Route::get('/', [PengukuranController::class, 'index'])->name('pengukuran');
        Route::get('/create', [PengukuranController::class, 'create'])->name('pengukuran-create');
        Route::post('/create', [PengukuranController::class, 'store'])->name('pengukuran-store');
        Route::get('/get-kriteria/{jabatanId}', [PengukuranController::class, 'getKriteriaByJabatan'])->name('get-kriteria-by-jabatan-in-pengukuran');
        Route::get('/get-subkriteria/{kriteriaId}', [PengukuranController::class, 'getSubkriteriaByKriteria'])->name('get-subkriteria-by-kriteria');
        Route::get('/edit/{id}', [PengukuranController::class, 'edit'])->name('pengukuran-edit');
        Route::put('/edit/{id}', [PengukuranController::class, 'update'])->name('pengukuran-update');
        Route::get('/delete/{id}', [PengukuranController::class, 'destroy'])->name('pengukuran-destroy');
    })->name('pengukuran');

    Route::prefix('kandidat-posisi')->group(function () {
        Route::get('/', [KandidatPosisiController::class, 'index'])->name('kandidat-posisi');
        Route::get('/data/{id}', [KandidatPosisiController::class, 'show'])->name('kandidat-posisi-data');
        Route::post('/kirim-notifikasi/{lowonganPekerjaanId}', [KandidatPosisiController::class, 'kirimNotifikasi'])->name('kirim-notifikasi-kandidat-posisi');
        Route::get('/detail/{pelamarId}/{lowonganPekerjaanId}', [KandidatPosisiController::class, 'edit'])->name('kandidat-posisi-detail');
        Route::get('/download-dokumen-kandidat-posisi/{dokumenName}/{fileName}', [KandidatPosisiController::class, 'downloadDokumenKandidat'])->name('unduh-dokumen-kandidat-posisi');
        Route::POST('/detail/{lowonganPekerjaanId}', [KandidatPosisiController::class, 'update'])->name('kandidat-posisi-update');
    })->name('kandidat-posisi');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});

Route::middleware(['auth:sanctum', 'verified', 'role:Pelamar'])->group(function () {
    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilPelamarController::class, 'index'])->name('profil');
        Route::get('/data-pribadi/{id}', [ProfilPelamarController::class, 'editDataPribadi'])->name('edit-data-pribadi');
        Route::POST('/data-pribadi/{id}', [ProfilPelamarController::class, 'updateDataPribadi'])->name('update-data-pribadi');
        Route::get('/riwayat-pendidikan-pengalaman/{id}', [ProfilPelamarController::class, 'editRiwayatPendidikanPengalaman'])->name('edit-riwayat-pendidikan-pengalaman');
        Route::POST('/riwayat-pendidikan-pengalaman/{id}', [ProfilPelamarController::class, 'updateRiwayatPendidikanPengalaman'])->name('update-riwayat-pendidikan-pengalaman');
        Route::get('/kontak-pribadi/{id}', [ProfilPelamarController::class, 'editKontakPribadi'])->name('edit-kontak-pribadi');
        Route::POST('/kontak-pribadi/{id}', [ProfilPelamarController::class, 'updateKontakPribadi'])->name('update-kontak-pribadi');
        Route::get('/lengkapi-dokumen/{id}', [ProfilPelamarController::class, 'editLengkapiDokumen'])->name('edit-lengkapi-dokumen');
        Route::POST('/lengkapi-dokumen/{id}', [ProfilPelamarController::class, 'updateLengkapiDokumen'])->name('update-lengkapi-dokumen');
    })->name('profil');

    Route::get('/beranda', [BerandaController::class, 'berandaPelamar']);

    Route::get('/melamar-pekerjaan', [MelamarPekerjaanController::class, 'index'])->name('melamar-pekerjaan');
    Route::get('/melamar-pekerjaan/{id}', [MelamarPekerjaanController::class, 'index'])->name('melamar-pekerjaan-id');
    Route::get('/get-detail-jabatanId/{id}', [MelamarPekerjaanController::class, 'getDetail'])->name('detail-jabatan');
    Route::get('/lamar/{id}', [MelamarPekerjaanController::class, 'create'])->name('lamar-create');
    Route::POST('/lamar/{id}', [MelamarPekerjaanController::class, 'store'])->name('lamar-store');

    Route::prefix('notifikasi')->group(function () {
        Route::get('/', [NotifikasiController::class, 'index'])->name('notifikasi');
        Route::post('/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi-markAsRead');
        Route::post('/mark-all-as-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifikasi-markAllAsRead');
        Route::get('/delete/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi-destroy');
    })->name('notifikasi');

    Route::prefix('lamaran-saya')->group(function () {
        Route::get('/', [LamaranSayaController::class, 'index'])->name('lamaran-saya');
        Route::get('/detail/{id}/{lowonganPekerjaanId}', [LamaranSayaController::class, 'show'])->name('lamaran-saya-show');
        Route::get('/download/{fileName}/{pelamarName}', [LamaranSayaController::class, 'downloadDokumenPendukung'])->name('unduh-dokumen-lamaran');
        Route::get('/download-dokumen-peserta/{dokumenName}/{fileName}', [LamaranSayaController::class, 'downloadDokumenPeserta'])->name('unduh-dokumen-peserta');
        Route::get('/delete/{id}', [LamaranSayaController::class, 'destroy'])->name('lamaran-saya-destroy');
    })->name('lamaran-saya');

    Route::prefix('tes-tpa')->group(function () {
        Route::get('/', [TesController::class, 'index'])->name('tes-potensi-akademik-pelamar');
        Route::get('/detail/{id}', [TesController::class, 'show'])->name('tes-potensi-akademik-pelamar-detail');
        Route::get('/mulai-tes/{id}', [TesController::class, 'create'])->name('tes-potensi-akademik-pelamar-create');
        Route::post('/kirim-jawaban/{id}/{pelamarTesId}', [TesController::class, 'store'])->name('kirim-jawaban');
    })->name('tes-tpa');
});
