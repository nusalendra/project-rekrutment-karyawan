<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\JawabanTesPotensiAkademik;
use App\Models\PertanyaanTesPotensiAkademik;
use Illuminate\Http\Request;
use App\Models\TesPotensiAkademik;
use App\Models\Pelamar;
use App\Models\PelamarTesPotensiAkademik;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pelamar = Pelamar::where('user_id', $user->id)->first();
        
        $tesPotensiAkademik = TesPotensiAkademik::with('lowonganPekerjaan')
            ->join('pelamar_tes_potensi_akademiks', 'pelamar_tes_potensi_akademiks.tes_potensi_akademik_id', '=', 'tes_potensi_akademiks.id')
            ->select('tes_potensi_akademiks.id', 'tes_potensi_akademiks.lowongan_pekerjaan_id', 'tes_potensi_akademiks.nama', 'tes_potensi_akademiks.tanggal_waktu_mulai', 'tes_potensi_akademiks.tanggal_waktu_selesai', 'pelamar_tes_potensi_akademiks.updated_at')
            ->where('pelamar_tes_potensi_akademiks.pelamar_id', $pelamar->id)
            ->get()
            ->groupBy('lowongan_pekerjaan_id');
            // dd($tesPotensiAkademik);

        return view('pages.pelamar.tes.index', ['title' => 'Tes Potensi Akademik'], compact('tesPotensiAkademik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $idDecrypt = Crypt::decrypt($id);
        $tesPotensiAkademik = TesPotensiAkademik::find($idDecrypt);
        
        $soalTes = PertanyaanTesPotensiAkademik::where('tes_potensi_akademik_id', $idDecrypt)->get();
        $user = Auth::user();
        $pelamar = Pelamar::where('user_id', $user->id)->first();
        // dd($pelamar);
        $pelamarTesId = PelamarTesPotensiAkademik::where('tes_potensi_akademik_id', $idDecrypt)->where('pelamar_id', $pelamar->id)->first();
        // dd($pelamarTesId);
        return view('pages.pelamar.tes.create', ['title' => 'Mulai Tes'], compact('tesPotensiAkademik' ,'soalTes', 'id', 'pelamarTesId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $pelamarTesId)
    {
        $tesPotensiAkademikIdDecrypt = Crypt::decrypt($id);

        $pertanyaanId = $request->input('pertanyaan');
        $jawabanData = $request->input('pilihan');

        foreach ($pertanyaanId as $index => $pertanyaan) {
            $jawabanTPA = new JawabanTesPotensiAkademik();
            $jawabanTPA->pelamar_tpa_id = $pelamarTesId;
            $jawabanTPA->pertanyaan_tpa_id = $pertanyaan;
            $jawabanTPA->pilihan_jawaban = $jawabanData[$index]; // Mengambil pilihan jawaban yang sesuai

            $jawabanTPA->save();
        }

        PelamarTesPotensiAkademik::where('id', $pelamarTesId)->where('tes_potensi_akademik_id', $tesPotensiAkademikIdDecrypt)->update([
            'updated_at' => now()
        ]);

        return redirect('tes-tpa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tesPotensiAkademikIdDecrypt = Crypt::decrypt($id);

        $tesPotensiAkademik = TesPotensiAkademik::findOrFail($tesPotensiAkademikIdDecrypt);

        return view('pages.pelamar.tes.show', ['title' => 'Persiapan Tes'], compact('tesPotensiAkademik', 'id'));
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
