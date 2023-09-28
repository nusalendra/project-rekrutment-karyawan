<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\HasilValidasi;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\Jabatan;
use App\Models\LowonganPekerjaan;
use Carbon\Carbon;

class ProsesSeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LowonganPekerjaan::with('periode', 'jabatan')->get();

        $tanggal = Carbon::now();
        $tanggalSekarang = $tanggal->format('Y-m-d');

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Proses')->get();

        return view('pages.HRD.proses-seleksi.index', ['title' => 'Proses Seleksi'], compact('data', 'tanggalSekarang', 'pelamar'));
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
        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Proses')->get();

        return view('pages.HRD.proses-seleksi.show', ['title' => 'Antrian Pelamar'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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

        $dataPenilaian = $data->penilaian;

        return view('pages.HRD.proses-seleksi.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lowonganPekerjaanId)
    {
        $statusLamaran = $request->input('status_lamaran');

        if ($statusLamaran === 'Diterima') {
            $this->lamaranDiterima($request);
        } elseif ($statusLamaran === 'Ditolak') {
            $this->lamaranDitolak($request);
        }
        return redirect()->route('proses-seleksi-data', $lowonganPekerjaanId);
    }

    public function lamaranDiterima(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian', 'lowonganPekerjaan')->findOrFail($pelamarId);

        $dataPelamar->status_lamaran = 'Diterima';

        $dataPelamar->save();
    }

    public function lamaranDitolak(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian')->findOrFail($pelamarId);

        $dataPelamar->status_lamaran = 'Ditolak';

        $dataPelamar->save();

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $dataPelamar->user->id;
        $notifikasi->pesan = "Kami ingin memberitahu Anda bahwa kami telah menyelesaikan proses seleksi kami, dan kami menentukan bahwa saat ini kami menolak Lamaran Anda pada Posisi <strong>" . $dataPelamar->lowonganPekerjaan->jabatan->nama . "</strong>. Kami menghargai waktu dan usaha yang telah Anda habiskan dalam melamar di perusahaan kami. Terima kasih atas minat Anda dan kami mendoakan Anda sukses dalam pencarian karier berikutnya.";

        $notifikasi->save();
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
