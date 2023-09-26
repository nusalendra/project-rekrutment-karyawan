<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Models\LowonganPekerjaan;
use Carbon\Carbon;

class PelamarDitolakController extends Controller
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


        return view('pages.HRD.pelamar-ditolak.index', ['title' => 'Pelamar Ditolak'], compact('data', 'tanggalSekarang', 'pelamar'));
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
        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Ditolak')->get();

        return view('pages.HRD.pelamar-ditolak.show', ['title' => 'Pelamar Ditolak'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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

        return view('pages.HRD.pelamar-ditolak.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId'));
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
