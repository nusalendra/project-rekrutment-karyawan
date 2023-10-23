<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Crypt;
use App\Models\LowonganPekerjaan;
use Carbon\Carbon;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\HasilValidasi;

class PelamarDiterimaController extends Controller
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

        $pelamar = Pelamar::with('user', 'lowonganPekerjaan')->where('status_lamaran', 'Diterima')->get();

        return view('pages.HRD.pelamar-diterima.index', ['title' => 'Pelamar Diterima'], compact('data', 'tanggalSekarang', 'pelamar', 'searchTerm'));
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
        $data = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Diterima')->get();

        return view('pages.HRD.pelamar-diterima.show', ['title' => 'Pelamar Diterima'], compact('data', 'lowonganPekerjaanIdDecrypt'));
    }

    public function validasi($lowonganPekerjaanId)
    {
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)->where('status_lamaran', 'Diterima')->get();

        foreach ($pelamars as $pelamar) {
            $penilaians = Penilaian::where('pelamar_id', $pelamar->id)->get();

            // Inisialisasi array untuk setiap pelamar
            $skorPengukuranPelamar = [];

            foreach ($penilaians as $penilaian) {
                // Ambil tipe kriteria dari tabel kriteria
                $tipeKriteria = $penilaian->kriteria->tipe;

                $skorPengukuran = $penilaian->pengukuran->skor;

                // Inisialisasi subarray jika belum ada untuk tipe kriteria ini
                if (!isset($skorPengukuranPelamar[$tipeKriteria])) {
                    $skorPengukuranPelamar[$tipeKriteria] = [];
                }

                // Simpan nilai subkriteria dalam struktur data yang sesuai
                $skorPengukuranPelamar[$tipeKriteria][] = $skorPengukuran;
            }

            // Iterasi kembali untuk menghitung nilai normalisasi dan menyimpannya
            foreach ($penilaians as $penilaian) {
                $tipeKriteria = $penilaian->kriteria->tipe;
                $skorPengukuran = $penilaian->pengukuran->skor;

                // Hitung nilai maksimum (max) untuk tipe kriteria "Benefit"
                if ($tipeKriteria == 'Benefit') {
                    $maxValue = max($skorPengukuranPelamar[$tipeKriteria]);
                    $nilaiNormalisasi = $skorPengukuran / $maxValue;
                }
                // Hitung nilai minimum (min) untuk tipe kriteria "Cost"
                elseif ($tipeKriteria == 'Cost') {
                    $minValue = min($skorPengukuranPelamar[$tipeKriteria]);
                    $nilaiNormalisasi = $minValue / $skorPengukuran;
                }

                // Simpan nilai normalisasi kembali ke dalam tabel Penilaian
                $penilaian->nilai_normalisasi = $nilaiNormalisasi;
                $penilaian->save();
            }

            // Menghitung Hasil Penilaian
            $bobotKriteria = Kriteria::pluck('bobot', 'nama');

            $totalNilai = 0;

            foreach ($bobotKriteria as $kriteriaNama => $bobot) {
                $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                // Mengambil nilai normalisasi dari tabel penilaian jika ada
                $penilaian = $pelamar->penilaian->where('kriteria_id', $kriteria->id)->first();

                if ($penilaian) {
                    // Jika ada penilaian, maka ambil nilai normalisasi
                    $nilaiKriteria = $penilaian->nilai_normalisasi;

                    // Mengalikan nilai normalisasi dengan bobot kriteria
                    $totalNilai += $nilaiKriteria * $bobot;
                }
            }

            $hasilValidasi = new HasilValidasi();

            $hasilValidasi->pelamar_id = $pelamar->id;
            $hasilValidasi->hasil_penilaian = $totalNilai;

            $hasilValidasi->save();

            $pelamar->status_lamaran = 'Divalidasi';
            $pelamar->save();
        }

        return redirect()->route('pelamar-diterima-data', $lowonganPekerjaanId);
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

        // $lowonganPekerjaanIdDecrypt = Crypt::decrypt($lowonganPekerjaanId);

        $dataPenilaian = $data->penilaian;
        $dataDokumenPendukung = $data->dokumenPendukung;

        return view('pages.HRD.pelamar-diterima.edit', ['title' => 'Detail Pelamar'], compact('data', 'dataPenilaian', 'pelamarId', 'lowonganPekerjaanId', 'dataDokumenPendukung'));
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
