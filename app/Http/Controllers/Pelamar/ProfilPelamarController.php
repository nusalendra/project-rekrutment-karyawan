<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
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

        $dataUser = $user->dataUser()->first();

        return view('pages.pelamar.profil.data-pribadi', ['title' => 'Data Pribadi'], compact('user', 'dataUser'));
    }

    public function updateDataPribadi(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
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

        $validatedData = $request->validate([
            'jenis_kelamin' => 'in:Laki-Laki,Perempuan',
            'agama' => 'in:Islam,Kristen Protestan,Kristen Katolik, Hindu, Budha,Khonghucu',
            'status' => 'in:Sudah Menikah,Belum Menikah'
        ]);

        $dataUser = DataUser::where('user_id', $user->id)->first();
        $tanggalLahirPelamar = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d');

        if ($dataUser) {
            $dataUser->tempat_lahir = $request->tempat_lahir;
            $dataUser->tanggal_lahir = $tanggalLahirPelamar;
            $dataUser->jenis_kelamin = $request->jenis_kelamin;
            $dataUser->agama = $request->agama;
            $dataUser->status = $request->status;
            $dataUser->alamat_domisili = $request->alamat_domisili;
            $dataUser->save();
        }

        return redirect('/profil');
    }

    public function editRiwayatPendidikanPengalaman($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);

        $dataUser = $user->dataUser()->first();

        return view('pages.pelamar.profil.riwayat-pendidikan-pengalaman', ['title' => 'Riwayat Pendidikan dan Pengalaman'], compact('user', 'dataUser'));
    }

    public function updateRiwayatPendidikanPengalaman(Request $request, $id)
    {
        $pengalamanKerja = $request->input('pengalaman_kerja');
        $pengalamanKerjaJSON = json_encode($pengalamanKerja);
        $pengalamanOrganisasi = $request->input('pengalaman_organisasi');
        $pengalamanOrganisasiJSON = json_encode($pengalamanOrganisasi);

        $user = User::findOrFail($id);

        $dataUser = DataUser::where('user_id', $user->id)->first();

        if ($dataUser) {
            $dataUser->pendidikan_terakhir = $request->pendidikan_terakhir;
            $dataUser->IPK = $request->IPK;
            $dataUser->pengalaman_kerja = $pengalamanKerjaJSON;
            $dataUser->pengalaman_organisasi = $pengalamanOrganisasiJSON;

            $dataUser->save();
        }

        return redirect('/profil');
    }

    public function editKontakPribadi($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);

        $dataUser = $user->dataUser()->first();

        return view('pages.pelamar.profil.kontak-pribadi', ['title' => 'Kontak Pribadi'], compact('user', 'dataUser'));
    }

    public function updateKontakPribadi(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->email = $request->email;

        $user->save();

        $sosialMedia = $request->input('sosial_media');
        $sosialMediaJSON = json_encode($sosialMedia);
        // dd($sosialMediaJSON);

        $dataUser = DataUser::where('user_id', $user->id)->first();

        if ($dataUser) {
            $dataUser->nomor_handphone = $request->nomor_handphone;
            $dataUser->sosial_media = $sosialMediaJSON;
            // dd($dataUser);
            $dataUser->save();
        }

        return redirect('/profil');
    }

    public function editLengkapiDokumen($id)
    {
        $userIdDecrypt = Crypt::decrypt($id);
        $user = User::findOrFail($userIdDecrypt);

        $dataUser = $user->dataUser()->first();

        return view('pages.pelamar.profil.lengkapi-dokumen', ['title' => 'Lengkapi Dokumen'], compact('user', 'dataUser'));
    }

    public function updateLengkapiDokumen(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $dataUser = DataUser::where('user_id', $user->id)->first();

        if ($dataUser) {
            $request->validate([
                'curriculum_vitae' => 'mimes:pdf|max:2048', // Maksimum 2MB
                'pas_foto' => 'image|mimes:jpg,jpeg,png|dimensions:ratio=2/3', // 4X6
                'ijazah_transkrip' => 'mimes:pdf|max:5120', // Maksimum 5MB
                'surat_lamaran_kerja' => 'mimes:pdf|max:2048', // Maksimum 2MB
            ]);

            if ($request->hasFile('curriculum_vitae')) {
                $fileCV = $request->file('curriculum_vitae');
                $fileName = 'Curriculum Vitae_' . $dataUser->user->name . '.' . $fileCV->getClientOriginalExtension();

                // Membuat direktori berdasarkan ID pengguna jika belum ada
                $userDirectory = public_path('dokumen-peserta/' . 'Dokumen' . '_' . $dataUser->user->name);
                if (!file_exists($userDirectory)) {
                    mkdir($userDirectory, 0755, true);
                }

                // Memindahkan file ke direktori yang sesuai
                $fileCV->move($userDirectory, $fileName);

                $dataUser->curriculum_vitae = $fileName;
            }

            if ($request->hasFile('pas_foto')) {
                $filePasFoto = $request->file('pas_foto');
                $fileName = 'Pas Foto_' . $dataUser->user->name . '.' . $filePasFoto->getClientOriginalExtension();

                // Membuat direktori berdasarkan ID pengguna jika belum ada
                $userDirectory = public_path('dokumen-peserta/' . 'Dokumen' . '_' . $dataUser->user->name);
                if (!file_exists($userDirectory)) {
                    mkdir($userDirectory, 0755, true);
                }

                // Memindahkan file ke direktori yang sesuai
                $filePasFoto->move($userDirectory, $fileName);

                $dataUser->pas_foto = $fileName;
            }

            if ($request->hasFile('ijazah_transkrip')) {
                $fileIjazahTranskrip = $request->file('ijazah_transkrip');
                $fileName = 'Ijazah & Transkrip_' . $dataUser->user->name . '.' . $fileIjazahTranskrip->getClientOriginalExtension();

                // Membuat direktori berdasarkan ID pengguna jika belum ada
                $userDirectory = public_path('dokumen-peserta/' . 'Dokumen' . '_' . $dataUser->user->name);
                if (!file_exists($userDirectory)) {
                    mkdir($userDirectory, 0755, true);
                }

                // Memindahkan file ke direktori yang sesuai
                $fileIjazahTranskrip->move($userDirectory, $fileName);

                $dataUser->ijazah_transkrip = $fileName;
            }

            if ($request->hasFile('surat_lamaran_kerja')) {
                $fileSuratLamaranKerja = $request->file('surat_lamaran_kerja');
                $fileName = 'Surat Lamaran Kerja_' . $dataUser->user->name . '.' . $fileSuratLamaranKerja->getClientOriginalExtension();

                // Membuat direktori berdasarkan ID pengguna jika belum ada
                $userDirectory = public_path('dokumen-peserta/' . 'Dokumen' . '_' . $dataUser->user->name);
                if (!file_exists($userDirectory)) {
                    mkdir($userDirectory, 0755, true);
                }

                // Memindahkan file ke direktori yang sesuai
                $fileSuratLamaranKerja->move($userDirectory, $fileName);

                $dataUser->surat_lamaran_kerja = $fileName;
            }

            $dataUser->save();
        }


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
