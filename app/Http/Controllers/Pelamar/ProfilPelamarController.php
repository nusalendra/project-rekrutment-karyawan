<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class ProfilPelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('pages.pelamar.profil.index', ['title' => 'Profil'], compact('user'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDataPribadi($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);

        return view('pages.pelamar.profil.data-pribadi', ['title' => 'Data Pribadi'], compact('user'));
    }

    public function updateDataPribadi(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->TTL = $request->TTL;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->agama = $request->agama;
        if ($request->file('profile_photo_path')) {
            if ($user->profile_photo_path) {
                File::delete(public_path('foto-profil/' . $user->profile_photo_path));
                // dd($user->profile_photo_path);
            }
            $file = $request->file('profile_photo_path');
            $filename = date('dmYHis') . 'FotoProfil' . $user->name . mt_rand(100000, 999999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto-profil'), $filename);
            $user->profile_photo_path = $filename;
        }
        $user->save();

        return redirect('/profil');
    }

    public function editKontakPribadi($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);

        return view('pages.pelamar.profil.kontak-pribadi', ['title' => 'Kontak Pribadi'], compact('user'));
    }

    public function updateKontakPribadi(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->nomor_handphone = $request->nomor_handphone;

        $user->save();

        return redirect('/profil');
    }

    public function editLengkapiDokumen($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);
        return view('pages.pelamar.profil.lengkapi-dokumen', ['title' => 'Lengkapi Dokumen'], compact('user'));
    }

    public function updateLengkapiDokumen(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'curriculum_vitae' => 'mimes:pdf|max:2048', // Maksimum 2MB
            'pas_foto' => 'image|mimes:jpg,jpeg,png|dimensions:ratio=2/3', // 4X6
            'ijazah_transkrip' => 'mimes:pdf|max:5120', // Maksimum 5MB
            'surat_lamaran_kerja' => 'mimes:pdf|max:2048', // Maksimum 2MB
        ]);

        if ($request->hasFile('curriculum_vitae')) {
            $fileCV = $request->file('curriculum_vitae');
            $fileName = 'Curriculum Vitae_' . $user->name . '.' . $fileCV->getClientOriginalExtension();

            // Membuat direktori berdasarkan ID pengguna jika belum ada
            $userDirectory = storage_path('app/dokumen-peserta/' . 'Dokumen' . '_' . $user->name);
            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0755, true);
            }

            // Memindahkan file ke direktori yang sesuai
            $fileCV->move($userDirectory, $fileName);

            $user->curriculum_vitae = $fileName;
        }

        if ($request->hasFile('pas_foto')) {
            $filePasFoto = $request->file('pas_foto');
            $fileName = 'Pas Foto_' . $user->name . '.' . $filePasFoto->getClientOriginalExtension();

            // Membuat direktori berdasarkan ID pengguna jika belum ada
            $userDirectory = storage_path('app/dokumen-peserta/' . 'Dokumen' . '_' . $user->name);
            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0755, true);
            }

            // Memindahkan file ke direktori yang sesuai
            $filePasFoto->move($userDirectory, $fileName);

            $user->pas_foto = $fileName;
        }

        if ($request->hasFile('ijazah_transkrip')) {
            $fileIjazahTranskrip = $request->file('ijazah_transkrip');
            $fileName = 'Ijazah & Transkrip_' . $user->name . '.' . $fileIjazahTranskrip->getClientOriginalExtension();

            // Membuat direktori berdasarkan ID pengguna jika belum ada
            $userDirectory = storage_path('app/dokumen-peserta/' . 'Dokumen' . '_' . $user->name);
            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0755, true);
            }

            // Memindahkan file ke direktori yang sesuai
            $fileIjazahTranskrip->move($userDirectory, $fileName);

            $user->ijazah_transkrip = $fileName;
        }

        if ($request->hasFile('surat_lamaran_kerja')) {
            $fileSuratLamaranKerja = $request->file('surat_lamaran_kerja');
            $fileName = 'Surat Lamaran Kerja_' . $user->name . '.' . $fileSuratLamaranKerja->getClientOriginalExtension();

            // Membuat direktori berdasarkan ID pengguna jika belum ada
            $userDirectory = storage_path('app/dokumen-peserta/' . 'Dokumen' . '_' . $user->name);
            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0755, true);
            }

            // Memindahkan file ke direktori yang sesuai
            $fileSuratLamaranKerja->move($userDirectory, $fileName);

            $user->surat_lamaran_kerja = $fileName;
        }

        $user->save();

        return redirect('/profil');
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
