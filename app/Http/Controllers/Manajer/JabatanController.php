<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Crypt;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jabatan::simplePaginate(8);

        return view('pages.manajer.jabatan.index', ['title' => 'Jabatan'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Jabatan::all();

        return view('pages.manajer.jabatan.create', ['title' => 'Tambah Data'], compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatan = new Jabatan;

        $jabatan->nama = $request->nama;
        $jabatan->deskripsi = $request->deskripsi;
        $jabatan->benefit_pekerjaan = $request->benefit_pekerjaan;
        $jabatan->kriteria = $request->kriteria;
        $jabatan->gaji_awal = $request->gaji_awal;
        $jabatan->gaji_akhir = $request->gaji_akhir;

        $jabatan->save();

        return redirect('/jabatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatanId = Crypt::decrypt($id);
        $jabatan = Jabatan::findOrFail($jabatanId);

        return view('pages.manajer.jabatan.edit', ['title' => 'Edit Data'], compact('jabatan'));
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
        $jabatan = Jabatan::findOrFail($id);

        $jabatan->nama = $request->nama;
        $jabatan->deskripsi = $request->deskripsi;
        $jabatan->benefit_pekerjaan = $request->benefit_pekerjaan;
        $jabatan->kriteria = $request->kriteria;
        $jabatan->gaji_awal = $request->gaji_awal;
        $jabatan->gaji_akhir = $request->gaji_akhir;

        $jabatan->save();

        return redirect('/jabatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $jabatan->delete();

        return redirect('/jabatan');
    }
}
