<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use App\Models\KriteriaScreening;
use App\Models\SubkriteriaScreening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubkriteriaScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $data = SubkriteriaScreening::join('kriteria_screenings', 'subkriteria_screenings.kriteria_screening_id', '=', 'kriteria_screenings.id')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('kriteria_screenings.nama', 'like', "%$searchTerm%");
            })
            ->orderByDesc('subkriteria_screenings.created_at')
            ->select('subkriteria_screenings.id', 'kriteria_screenings.nama as nama_kriteria', 'subkriteria_screenings.nama as nama_subkriteria', 'kriteria_screenings.tipe', 'subkriteria_screenings.skor')
            ->simplePaginate(6);

        return view('pages.manajer.subkriteria-screening.index', ['title' => 'Subkriteria'], compact('data', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = KriteriaScreening::get();

        return view('pages.manajer.subkriteria-screening.create', ['title' => 'Tambah Data'], compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subkriteria = new SubkriteriaScreening();

        $subkriteria->kriteria_screening_id = $request->input('kriteria_screening_id');
        $subkriteria->nama = $request->input('nama');
        $subkriteria->skor = $request->input('skor');

        $subkriteria->save();

        return redirect('subkriteria-screening');
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
        $subkriteria = SubkriteriaScreening::findOrFail($subkriteriaId);
        $kriteria = KriteriaScreening::get();

        return view('pages.manajer.subkriteria-screening.edit', ['title' => 'Edit Data'], compact('kriteria', 'subkriteria'));
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
        $subkriteria = SubkriteriaScreening::findOrFail($id);

        $subkriteria->kriteria_screening_id = $request->input('kriteria_screening_id');
        $subkriteria->nama = $request->input('nama');
        $subkriteria->skor = $request->input('skor');

        $subkriteria->save();

        return redirect('subkriteria-screening');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subkriteria = SubkriteriaScreening::findOrFail($id);

        $subkriteria->delete();

        return redirect('subkriteria-screening');
    }
}
