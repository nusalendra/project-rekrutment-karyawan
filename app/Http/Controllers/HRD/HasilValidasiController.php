<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\LowonganPekerjaan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Crypt;

class HasilValidasiController extends Controller
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
            ->simplePaginate(6);

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Divalidasi')->get();

        return view('pages.HRD.hasil-validasi.index', ['title' => 'Hasil Validasi Pelamar'], compact('data', 'pelamar', 'searchTerm'));
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
        $data = Pelamar::select('pelamars.id', 'pelamars.status_lamaran', 'users.name as nama_user', 'hasil_validasis.hasil_penilaian')
            ->join('hasil_validasis', 'pelamars.id', 'hasil_validasis.pelamar_id')
            ->join('lowongan_pekerjaans', 'pelamars.lowongan_pekerjaan_id', 'lowongan_pekerjaans.id')
            ->join('users', 'pelamars.user_id', 'users.id')
            ->where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
            ->where('status_lamaran', 'Divalidasi')
            ->orderByDesc('hasil_validasis.hasil_penilaian')
            ->orderBy('pelamars.updated_at') // Tambahkan ini untuk mengurutkannya berdasarkan updated_at jika skor sama
            ->get();

        return view('pages.HRD.hasil-validasi.show', ['title' => 'Hasil Validasi Pelamar'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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

        $dataPenilaian = $data->penilaian;
        $dataDokumenPendukung = $data->dokumenPendukung;

        return view('pages.HRD.hasil-validasi.edit', ['title' => 'Detail Pelamar'], compact('data', 'pelamarId', 'lowonganPekerjaanId', 'dataPenilaian', 'dataDokumenPendukung'));
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

    public function kirimNotifikasi(Request $request, $lowonganPekerjaanId)
    {
        $pilihPelamar = $request->input('pilihPelamar', []);

        foreach ($pilihPelamar as $pelamarId) {
            // Di sini Anda dapat menggunakan $pelamarId untuk mencari pelamar dan melakukan operasi yang diperlukan.
            $pelamar = Pelamar::find($pelamarId);

            if ($pelamar) {
                $pelamar->status_lamaran = 'Tahap Tes Potensi Akademik';
                $pelamar->save();

                $notifikasi = new Notifikasi();
                $notifikasi->user_id = $pelamar->user->id;
                $notifikasi->pesan = "Kami senang memberitahu Anda bahwa Lamaran Anda pada Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong> telah disetujui oleh tim HRD kami. Selamat atas pencapaian ini! Kami akan segera menghubungi Anda untuk tahap selanjutnya. Terima kasih atas minat Anda dalam perusahaan kami.";

                $notifikasi->save();
            }
        }

        return redirect()->route('hasil-validasi-data', $lowonganPekerjaanId);
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
