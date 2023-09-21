<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Crypt;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kriteria::with('jabatan')->simplePaginate(8);

        return view('pages.manajer.kriteria.index', ['title' => 'Kriteria'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = Jabatan::get();

        return view('pages.manajer.kriteria.create', ['title' => 'Tambah Data'], compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipe' => 'required|in:Benefit,Cost'
        ]);

        $kriteria = new Kriteria;

        $kriteria->jabatan_id = $request->jabatan_id;
        $kriteria->nama = $request->nama;
        $kriteria->tipe = $validatedData['tipe'];
        $kriteria->bobot = $request->bobot;

        $kriteria->save();

        return redirect('/kriteria');
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
        $kriteriaId = Crypt::decrypt($id);
        $kriteria = Kriteria::findOrFail($kriteriaId);
        $jabatan = Jabatan::all();

        $pilihTipeKriteria = [
            ['value' => 'Benefit', 'label' => 'Benefit'],
            ['value' => 'Cost', 'label' => 'Cost'],
        ];

        return view('pages.manajer.kriteria.edit', ['title' => 'Edit Data'], compact('kriteria', 'jabatan', 'pilihTipeKriteria'));
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
        $validatedData = $request->validate([
            'tipe' => 'required|in:Benefit,Cost'
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $kriteria->jabatan_id = $request->jabatan_id;
        $kriteria->nama = $request->nama;
        $kriteria->tipe = $validatedData['tipe'];
        $kriteria->bobot = $request->bobot;

        $kriteria->save();

        return redirect('/kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $kriteria->delete();

        return redirect('/kriteria');
    }
}
