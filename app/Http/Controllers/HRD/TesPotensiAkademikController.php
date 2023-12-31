<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TesPotensiAkademik;
use App\Models\LowonganPekerjaan;
use App\Models\PertanyaanTesPotensiAkademik;
use App\Models\Pelamar;
use App\Models\PelamarTesPotensiAkademik;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class TesPotensiAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data = TesPotensiAkademik::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('tes_potensi_akademiks.nama', 'like', "%$searchTerm%")->orWhere('jabatans.nama', 'like', "%$searchTerm%");
        })
            ->join('lowongan_pekerjaans', 'tes_potensi_akademiks.lowongan_pekerjaan_id', '=', 'lowongan_pekerjaans.id')
            ->join('jabatans', 'lowongan_pekerjaans.jabatan_id', '=', 'jabatans.id')
            ->select('tes_potensi_akademiks.id', 'tes_potensi_akademiks.nama as nama_tes_potensi_akademik', 'tes_potensi_akademiks.tanggal_waktu_mulai', 'tes_potensi_akademiks.tanggal_waktu_selesai', 'jabatans.nama as nama_jabatan')
            ->orderByDesc('tes_potensi_akademiks.created_at')
            ->get();

        return view('pages.HRD.tes-potensi-akademik.index', ['title' => 'Tes Potensi Akademik'], compact('searchTerm', 'data'));
    }

    // public function pelamarTes($id) {
    //     $tesPotensiAkademikId = Crypt::decrypt($id);
    //     $pelamarTes = PelamarTesPotensiAkademik::with('tesPotensiAkademik')->whereNotNull('updated_at')->get();
    //     // dd($pelamarTes);

    //     return view('pages.HRD.tes-potensi-akademik.pelamar-tes', ['title' => 'Data TPA Pelamar'], compact('pelamarTes'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lowonganPekerjaan = LowonganPekerjaan::with('jabatan')->get();

        return view('pages.HRD.tes-potensi-akademik.create', ['title' => 'Tambah Data'], compact('lowonganPekerjaan'));
    }

    public function createPertanyaan($id)
    {
        $tesPotensiAkademikId = Crypt::decrypt($id);
        $pertanyaanTesPotensiAkademik = PertanyaanTesPotensiAkademik::where('tes_potensi_akademik_id', $tesPotensiAkademikId)->get();

        return view('pages.HRD.tes-potensi-akademik.pertanyaan', ['title' => 'Pertanyaan TPA'], compact('tesPotensiAkademikId', 'pertanyaanTesPotensiAkademik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal_waktu_mulai_tes = \Carbon\Carbon::createFromFormat('d-m-Y / H:i', $request->tanggal_waktu_mulai)->format('Y-m-d H:i:s');
        $tanggal_waktu_selesai_tes = \Carbon\Carbon::createFromFormat('d-m-Y / H:i', $request->tanggal_waktu_selesai)->format('Y-m-d H:i:s');
        $lowonganPekerjaanId = $request->input('lowongan_pekerjaan_id');

        $tesPotensiAkademik = new TesPotensiAkademik();
        $tesPotensiAkademik->nama = $request->nama;
        $tesPotensiAkademik->lowongan_pekerjaan_id = $lowonganPekerjaanId;
        $tesPotensiAkademik->tanggal_waktu_mulai = $tanggal_waktu_mulai_tes;
        $tesPotensiAkademik->tanggal_waktu_selesai = $tanggal_waktu_selesai_tes;

        $tesPotensiAkademik->save();

        $tpa_id = $tesPotensiAkademik->getKey();
        $pelamars = Pelamar::where('lowongan_pekerjaan_id', $lowonganPekerjaanId)->where('status_lamaran', 'Tahap Tes Potensi Akademik')->get();

        foreach ($pelamars as $pelamar) {
            $pelamarTPA = new PelamarTesPotensiAkademik();
            $pelamarTPA->pelamar_id = $pelamar->id;
            $pelamarTPA->tes_potensi_akademik_id = $tpa_id;
            $pelamarTPA->updated_at = null;

            $pelamarTPA->save();
        }

        return redirect('/tes-potensi-akademik');
    }

    public function storePertanyaan(Request $request, $id)
    {
        $pertanyaanTesPotensiAkademik = new PertanyaanTesPotensiAkademik();

        $pertanyaanTesPotensiAkademik->tes_potensi_akademik_id = $request->tes_potensi_akademik_id;

        if ($request->input('pertanyaan')) {
            $pertanyaanTesPotensiAkademik->pertanyaan = $request->pertanyaan;
        } elseif ($request->file('file_input_pertanyaan')) {
            $file = $request->file('file_input_pertanyaan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file-pertanyaan'), $fileName);
            $pertanyaanTesPotensiAkademik->file_input_pertanyaan = $fileName;
        }

        if ($request->input('pilihan_a')) {
            $pertanyaanTesPotensiAkademik->pilihan_a = $request->pilihan_a;
        } elseif ($request->file('file_input_pilihan_a')) {
            $file = $request->file('file_input_pilihan_a');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file-pertanyaan'), $fileName);
            $pertanyaanTesPotensiAkademik->file_input_pilihan_a = $fileName;
        }

        if ($request->input('pilihan_b')) {
            $pertanyaanTesPotensiAkademik->pilihan_b = $request->pilihan_b;
        } elseif ($request->file('file_input_pilihan_b')) {
            $file = $request->file('file_input_pilihan_b');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file-pertanyaan'), $fileName);
            $pertanyaanTesPotensiAkademik->file_input_pilihan_b = $fileName;
        }

        if ($request->input('pilihan_c')) {
            $pertanyaanTesPotensiAkademik->pilihan_c = $request->pilihan_c;
        } elseif ($request->file('file_input_pilihan_c')) {
            $file = $request->file('file_input_pilihan_c');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file-pertanyaan'), $fileName);
            $pertanyaanTesPotensiAkademik->file_input_pilihan_c = $fileName;
        }

        if ($request->input('pilihan_d')) {
            $pertanyaanTesPotensiAkademik->pilihan_d = $request->pilihan_d;
        } elseif ($request->file('file_input_pilihan_d')) {
            $file = $request->file('file_input_pilihan_d');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file-pertanyaan'), $fileName);
            $pertanyaanTesPotensiAkademik->file_input_pilihan_d = $fileName;
        }

        $pertanyaanTesPotensiAkademik->jawaban = $request->jawaban;

        $pertanyaanTesPotensiAkademik->save();

        $totalPertanyaan = $pertanyaanTesPotensiAkademik->where('tes_potensi_akademik_id', $id)->count();

        PelamarTesPotensiAkademik::where('tes_potensi_akademik_id', $id)
            ->update([
                'total_pertanyaan' => $totalPertanyaan,
                'updated_at' => null,
            ]);
        $tesPotensiAkademikId = Crypt::encrypt($id);

        return redirect()->route('tes-potensi-akademik-create-pertanyaan', $tesPotensiAkademikId);
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
        $tesPotensiAkademikIdDecrypt = Crypt::decrypt($id);
        $tesPotensiAkademik = TesPotensiAkademik::findOrFail($tesPotensiAkademikIdDecrypt);
        $lowonganPekerjaan = LowonganPekerjaan::with('jabatan')->get();

        return view('pages.HRD.tes-potensi-akademik.edit', ['title' => 'Edit Data'], compact('lowonganPekerjaan', 'tesPotensiAkademik'));
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
        $tanggal_waktu_mulai_tes = \Carbon\Carbon::createFromFormat('d-m-Y / H:i', $request->tanggal_waktu_mulai)->format('Y-m-d H:i:s');
        $tanggal_waktu_selesai_tes = \Carbon\Carbon::createFromFormat('d-m-Y / H:i', $request->tanggal_waktu_selesai)->format('Y-m-d H:i:s');

        $tesPotensiAkademik = TesPotensiAkademik::findOrFail($id);

        $tesPotensiAkademik->nama = $request->nama;
        $tesPotensiAkademik->lowongan_pekerjaan_id = $request->lowongan_pekerjaan_id;
        $tesPotensiAkademik->tanggal_waktu_mulai = $tanggal_waktu_mulai_tes;
        $tesPotensiAkademik->tanggal_waktu_selesai = $tanggal_waktu_selesai_tes;

        $tesPotensiAkademik->save();

        return redirect('/tes-potensi-akademik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tesPotensiAkademik = TesPotensiAkademik::findOrFail($id);

        $tesPotensiAkademik->delete();

        return redirect('/tes-potensi-akademik');
    }

    public function destroyPertanyaan($tesPotensiAkademikId, $pertanyaanTesPotensiAkademikId)
    {
        PelamarTesPotensiAkademik::where('tes_potensi_akademik_id', $tesPotensiAkademikId)->decrement('total_pertanyaan');

        $pertanyaan = PertanyaanTesPotensiAkademik::where('tes_potensi_akademik_id', $tesPotensiAkademikId)
            ->where('id', $pertanyaanTesPotensiAkademikId)
            ->first();

        if ($pertanyaan) {
            File::delete(public_path('file-pertanyaan/' . $pertanyaan->file_input_pertanyaan));
            File::delete(public_path('file-pertanyaan/' . $pertanyaan->file_input_pilihan_a));
            File::delete(public_path('file-pertanyaan/' . $pertanyaan->file_input_pilihan_b));
            File::delete(public_path('file-pertanyaan/' . $pertanyaan->file_input_pilihan_c));
            File::delete(public_path('file-pertanyaan/' . $pertanyaan->file_input_pilihan_d));
        }

        $pertanyaan->delete();

        $tesPotensiAkademikIdEncrypt = Crypt::encrypt($tesPotensiAkademikId);
        return redirect()->route('tes-potensi-akademik-create-pertanyaan', $tesPotensiAkademikIdEncrypt);
    }
}
