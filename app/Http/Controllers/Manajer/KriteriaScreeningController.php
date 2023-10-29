<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\KriteriaScreening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KriteriaScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data = KriteriaScreening::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('nama', 'like', "%$searchTerm%");
        })
            ->orderByDesc('created_at')
            ->simplePaginate(6);

        return view('pages.manajer.kriteria-screening.index', ['title' => 'Kriteria'], compact('data', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.manajer.kriteria-screening.create', ['title' => 'Tambah Data']);
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

        $kriteria = new KriteriaScreening();

        $kriteria->nama = $request->nama;
        $kriteria->tipe = $validatedData['tipe'];
        $kriteria->bobot = $request->bobot;

        $kriteria->save();

        return redirect('/kriteria-screening');
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
        $kriteria = KriteriaScreening::find($kriteriaId);

        $pilihTipeKriteria = [
            ['value' => 'Benefit', 'label' => 'Benefit'],
            ['value' => 'Cost', 'label' => 'Cost'],
        ];

        return view('pages.manajer.kriteria-screening.edit', ['title' => 'Edit Data'], compact('kriteria', 'pilihTipeKriteria'));
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

        $kriteria = KriteriaScreening::findOrFail($id);

        $kriteria->nama = $request->nama;
        $kriteria->tipe = $validatedData['tipe'];
        $kriteria->bobot = $request->bobot;

        $kriteria->save();

        return redirect('/kriteria-screening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = KriteriaScreening::findOrFail($id);

        $kriteria->delete();

        return redirect('/kriteria-screening');
    }
}
