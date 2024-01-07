<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\Periode;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class LowonganPekerjaanController extends Controller
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
            ->get();

        $tanggal = Carbon::now();
        $tanggalSekarang = $tanggal->format('Y-m-d');

        return view('pages.HRD.lowongan-pekerjaan.index', ['title' => 'Kelola Lowongan Pekerjaan'], compact('data', 'tanggalSekarang', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::get();
        $jabatan = Jabatan::get();

        return view('pages.HRD.lowongan-pekerjaan.create', ['title' => 'Tambah Data'], compact('periode', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lowonganPekerjaan = new LowonganPekerjaan;

        $lowonganPekerjaan->periode_id = $request->input('periode_id');
        $lowonganPekerjaan->jabatan_id = $request->input('jabatan_id');
        $tanggalMulailowonganPekerjaan = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('tanggal_mulai'))->format('Y-m-d');
        $lowonganPekerjaan->tanggal_mulai = $tanggalMulailowonganPekerjaan;
        $tanggalAkhirlowonganPekerjaan = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('tanggal_akhir'))->format('Y-m-d');
        $lowonganPekerjaan->tanggal_akhir = $tanggalAkhirlowonganPekerjaan;
        $lowonganPekerjaan->kuota = $request->input('kuota');

        $lowonganPekerjaan->save();

        return redirect('lowongan-pekerjaan');
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
        $lowonganPekerjaanId = Crypt::decrypt($id);
        $lowonganPekerjaan = LowonganPekerjaan::findOrFail($lowonganPekerjaanId);
        $periode = Periode::get();
        $jabatan = Jabatan::get();

        return view('pages.HRD.lowongan-pekerjaan.edit', ['title' => 'Edit Data'], compact('lowonganPekerjaan', 'periode', 'jabatan'));
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
        $lowonganPekerjaan = LowonganPekerjaan::findOrFail($id);

        $lowonganPekerjaan->periode_id = $request->input('periode_id');
        $lowonganPekerjaan->jabatan_id = $request->input('jabatan_id');
        $tanggalMulaiLowonganPekerjaan = $request->input('tanggal_mulai');
        if ($tanggalMulaiLowonganPekerjaan) {
            $tanggalMulaiLowonganPekerjaan = \Carbon\Carbon::createFromFormat('d-m-Y', $tanggalMulaiLowonganPekerjaan)->format('Y-m-d');
            $lowonganPekerjaan->tanggal_mulai = $tanggalMulaiLowonganPekerjaan;
        }

        $tanggalAkhirLowonganPekerjaan = $request->input('tanggal_akhir');
        if ($tanggalAkhirLowonganPekerjaan) {
            $tanggalAkhirLowonganPekerjaan = \Carbon\Carbon::createFromFormat('d-m-Y', $tanggalAkhirLowonganPekerjaan)->format('Y-m-d');
            $lowonganPekerjaan->tanggal_akhir = $tanggalAkhirLowonganPekerjaan;
        }
        $lowonganPekerjaan->kuota = $request->input('kuota');

        $lowonganPekerjaan->save();

        return redirect('lowongan-pekerjaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lowonganPekerjaan = LowonganPekerjaan::findOrFail($id);

        $lowonganPekerjaan->delete();

        return redirect('/lowongan-pekerjaan');
    }
}
