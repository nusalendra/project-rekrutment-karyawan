<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PelamarTesPotensiAkademik;
use App\Models\PertanyaanTesPotensiAkademik;
use App\Models\SkorTesPelamar;
use App\Models\Pelamar;
use App\Models\Jabatan;
use App\Models\LowonganPekerjaan;
use Illuminate\Support\Facades\Crypt;

class HasilTesTPAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelamarTes = PelamarTesPotensiAkademik::with('tesPotensiAkademik')
            ->get();
        $skorTesPelamar = [];


        foreach ($pelamarTes as $pelamarTest) {
            $skorTes = SkorTesPelamar::where('pelamar_id', $pelamarTest->pelamar->id)->get();
            $skorTesPelamar[$pelamarTest->pelamar->id] = $skorTes;
        }

        $jabatans = Jabatan::all();
        $lowonganPekerjaan = [];

        foreach ($jabatans as $jabatan) {
            $dataLowonganPekerjaan = LowonganPekerjaan::where('jabatan_id', $jabatan->id)->get();
            $lowonganPekerjaan[$jabatan->id] = $dataLowonganPekerjaan;
        }

        return view('pages.HRD.hasil-tes-potensi-akademik.index', ['title' => 'Data TPA Pelamar'], compact('pelamarTes', 'skorTesPelamar', 'lowonganPekerjaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pelamarTPAId)
    {
        $decryptpelamarId = Crypt::decrypt($pelamarTPAId);
        $pelamarTes = PelamarTesPotensiAkademik::with('tesPotensiAkademik')->findOrFail($decryptpelamarId);
        $pertanyaanTes = PertanyaanTesPotensiAkademik::where('tes_potensi_akademik_id', $pelamarTes->tesPotensiAkademik->id)->get();

        $dataJawaban = [];

        foreach ($pertanyaanTes as $pertanyaan) {
            $jawaban = $pertanyaan->jawabanTesPotensiAkademik->where('pelamar_tpa_id', $pelamarTes->id)->first();

            // Lakukan sesuatu dengan jawaban, misalnya tambahkan ke array
            $dataJawaban[] = $jawaban;
        }

        return view('pages.HRD.hasil-tes-potensi-akademik.koreksi-tes', ['title' => 'Koreksi Tes'], compact('pelamarTes', 'pertanyaanTes', 'dataJawaban'));
    }

    public function hitungSkor(Request $request)
    {
        $lowonganPekerjaanId = $request->input('lowonganPekerjaanId');

        $pelamar = Pelamar::whereHas('lowonganPekerjaan', function ($query) use ($lowonganPekerjaanId) {
            $query->where('lowongan_pekerjaans.id', $lowonganPekerjaanId);
        })->get();

        foreach ($pelamar as $item) {
            $pelamarTes = PelamarTesPotensiAkademik::where('pelamar_id', $item->id)->get();

            $totalPertanyaan = $pelamarTes->sum('total_pertanyaan');
            
            $totalJawabanBenar = $pelamarTes->sum('total_jawaban_benar');

            $hitungSkor = ($totalJawabanBenar / $totalPertanyaan) * 600 + 200;

            $skorTes = new SkorTesPelamar();

            $skorTes->pelamar_id = $item->id;
            $skorTes->skor_tes = $hitungSkor;

            $skorTes->save();
        }

        return redirect('/hasil-tes-potensi-akademik');
    }

    public function getPelamarByLowonganPekerjaan($lowonganPekerjaanId)
    {
        $pelamarTes = PelamarTesPotensiAkademik::whereHas('tesPotensiAkademik.lowonganPekerjaan', function ($query) use ($lowonganPekerjaanId) {
            $query->where('lowongan_pekerjaans.id', $lowonganPekerjaanId);
        })->get();

        return response()->json(['pelamarTes' => $pelamarTes]);
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
        //
    }
}
