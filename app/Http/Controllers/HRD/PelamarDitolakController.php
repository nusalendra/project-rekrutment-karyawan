<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Models\LowonganPekerjaan;
use Carbon\Carbon;

class PelamarDitolakController extends Controller
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
            ->simplePaginate(10);

        $tanggal = Carbon::now();
        $tanggalSekarang = $tanggal->format('Y-m-d');

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Proses')->get();


        return view('pages.HRD.pelamar-ditolak.index', ['title' => 'Pelamar Ditolak'], compact('data', 'tanggalSekarang', 'pelamar', 'searchTerm'));
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
        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Ditolak')->get();

        return view('pages.HRD.pelamar-ditolak.show', ['title' => 'Pelamar Ditolak'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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
        $data = Pelamar::with('user')->findOrFail($pelamarIdDecrypt);

        $dataPenilaian = $data->penilaian;
        $dataDokumenPendukung = $data->dokumenPendukung;

        return view('pages.HRD.pelamar-ditolak.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId', 'dataDokumenPendukung'));
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

    public function download($filename, $pelamarName)
    {
        // Tentukan path lengkap file gambar
        $filePath = public_path('dokumen-pendukung/' . $pelamarName . '/' . $filename);

        // Pastikan file ada sebelum menginisialisasi unduhan
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }

    public function downloadDokumenPelamar($dokumenName, $fileName)
    {

        $filePath = public_path('dokumen-peserta/Dokumen_' . $dokumenName . '/' . $fileName);

        // Pastikan file ada sebelum menginisialisasi unduhan
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }
}
