<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Facades\Crypt;

class HasilValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Pelamar::with('user', 'lowonganPekerjaan')
        //     ->join('hasil_validasis', 'pelamars.id', 'hasil_validasis.pelamar_id')
        //     ->where('status_lamaran', 'Disetujui')
        //     ->orderBy('hasil_validasis.hasil_penilaian', 'desc')
        //     ->get();

        $data = LowonganPekerjaan::with('periode', 'jabatan')->get();

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Disetujui')->get();

        return view('pages.HRD.hasil-validasi.index', ['title' => 'Hasil Validasi Pelamar'], compact('data', 'pelamar'));
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
        $data = Pelamar::select('pelamars.id', 'users.name as nama_user', 'jabatans.nama as nama_jabatan', 'hasil_validasis.hasil_penilaian')
            ->join('hasil_validasis', 'pelamars.id', 'hasil_validasis.pelamar_id')
            ->join('lowongan_pekerjaans', 'pelamars.lowongan_pekerjaan_id', 'lowongan_pekerjaans.id')
            ->join('users', 'pelamars.user_id', 'users.id')
            ->join('jabatans', 'lowongan_pekerjaans.jabatan_id', 'jabatans.id')
            ->where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
            ->where('status_lamaran', 'Disetujui')
            ->orderBy('hasil_validasis.hasil_penilaian', 'desc')
            ->get();

        return view('pages.HRD.hasil-validasi.show', ['title' => 'Hasil Validasi Pelamar'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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
        $data = Pelamar::with('user')->find($pelamarIdDecrypt);

        $dataPenilaian = $data->penilaian;

        return view('pages.HRD.hasil-validasi.edit', ['title' => 'Detail Pelamar'], compact('data', 'pelamarId', 'lowonganPekerjaanId', 'dataPenilaian'));
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
