<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Periode;
use App\Models\Jabatan;
use App\Models\Kriteria;
use App\Models\Pelamar;
use App\Models\Penilaian;
use App\Models\Notifikasi;
use App\Models\Pengukuran;
use App\Models\Subkriteria;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

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

        $data = LowonganPekerjaan::join('jabatans', 'lowongan_pekerjaans.jabatan_id', '=', 'jabatans.id')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->orWhere('jabatans.nama', 'like', "%$searchTerm%");
            })
            ->where('lowongan_pekerjaans.kuota', '>', 0)
            ->orderByDesc('lowongan_pekerjaans.created_at')
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
        $lowonganPekerjaanIdDecrypt = Crypt::decrypt($id);

        $user = Auth::user();
        $lowonganPekerjaan = LowonganPekerjaan::with('jabatan', 'periode')->find($lowonganPekerjaanIdDecrypt);
        $kriteriaWithSubkriteria = Kriteria::with('subkriteria')->where('jabatan_id', $lowonganPekerjaan->jabatan->id)->get();

        $subkriteria = Subkriteria::with('pengukuran')->where('jabatan_id', $lowonganPekerjaan->jabatan->id)->get();
        // dd($subkriteria);
        return view('pages.pelamar.melamar-pekerjaan.create', ['title' => 'Data Lamaran'], compact('lowonganPekerjaan', 'kriteriaWithSubkriteria', 'user', 'subkriteria'));
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

        $lowonganPekerjaan = LowonganPekerjaan::findOrFail($request->lowongan_pekerjaan_id);
        $lowonganPekerjaan->kuota -= 1;

        $lowonganPekerjaan->save();

        // Ambil ID pelamar yang baru saja dibuat
        $pelamarId = $pelamar->getKey();

        $pelamar = Pelamar::findOrFail($pelamarId);

        $pengukuranData = $request->input('pengukuran_id');

        foreach ($pengukuranData as $kriteriaId => $subkriteriaValues) {
            foreach ($subkriteriaValues as $subkriteriaId => $selectedPengukuran) {
                $penilaian = new Penilaian();

                // Set atribut-atribut penilaian sesuai dengan data yang diterima
                $penilaian->pelamar_id = $pelamarId;
                $penilaian->periode_id = $request->periode_id;
                $penilaian->jabatan_id = $request->jabatan_id;
                $penilaian->kriteria_id = $kriteriaId;
                $penilaian->subkriteria_id = $subkriteriaId;
                $penilaian->pengukuran_id = $selectedPengukuran;
                $penilaian->nilai_normalisasi = 0;
                $penilaian->save();

                $filesByKriteria = $request->file('dokumen');

                if (!empty($filesByKriteria[$kriteriaId][$subkriteriaId])) {
                    $dokumenFiles = $filesByKriteria[$kriteriaId][$subkriteriaId];

                    foreach ($dokumenFiles as $singleFile) {
                        $validator = Validator::make(['file' => $singleFile], [
                            'file' => 'mimes:pdf|max:5120',
                        ]);

                        if ($validator->fails()) {
                            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
                        }

                        $dokumenPendukung = new DokumenPendukung();
                        $dokumenPendukung->pelamar_id = $pelamarId;
                        $dokumenPendukung->jabatan_id = $request->jabatan_id;
                        $dokumenPendukung->kriteria_id = $kriteriaId;
                        $dokumenPendukung->subkriteria_id = $subkriteriaId;

                        $namaPeserta = $pelamar->user->name;
                        $subkriteria = Subkriteria::find($subkriteriaId);
                        $subkriteriaName = str_replace(' ', '_', $subkriteria->nama);
                        $fileName = $subkriteriaName . '.pdf';

                        $filePath = $singleFile->move(public_path("dokumen-pendukung/{$namaPeserta}"), $fileName);
                        $dokumenPendukung->dokumen = $fileName;

                        $dokumenPendukung->save();
                    }
                }
            }
        }


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
        $jabatanIdDecrypt = Crypt::decrypt($id);
        $jabatan = Jabatan::findOrFail($jabatanIdDecrypt);

        $lowonganPekerjaan = LowonganPekerjaan::where('jabatan_id', $jabatan->id)->first();

        $user = Auth::user();
        $statusLamaran = Pelamar::where('user_id', $user->id)
            ->where('lowongan_pekerjaan_id', $lowonganPekerjaan->id)
            ->value('status_lamaran');

        return view('pages.pelamar.melamar-pekerjaan.detail-jabatan', compact('jabatan', 'lowonganPekerjaan', 'statusLamaran'));
    }
}
