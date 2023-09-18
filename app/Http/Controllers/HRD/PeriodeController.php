<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use Illuminate\Support\Facades\Crypt;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Periode::simplePaginate(8);

        return view('pages.HRD.periode.index', ['title' => 'Periode'], compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Periode::all();

        return view('pages.HRD.periode.create', ['title' => 'Tambah Data'], compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = new Periode;

        $periode->nama = $request->nama;

        $periode->save();

        return redirect('/periode');
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
        $periodeId = Crypt::decrypt($id);
        $periode = Periode::findOrFail($periodeId);

        return view('pages.HRD.periode.edit', ['title' => 'Edit Data'], compact('periode'));
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
        $periode = Periode::findOrFail($id);

        $periode->nama = $request->nama;

        $periode->save();

        return redirect('periode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);

        $periode->delete();

        return redirect('periode');
    }
}
