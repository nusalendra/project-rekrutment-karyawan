<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Pelamar;
use App\Models\LowonganPekerjaan;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\Pengukuran;

class LamaranSayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = Pelamar::with('lowonganPekerjaan', 'user')
            ->where('user_id', $user->id)
            ->orderBy('created_at')
            ->simplePaginate(6);

        return view('pages.pelamar.lamaran-saya.index', ['title' => 'Lamaran Saya'], compact('data'));
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
    public function show($id, $lowonganPekerjaanId)
    {
        $pelamarIdDecrypt = Crypt::decrypt($id);
        // dd($pelamarIdDecrypt);
        $data = Pelamar::with('user')->findOrFail($pelamarIdDecrypt);

        $dataUser = $data->user->dataUser;

        $dataPenilaian = $data->penilaian;

        $lowonganIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $lowonganPekerjaan = LowonganPekerjaan::find($lowonganIdDecrypt);
        // dd($lowonganPekerjaan);

        $jabatanId = $lowonganPekerjaan->jabatan_id;
        $jabatan = Jabatan::find($jabatanId);

        $kriteria = Kriteria::where('jabatan_id', $jabatan->id)->get();

        $subkriteria = collect();

        foreach ($kriteria as $item) {
            $subkriteria = $subkriteria->concat($item->subkriteria);
        }

        $subkriteriaIds = $subkriteria->pluck('id')->all();

        $pengukuran = Pengukuran::whereIn('subkriteria_id', $subkriteriaIds)->get();

        // $pelamarIdDecrypt = Crypt::decrypt($id);
        // $data = Pelamar::with('user')->findOrFail($pelamarIdDecrypt);

        // $dataPenilaian = $data->penilaian;

        // $dataDokumenPenilaian = $data->dokumenPenilaian;
        // $dataDokumenPendukung = $data->dokumenPendukung;

        return view('pages.pelamar.lamaran-saya.detail', ['title' => 'Detail Lamaran'], compact('data', 'dataPenilaian', 'id', 'lowonganPekerjaanId', 'lowonganPekerjaan', 'dataUser', 'subkriteria', 'pengukuran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status_lamaran = 'Dibatalkan';
        $pelamar->updated_at = now();
        $pelamar->save();

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $pelamar->user_id;
        $notifikasi->pesan = 'Kami ingin memberitahukan bahwa lamaran pekerjaan Anda untuk Posisi <strong>' . $pelamar->lowonganPekerjaan->jabatan->nama . '</strong> pada tanggal <strong>' . \Carbon\Carbon::parse($pelamar->updated_at)->format('d-m-Y / H:i:s') . '</strong> telah berhasil dibatalkan. Terima kasih atas ketertarikan Anda pada kesempatan ini. Kami sangat menghargai waktu dan usaha yang Anda habiskan untuk melamar pekerjaan di perusahaan kami. Meskipun lamaran Anda telah dibatalkan, kami menghargai partisipasi Anda dalam proses seleksi. <br><br> Tetap terhubung dengan kami untuk mendapatkan informasi tentang peluang pekerjaan mendatang yang mungkin sesuai dengan profil dan keterampilan Anda. Terima kasih lagi dan semoga Anda berhasil dalam pencarian pekerjaan Anda.';

        $notifikasi->save();

        $pelamar->delete();

        return redirect('/lamaran-saya');
    }

    public function downloadDokumenPendukung($fileName, $pelamarName)
    {
        // Tentukan path lengkap file gambar
        $filePath = public_path('dokumen-pendukung/' . $pelamarName . '/' . $fileName);

        // Pastikan file ada sebelum menginisialisasi unduhan
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }

    public function downloadDokumenPeserta($dokumenName, $fileName)
    {

        $filePath = public_path('dokumen-peserta/Dokumen_' . $dokumenName . '/' . $fileName);

        // Pastikan file ada sebelum menginisialisasi unduhan
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }
}
