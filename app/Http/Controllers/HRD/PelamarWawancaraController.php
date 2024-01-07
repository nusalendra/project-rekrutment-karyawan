<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use App\Models\Pelamar;
use App\Models\Notifikasi;
use App\Models\SkorTesPelamar;
use Illuminate\Support\Facades\Crypt;

class PelamarWawancaraController extends Controller
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

        return view('pages.HRD.pelamar-wawancara.index', ['title' => 'Pelamar Wawancara'], compact('data', 'pelamar', 'searchTerm'));
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

        $data = Pelamar::select('pelamars.*', 'users.name as nama_user', 'skor_tes_pelamars.skor_tes', 'users.email', 'data_users.nomor_handphone')
            ->join('skor_tes_pelamars', 'pelamars.id', 'skor_tes_pelamars.pelamar_id')
            ->join('lowongan_pekerjaans', 'pelamars.lowongan_pekerjaan_id', 'lowongan_pekerjaans.id')
            ->join('users', 'pelamars.user_id', 'users.id')
            ->join('data_users', 'data_users.user_id', 'users.id')
            ->where(function ($query) use ($lowonganPekerjaanIdDecrypt) {
                $query->where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
                    ->where('pelamars.status_lamaran', 'Tahap Pengoreksian Tes Potensi Akademik');
            })
            ->orWhere(function ($query) use ($lowonganPekerjaanIdDecrypt) {
                $query->where('lowongan_pekerjaan_id', $lowonganPekerjaanIdDecrypt)
                    ->where('pelamars.status_lamaran', 'Tahap Wawancara');
            })
            ->orderByDesc('skor_tes_pelamars.skor_tes')
            ->orderBy('pelamars.updated_at')
            ->get();

        // dd($data);

        return view('pages.HRD.pelamar-wawancara.show', ['title' => 'Pelamar Wawancara'], compact('data', 'lowonganPekerjaanIdDecrypt'));
    }

    public function kirimNotifikasi(Request $request, $lowonganPekerjaanId)
    {
        $pilihPelamar = $request->input('pilihPelamar', []);

        foreach ($pilihPelamar as $pelamarId) {
            $pelamar = Pelamar::find($pelamarId);

            $skorTes = SkorTesPelamar::where('pelamar_id', $pelamar->id)->first();

            if ($pelamar) {
                $pelamar->status_lamaran = 'Tahap Wawancara';
                $pelamar->save();

                $notifikasi = new Notifikasi();
                $notifikasi->user_id = $pelamar->user->id;
                $notifikasi->pesan = "Berkaitan dengan proses seleksi penerimaan karyawan baru, kami ingin memberikan informasi mengenai hasil tes potensi akademik Anda untuk Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong> dengan Total <strong>" . $skorTes->skor_tes . "</strong> Skor yang diperoleh. Dengan senang hati, kami ingin menyampaikan bahwa Anda telah berhasil melewati tahap ini. <br><br>Terima kasih atas dedikasi dan partisipasi Anda dalam proses seleksi ini. Langkah berikutnya, kami mengundang Anda untuk mengikuti tahap <strong>Tes Wawancara</strong>. Mohon bersiap dengan sebaik mungkin untuk menghadapi tahap selanjutnya. <br><br>Detail lebih lanjut mengenai jadwal dan prosedur tes wawancara akan kami beritahukan segera dan mohon tunggu tim HRD kami akan menghubungi Anda secepatnya.";

                $notifikasi->save();
            }
        }

        return redirect()->route('pelamar-wawancara-data', $lowonganPekerjaanId);
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

        return view('pages.HRD.pelamar-wawancara.edit', ['title' => 'Detail Pelamar'], compact('data', 'pelamarId', 'lowonganPekerjaanId', 'dataUser'));
    }

    public function downloadDokumenPelamarWawancara($dokumenName, $fileName)
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
    public function update(Request $request, $lowonganPekerjaanId)
    {
        $statusLamaran = $request->input('status_lamaran');

        if ($statusLamaran === 'Pelamar Disetujui') {
            $this->pelamarDisetujui($request);
        } elseif ($statusLamaran === 'Tahap Wawancara Ditolak') {
            $this->pelamarDitolak($request);
        }
        return redirect()->route('pelamar-wawancara-data', $lowonganPekerjaanId);
    }

    public function pelamarDisetujui(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $pelamar = Pelamar::findOrFail($pelamarId);
        $pelamar->status_lamaran = 'Pelamar Disetujui';

        $pelamar->save();

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $pelamar->user->id;
        $notifikasi->pesan = "Dengan senang hati, kami ingin memberitahu Anda bahwa Anda berhasil melewati tahap wawancara. Setelah dipertimbangkan oleh tim HRD, dengan senang hati kami umumkan bahwa Anda telah mendapatkan persetujuan untuk menduduki Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong>. <br><br>Kami sampaikan pula bahwa ini merupakan tahap terakhir dalam proses rekrutmen. Kami akan segera menghubungi Anda untuk memberikan informasi lebih lanjut mengenai langkah-langkah selanjutnya, termasuk penawaran resmi pekerjaan dan detail proses orientasi. <br><br>Terima kasih atas dedikasi serta antusiasme yang Anda tunjukkan sepanjang proses ini. Kami nantikan kehadiran Anda sebagai bagian dari tim kami, dan berharap dapat berkolaborasi untuk mencapai kesuksesan bersama.";

        $notifikasi->save();
    }

    public function pelamarDitolak(Request $request)
    {
        $pelamarId = $request->input('pelamar_id');
        $pelamar = Pelamar::findOrFail($pelamarId);
        $pelamar->status_lamaran = 'Tahap Wawancara Ditolak';

        $pelamar->save();

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $pelamar->user->id;
        $notifikasi->pesan = "Kami ingin menyampaikan terima kasih atas partisipasi Anda dalam proses seleksi di perusahaan kami. Setelah pertimbangan yang cermat oleh tim HRD, kami ingin memberitahu bahwa pada tahap ini, kami telah memutuskan untuk tidak melanjutkan proses rekrutmen Anda untuk Posisi <strong>" . $pelamar->lowonganPekerjaan->jabatan->nama . "</strong>. <br><br>Kami menghargai waktu dan usaha yang Anda investasikan dalam proses ini. Keputusan ini tidak bermaksud untuk merendahkan nilai atau kualifikasi Anda, melainkan berdasarkan pertimbangan terhadap kebutuhan spesifik dan kriteria yang kami tetapkan. <br><br>Kami mengucapkan terima kasih kembali atas ketertarikan Anda untuk bergabung dengan perusahaan kami, dan kami menghargai dedikasi serta profesionalisme yang Anda tunjukkan selama proses ini. Kami mengharapkan Anda akan berhasil dalam pencarian pekerjaan Anda, dan kami mendoakan kesuksesan bagi masa depan Anda.";

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
}
