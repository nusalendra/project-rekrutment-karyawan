<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LowonganPekerjaan;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Models\Notifikasi;
use App\Models\SkorTesPelamar;

class PelamarTesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data = LowonganPekerjaan::join('jabatans', 'lowongan_pekerjaans.jabatan_id', '=', 'jabatans.id')
            ->join('periodes', 'lowongan_pekerjaans.periode_id', '=', 'periodes.id')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('jabatans.nama', 'like', "%$searchTerm%")->orWhere('periodes.nama', 'like', "%$searchTerm%");
            })
            ->orderByDesc('lowongan_pekerjaans.created_at')
            ->select('periodes.nama as nama_periode', 'lowongan_pekerjaans.*', 'jabatans.nama as nama_jabatan')
            ->simplePaginate(6);

        $tanggal = Carbon::now();
        $tanggalSekarang = $tanggal->format('Y-m-d');

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Diterima')->get();
        return view('pages.HRD.pelamar-tes.index', ['title' => 'Pelamar Tes'], compact('data', 'tanggalSekarang', 'pelamar', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($id);

        $data = Pelamar::leftJoin('skor_tes_pelamars', function ($join) {
            $join->on('pelamars.id', '=', 'skor_tes_pelamars.pelamar_id');
        })
            ->select('pelamars.*', 'skor_tes_pelamars.skor_tes')
            ->where('pelamars.lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
            ->where('pelamars.status_lamaran', 'Tahap Tes Potensi Akademik')
            ->orderByDesc('skor_tes_pelamars.skor_tes')
            ->get();

        return view('pages.HRD.pelamar-tes.show', ['title' => 'Pelamar Tes'], compact('data', 'lowonganPekerjaanIdDecrypt'));
    }

    public function kirimNotifikasi($lowonganPekerjaanId)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Tahap Tes Potensi Akademik')->get();

        foreach ($pelamars as $pelamar) {
            $notifikasi = new Notifikasi();
            $notifikasi->user_id = $pelamar->user->id;
            $notifikasi->pesan = "Selamat, dengan senang hati kami informasikan bahwa Anda telah berhasil melalui fase awal dalam proses seleksi kami. Selanjutnya, Anda akan melanjutkan ke tahap berikutnya, yaitu tes TPA (Tes Potensi Akademik). <br><br>
            Kami sangat menyarankan Anda untuk bersiap dengan baik menghadapi tahap ini, karena tes TPA memegang peranan yang sangat penting dalam proses seleksi kami. Untuk mendapatkan informasi lebih lanjut tentang tes TPA, silakan klik tombol di bawah ini untuk diarahkan ke halaman Tes. <br><br>
            Terima kasih atas partisipasi Anda, dan kami berharap Anda sukses melewati tahap ini. Tetap semangat! <br><br>
            <a href='/tes-tpa' class='flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Kunjungi Halaman Tes</a>";

            $notifikasi->save();
        }

        return redirect()->route('pelamar-tes-data', $lowonganPekerjaanId);
    }

    public function lulusTPA($lowonganPekerjaanId)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->get();

        foreach ($pelamars as $pelamar) {
            $skorTes = SkorTesPelamar::where('pelamar_id', $pelamar->id)
                ->whereBetween('skor_tes', [500, 800])
                ->get();

            if ($skorTes->count() > 0) {
                $pelamar->status_lamaran = 'Tahap Pengoreksian Tes Potensi Akademik';
                $pelamar->save();
            }
        }
        return redirect()->route('pelamar-tes-data', $lowonganPekerjaanId);
    }

    public function tidakLulusTPA($lowonganPekerjaanId)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
            ->where('status_lamaran', 'Tahap Tes Potensi Akademik')
            ->get();

        foreach ($pelamars as $pelamar) {
            $skorTes = SkorTesPelamar::where('pelamar_id', $pelamar->id)
                ->where('skor_tes', '>=', 200)
                ->where('skor_tes', '<', 500)
                ->first();

            if ($skorTes) {
                $pelamar->status_lamaran = 'Tahap Tes Potensi Akademik Ditolak';
                $pelamar->save();

                $notifikasi = new Notifikasi();
                $notifikasi->user_id = $pelamar->user->id;
                $notifikasi->pesan = "Terkait dengan proses seleksi penerimaan karyawan baru, kami ingin menginformasikan hasil tes potensi akademik Anda untuk Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong> dengan Total <strong>" . $skorTes->skor_tes . "</strong> Skor yang diperoleh. <br><br>Kami ingin menyampaikan bahwa pelamar yang memperoleh skor di bawah 500 tidak memenuhi persyaratan minimum yang telah ditetapkan untuk tahap ini. <br><br>Oleh karena itu, dengan penuh penyesalan, kami harus menolak lamaran Anda untuk tahap ini. <br><br>Kami menghargai dedikasi waktu dan usaha yang Anda sumbangkan dalam mengikuti proses seleksi ini. Tetaplah semangat, karena kami yakin bahwa setiap pengalaman ini dapat menjadi landasan berharga untuk pengembangan karier Anda di masa depan.";

                $notifikasi->save();
            }
        }

        return redirect()->route('pelamar-tes-data', $lowonganPekerjaanId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pelamarId, $lowonganPekerjaanId)
    {
        $pelamarIdDecrypt = Crypt::decrypt($pelamarId);
        $data = Pelamar::with('user')->findOrFail($pelamarIdDecrypt);

        // $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);

        $dataPenilaian = $data->penilaian;
        $dataDokumenPendukung = $data->dokumenPendukung;

        return view('pages.HRD.pelamar-tes.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId', 'dataDokumenPendukung'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
