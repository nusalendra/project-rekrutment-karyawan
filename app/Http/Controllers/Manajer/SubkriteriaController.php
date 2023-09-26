<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subkriteria;
use App\Models\Kriteria;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Crypt;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subkriteria::simplePaginate(8);

        return view('pages.manajer.subkriteria.index', ['title' => 'Subkriteria'], compact('data'));
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

        return view('pages.manajer.subkriteria.create', ['title' => 'Tambah Data'], compact('jabatan', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subkriteria = new Subkriteria;

        $subkriteria->jabatan_id = $request->input('jabatan_id');
        $subkriteria->kriteria_id = $request->input('kriteria_id');
        $subkriteria->nama = $request->input('nama');
        $subkriteria->nilai = $request->input('nilai');

        $subkriteria->save();

        return redirect('subkriteria');
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
        $subkriteriaId = Crypt::decrypt($id);
        $subkriteria = Subkriteria::findOrFail($subkriteriaId);
        $jabatan = Jabatan::get();
        $kriteria = Kriteria::get();

        return view('pages.manajer.subkriteria.edit', ['title' => 'Edit Data'], compact('jabatan', 'kriteria', 'subkriteria'));
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
        $subkriteria = Subkriteria::findOrFail($id);

        $subkriteria->jabatan_id = $request->input('jabatan_id');
        $subkriteria->kriteria_id = $request->input('kriteria_id');
        $subkriteria->nama = $request->input('nama');
        $subkriteria->nilai = $request->input('nilai');

        $subkriteria->save();

        return redirect('subkriteria');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subkriteria = Subkriteria::findOrFail($id);

        $subkriteria->delete();

        return redirect('subkriteria');
    }

    public function getKriteriaByJabatan($jabatanId)
    {
        $kriteria = Kriteria::where('jabatan_id', $jabatanId)->get();
        return response()->json(['kriteria' => $kriteria]);
    }
}
