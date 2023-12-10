<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganPekerjaan;
use App\Models\Periode;
use App\Models\Jabatan;
use App\Models\Pelamar;
use App\Models\Notifikasi;
use App\Models\DataUser;
use Illuminate\Support\Facades\Crypt;

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
            ->orderBy('lowongan_pekerjaans.created_at', 'asc')
            ->get();

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

        $dataUser = $user->dataUser;

        $dataUserEmpty =
            empty($dataUser->kota_tempat_lahir) ||
            empty($dataUser->tanggal_lahir) ||
            empty($dataUser->jenis_kelamin) ||
            empty($dataUser->agama) ||
            empty($dataUser->status) ||
            empty($dataUser->alamat_tinggal) ||
            empty($dataUser->pendidikan_terakhir) ||
            empty($dataUser->IPK) ||
            empty($dataUser->pengalaman_kerja) ||
            empty($dataUser->pengalaman_organisasi) ||
            empty($dataUser->nomor_handphone) ||
            empty($dataUser->sosial_media) ||
            empty($dataUser->surat_lamaran_kerja) ||
            empty($dataUser->curriculum_vitae) ||
            empty($dataUser->ijazah);

        $lowonganPekerjaan = LowonganPekerjaan::with('jabatan', 'periode')->find($lowonganPekerjaanIdDecrypt);

        return view('pages.pelamar.melamar-pekerjaan.create', ['title' => 'Data Lamaran'], compact('lowonganPekerjaan', 'user', 'dataUser', 'dataUserEmpty'));
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

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $request->user_id;
        $notifikasi->pesan = "Lamaran Pekerjaan pada Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong> telah terkirim. Kami mengapresiasi waktu yang Anda luangkan untuk melamar. Kami akan mengevaluasi setiap lamaran dengan cermat dan akan menghubungi Anda jika Anda dipilih untuk tahap berikutnya.";

        $notifikasi->save();

        return redirect()->back()->with('dataSaved', true);
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

    public function downloadDokumen($dokumenName, $fileName)
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
