<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\Periode;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Crypt;

class LamaranPekerjaanController extends Controller
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
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->orWhere('jabatans.nama', 'like', "%$searchTerm%");
            })
            ->where('lowongan_pekerjaans.kuota', '>', 0)
            ->orderBy('lowongan_pekerjaans.created_at', 'asc')
            ->get();
        
        $periode = Periode::all();

        return view('pages.guest.lamaran-pekerjaan.index', ['title' => 'Lamaran Pekerjaan'], compact('data', 'searchTerm', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function getDetail($id)
    {
        $jabatanIdDecrypt = Crypt::decrypt($id);
        $jabatan = Jabatan::findOrFail($jabatanIdDecrypt);

        // Mengambil informasi lowongan pekerjaan terkait
        $lowonganPekerjaan = LowonganPekerjaan::where('jabatan_id', $jabatan->id)->first();

        // Lakukan proses untuk mengambil data detail sesuai dengan ID card yang dipilih
        // Misalnya, buat view untuk menampilkan data detail
        return view('pages.guest.lamaran-pekerjaan.detail-jabatan', compact('jabatan', 'lowonganPekerjaan'));
    }
}
