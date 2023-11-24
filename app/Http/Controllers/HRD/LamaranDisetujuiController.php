<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\LowonganPekerjaan;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Models\Notifikasi;

class LamaranDisetujuiController extends Controller
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
        return view('pages.HRD.lamaran-disetujui.index', ['title' => 'Lamaran Disetujui'], compact('data', 'tanggalSekarang', 'pelamar', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
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

        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Disetujui')->get();

        return view('pages.HRD.lamaran-disetujui.show', ['title' => 'Lamaran Disetujui'], compact('data', 'lowonganPekerjaanIdDecrypt'));
    }

    public function kirimNotifikasi($lowonganPekerjaanId)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Disetujui')->get();

        foreach ($pelamars as $pelamar) {
            $notifikasi = new Notifikasi();
            $notifikasi->user_id = $pelamar->user->id;
            $notifikasi->pesan = "Selamat, dengan senang hati kami informasikan bahwa Anda telah berhasil melalui fase awal dalam proses seleksi kami. Selanjutnya, Anda akan melanjutkan ke tahap berikutnya, yaitu tes TPA (Tes Potensi Akademik). <br><br>

            Kami sangat menyarankan Anda untuk bersiap dengan baik menghadapi tahap ini, karena tes TPA memegang peranan yang sangat penting dalam proses seleksi kami. Untuk mendapatkan informasi lebih lanjut tentang tes TPA, silakan klik tombol di bawah ini untuk diarahkan ke halaman Tes. <br><br>
            
            Terima kasih atas partisipasi Anda, dan kami berharap Anda sukses melewati tahap ini. Tetap semangat! <br><br>
            <a href='/tes-tpa' class='flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Kunjungi Halaman Tes</a>";

            $notifikasi->save();
        }

        return redirect()->route('lamaran-disetujui-data', $lowonganPekerjaanId);
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

        return view('pages.HRD.lamaran-disetujui.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId', 'dataDokumenPendukung'));
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
