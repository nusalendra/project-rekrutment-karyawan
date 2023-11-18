<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\DokumenPenilaian;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\HasilValidasi;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kriteria;
use App\Models\Notifikasi;
use App\Models\Jabatan;
use App\Models\LowonganPekerjaan;
use App\Models\Pengukuran;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use Carbon\Carbon;

class ProsesSeleksiController extends Controller
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

        $tanggal = Carbon::now();
        $tanggalSekarang = $tanggal->format('Y-m-d');

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Proses')->get();

        return view('pages.HRD.proses-seleksi.index', ['title' => 'Proses Seleksi'], compact('data', 'tanggalSekarang', 'pelamar', 'searchTerm'));
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
        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Proses')->get();

        return view('pages.HRD.proses-seleksi.show', ['title' => 'Antrian Pelamar'], compact('data', 'lowonganPekerjaanIdDecrypt'));
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
        // dd($pelamarIdDecrypt);
        $data = Pelamar::with('user')->findOrFail($pelamarIdDecrypt);

        $dataUser = $data->user->dataUser;

        $dataPenilaian = $data->penilaian;

        $lowonganIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $lowonganPekerjaan = LowonganPekerjaan::find($lowonganIdDecrypt);
        // dd($lowonganPekerjaan);

        $jabatanId = $lowonganPekerjaan->jabatan_id;
        $jabatan = Jabatan::find($jabatanId);

        $kriteria = Kriteria::where('jabatan_id', $jabatan->id)->get();

        $subkriteria = collect();

        foreach ($kriteria as $item) {
            $subkriteria = $subkriteria->concat($item->subkriteria);
        }

        $subkriteriaIds = $subkriteria->pluck('id')->all();

        $pengukuran = Pengukuran::whereIn('subkriteria_id', $subkriteriaIds)->get();

        // $pengukuran = Pengukuran::where('jabatan_id', $jabatan->id)->where('kriteria_id', $kriteria->id)->where('subkriteria_id', $subkriteria->id)->first();
        return view('pages.HRD.proses-seleksi.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId', 'lowonganPekerjaan', 'dataUser', 'subkriteria', 'pengukuran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lowonganPekerjaanId)
    {
        $statusLamaran = $request->input('status_lamaran');

        if ($statusLamaran === 'Diterima') {
            $this->lamaranDiterima($request);
        } elseif ($statusLamaran === 'Ditolak') {
            $this->lamaranDitolak($request);
        }
        return redirect()->route('proses-seleksi-data', $lowonganPekerjaanId);
    }

    public function lamaranDiterima(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian', 'lowonganPekerjaan')->findOrFail($pelamarId);

        $dataPelamar->status_lamaran = 'Diterima';

        $dataPelamar->save();

        $pengukuranId = $request->input('pengukuran_id');
        $periode = $request->input('periode_id');
        $jabatan = $request->input('jabatan_id');

        foreach ($pengukuranId as $id) {
            // Dapatkan kriteria dan subkriteria berdasarkan $id
            $kriteria = Pengukuran::where('id', $id)->value('kriteria_id');
            $subkriteria = Pengukuran::where('id', $id)->value('subkriteria_id');

            // Simpan data ke tabel Penilaian
            $penilaian = new Penilaian();
            $penilaian->pelamar_id = $pelamarId;
            $penilaian->periode_id = $periode;
            $penilaian->jabatan_id = $jabatan;
            $penilaian->kriteria_id = $kriteria;
            $penilaian->subkriteria_id = $subkriteria;
            $penilaian->pengukuran_id = $id;
            $penilaian->nilai_normalisasi = 0;

            $penilaian->save();
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $dataPelamar->user->id;
        $notifikasi->pesan = "Kami ingin memberitahu anda bahwa lamaran anda pada Posisi <strong>" . $dataPelamar->lowonganPekerjaan->jabatan->nama . "</strong> telah diterima oleh HRD. Kami akan segera menghubungi anda untuk memberikan informasi lebih lanjut tentang tahapan selanjutnya dalam proses rekrutmen kami.";

        $notifikasi->save();
    }

    public function lamaranDitolak(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $dataPelamar = Pelamar::with('penilaian')->findOrFail($pelamarId);

        $dataPelamar->status_lamaran = 'Ditolak';

        $dataPelamar->save();

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $dataPelamar->user->id;
        $notifikasi->pesan = "Kami ingin memberitahu Anda bahwa kami telah menyelesaikan proses seleksi kami, dan kami menentukan bahwa saat ini kami menolak Lamaran Anda pada Posisi <strong>" . $dataPelamar->lowonganPekerjaan->jabatan->nama . "</strong>. Kami menghargai waktu dan usaha yang telah Anda habiskan dalam melamar di perusahaan kami. Terima kasih atas minat Anda dan kami mendoakan Anda sukses dalam pencarian karier berikutnya.";

        $notifikasi->save();
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
