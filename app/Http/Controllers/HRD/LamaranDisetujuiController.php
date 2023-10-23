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
            $notifikasi->pesan = "Selamat, kami ingin memberitahu Anda bahwa Anda telah sukses melewati tahap awal dalam proses seleksi pelamar kami. Selanjutnya, Anda akan lanjut ke tahap berikutnya, yaitu tes TPA (Tes Potensi Akademik). <br><br>

            Kami sangat menyarankan Anda untuk mempersiapkan diri dengan baik untuk tahap ini, mengingat tes TPA ini memiliki peran yang sangat penting dalam proses seleksi kami. Untuk informasi lebih lanjut mengenai tes TPA, silakan kunjungi bagian Menu TPA. <br><br>
            
            Terima kasih atas partisipasi Anda, dan kami berharap Anda akan berhasil melewati tahap ini. Tetap semangat!";

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
