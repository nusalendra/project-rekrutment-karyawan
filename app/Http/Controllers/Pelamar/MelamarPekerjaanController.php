<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Periode;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pelamar;
use App\Models\Penilaian;
use App\Models\Notifikasi;

use function Symfony\Component\String\b;

class MelamarPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $data = LowonganPekerjaan::when($searchTerm, function ($query, $searchTerm) {
            return $query->orWhere('nama', 'like', "%$searchTerm%");
        })
            ->whereHas('periode', function ($query) {
                $query->whereDate('tanggal_mulai', '<=', now())
                    ->whereDate('tanggal_akhir', '>=', now());
            })
            ->where('kuota', '>', 0)
            ->orderByDesc('created_at')
            ->simplePaginate(10);

        $periode = Periode::all();

        return view('pages.pelamar.melamar-pekerjaan.index', ['title' => 'Lamaran Pekerjaan'], compact('data', 'searchTerm', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $lowonganPekerjaan = LowonganPekerjaan::with('jabatan', 'periode')->findOrFail($id);
        $kriteriaWithSubkriteria = Kriteria::with('subkriteria')->where('jabatan_id', $lowonganPekerjaan->jabatan->id)->get();

        return view('pages.pelamar.melamar-pekerjaan.create', ['title' => 'Data Lamaran'], compact('lowonganPekerjaan', 'kriteriaWithSubkriteria', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pelamar = new Pelamar();

        $pelamar->user_id = $request->user_id;
        $pelamar->lowongan_pekerjaan_id = $request->lowongan_pekerjaan_id;
        $pelamar->status_lamaran = "Proses";
        $pelamar->updated_at = null;

        $pelamar->save();

        // Ambil ID pelamar yang baru saja dibuat
        $pelamarId = $pelamar->getKey();

        // Ambil data kriteria dan subkriteria yang dipilih oleh pengguna dari input request
        $kriteriaData = $request->input('kriteria');

        // Lakukan iterasi melalui data kriteria yang dipilih
        foreach ($kriteriaData as $kriteriaId => $subkriteriaId) {
            $penilaian = new Penilaian();

            // Set atribut-atribut penilaian sesuai dengan data yang diterima
            $penilaian->pelamar_id = $pelamarId;
            $penilaian->periode_id = $request->periode_id;
            $penilaian->jabatan_id = $request->jabatan_id;
            $penilaian->kriteria_id = $kriteriaId;
            $penilaian->subkriteria_id = $subkriteriaId;
            $penilaian->nilai_normalisasi = 0;

            $penilaian->save();
        }

        $penilaians = Penilaian::where('pelamar_id', $pelamarId)->get();

        foreach ($penilaians as $penilaian) {
            // Ambil tipe kriteria dari tabel kriteria
            $tipeKriteria = $penilaian->kriteria->tipe;

            // Ambil nilai maksimum dan minimum dari field max dan min pada tabel Subkriteria
            $nilaiMax = $penilaian->subkriteria->max;
            $nilaiMin = $penilaian->subkriteria->min;

            // Ambil nilai penilaian dari field nilai pada tabel Penilaian
            $nilai = $penilaian->subkriteria->nilai;

            // Lakukan perhitungan nilai normalisasi sesuai dengan tipe
            if ($tipeKriteria == 'Benefit') {
                $normalisasi = $nilai / $nilaiMax;
            } elseif ($tipeKriteria == 'Cost') {
                $normalisasi = $nilai / $nilaiMin;
            }

            // Simpan nilai normalisasi kembali ke dalam tabel Penilaian
            $penilaian->nilai_normalisasi = $normalisasi;
            $penilaian->save();
        }

        $pelamar = Pelamar::findOrFail($pelamarId);
        
        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $request->user_id;
        $notifikasi->pesan = "Lamaran Pekerjaan pada Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong> telah terkirim. Kami mengapresiasi waktu yang Anda luangkan untuk melamar. Kami akan mengevaluasi setiap lamaran dengan cermat dan akan menghubungi Anda jika Anda dipilih untuk tahap berikutnya.";
        
        $notifikasi->save();

        return redirect('/beranda');
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
        $jabatan = Jabatan::findOrFail($id);

        $lowonganPekerjaan = LowonganPekerjaan::where('jabatan_id', $jabatan->id)->first();

        $user = Auth::user();
        $statusLamaran = Pelamar::where('user_id', $user->id)
            ->where('lowongan_pekerjaan_id', $lowonganPekerjaan->id)
            ->value('status_lamaran');

        return view('pages.pelamar.melamar-pekerjaan.detail-jabatan', compact('jabatan', 'lowonganPekerjaan', 'statusLamaran'));
    }
}
