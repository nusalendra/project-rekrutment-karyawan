<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengukuran;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Crypt;

class PengukuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $data = Pengukuran::join('jabatans', 'pengukurans.jabatan_id', '=', 'jabatans.id')
            ->join('kriterias', 'pengukurans.kriteria_id', '=', 'kriterias.id')
            ->join('subkriterias', 'pengukurans.subkriteria_id', '=', 'subkriterias.id')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('jabatans.nama', 'like', "%$searchTerm%");
            })
            ->orderByDesc('pengukurans.created_at')
            ->select('kriterias.nama as nama_kriteria', 'jabatans.nama as nama_jabatan', 'subkriterias.nama as nama_subkriteria', 'pengukurans.nama as nama_pengukuran', 'kriterias.tipe', 'pengukurans.skor')
            ->simplePaginate(10);


        return view('pages.manajer.pengukuran.index', ['title' => 'Pengukuran'], compact('data', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::get();
        $kriteria = Kriteria::get();
        $subkriteria = Subkriteria::get();

        return view('pages.manajer.pengukuran.create', ['title' => 'Tambah Data'], compact('jabatan', 'kriteria', 'subkriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengukuran = new Pengukuran();

        $pengukuran->jabatan_id = $request->jabatan_id;
        $pengukuran->kriteria_id = $request->kriteria_id;
        $pengukuran->subkriteria_id = $request->subkriteria_id;
        $pengukuran->nama = $request->nama;
        $pengukuran->skor = $request->skor;

        $pengukuran->save();

        return redirect('/pengukuran');
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
        $pengukuranId = Crypt::decrypt($id);
        $pengukuran = Pengukuran::findOrFail($pengukuranId);
        $jabatan = Jabatan::get();
        $kriteria = Kriteria::get();
        $subkriteria = Subkriteria::get();

        return view('pages.manajer.pengukuran.edit', ['title' => 'Edit Data'], compact('pengukuran', 'jabatan', 'kriteria', 'subkriteria'));
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
        $pengukuran = Pengukuran::findOrFail($id);
        $pengukuran->jabatan_id = $request->jabatan_id;
        $pengukuran->kriteria_id = $request->kriteria_id;
        $pengukuran->subkriteria_id = $request->subkriteria_id;
        $pengukuran->nama = $request->nama;
        $pengukuran->skor = $request->skor;

        $pengukuran->save();

        return redirect('/pengukuran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengukuran = Pengukuran::findOrFail($id);

        $pengukuran->delete();

        return redirect('/pengukuran');
    }

    public function getKriteriaByJabatan($jabatanId)
    {
        $kriteria = Kriteria::where('jabatan_id', $jabatanId)->get();
        return response()->json(['kriteria' => $kriteria]);
    }

    public function getSubkriteriaByKriteria($kriteriaId)
    {
        $subkriteria = Subkriteria::where('kriteria_id', $kriteriaId)->get();
        return response()->json(['subkriteria' => $subkriteria]);
    }
}
