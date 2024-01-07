<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\Pelamar;
use App\Models\DataUser;
use Illuminate\Support\Facades\Crypt;

class PelamarDisetujuiController extends Controller
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
            ->join('periodes', 'lowongan_pekerjaans.periode_id', '=', 'periodes.id')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('jabatans.nama', 'like', "%$searchTerm%")->orWhere('periodes.nama', 'like', "%$searchTerm%");
            })
            ->orderByDesc('lowongan_pekerjaans.created_at')
            ->select('periodes.nama as nama_periode', 'lowongan_pekerjaans.*', 'jabatans.nama as nama_jabatan')
            ->get();

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Divalidasi')->get();

        return view('pages.HRD.pelamar-disetujui.index', ['title' => 'Pelamar Disetujui'], compact('data', 'pelamar', 'searchTerm'));
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
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($id);
        $data = Pelamar::select('pelamars.id', 'pelamars.status_lamaran', 'users.name as nama_user', 'skor_tes_pelamars.skor_tes', 'users.email', 'data_users.nomor_handphone')
            ->join('skor_tes_pelamars', 'pelamars.id', 'skor_tes_pelamars.pelamar_id')
            ->join('lowongan_pekerjaans', 'pelamars.lowongan_pekerjaan_id', 'lowongan_pekerjaans.id')
            ->join('users', 'pelamars.user_id', 'users.id')
            ->join('data_users', 'data_users.user_id', 'users.id')
            ->where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
            ->where('pelamars.status_lamaran', 'Pelamar Disetujui')
            ->orderBy('pelamars.updated_at')
            ->get();

        return view('pages.HRD.pelamar-disetujui.show', ['title' => 'Pelamar Dusetujui'], compact('data', 'lowonganPekerjaanIdDecrypt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pelamarId, $lowonganPekerjaanId)
    {
        $pelamarIdDecrypt = Crypt::decrypt($pelamarId);
        $data = Pelamar::with('user')->find($pelamarIdDecrypt);
        $dataUser = DataUser::where('user_id', $data->user_id)->first();

        return view('pages.HRD.pelamar-disetujui.edit', ['title' => 'Detail Pelamar'], compact('data', 'pelamarId', 'lowonganPekerjaanId', 'dataUser'));
    }

    public function downloadDokumenPelamarDisetujui($dokumenName, $fileName)
    {
        $filePath = public_path('dokumen-peserta/Dokumen_' . $dokumenName . '/' . $fileName);

        // Pastikan file ada sebelum menginisialisasi unduhan
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
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
