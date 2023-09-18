<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\HasilValidasi;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kriteria;

class AntrianPelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Proses')->get();

        return view('pages.HRD.antrian-pelamar.index', ['title' => 'Antrian Pelamar'], compact('data'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelamarId = Crypt::decrypt($id);
        $data = Pelamar::with('user')->findOrFail($pelamarId);

        $dataPenilaian = $data->penilaian;

        return view('pages.HRD.antrian-pelamar.detail', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $statusLamaran = $request->input('status_lamaran');

        if ($statusLamaran === 'Disetujui') {
            $this->lamaranDisetujui($request);
        } elseif ($statusLamaran === 'Ditolak') {
            $this->lamaranDitolak($request);
        }
        return redirect('antrian-pelamar');
    }

    public function lamaranDisetujui(Request $request)
    {
        $bobotKriteria = Kriteria::pluck('bobot', 'nama');
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian')->findOrFail($pelamarId);
        
        $totalNilai = 0;

        foreach ($bobotKriteria as $kriteriaNama => $bobot) {
            $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
            // Mengambil nilai normalisasi dari tabel penilaian jika ada
            $penilaian = $dataPelamar->penilaian->where('kriteria_id', $kriteria->id)->first();

            if ($penilaian) {
                // Jika ada penilaian, maka ambil nilai normalisasi
                $nilaiKriteria = $penilaian->nilai_normalisasi;

                // Mengalikan nilai normalisasi dengan bobot kriteria
                $totalNilai += $nilaiKriteria * $bobot;
            }
        }

        $hasilValidasi = new HasilValidasi();

        $hasilValidasi->pelamar_id = $pelamarId;
        $hasilValidasi->hasil_penilaian = $totalNilai;

        $hasilValidasi->save();

        $dataPelamar->status_lamaran = 'Disetujui';

        $dataPelamar->save();
    }

    public function lamaranDitolak(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian')->findOrFail($pelamarId);

        $dataPelamar->status_lamaran = 'Ditolak';

        $dataPelamar->save();
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
