@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white mt-2 rounded shadow-md overflow-y-auto max-h-[800px]">
            <div class="px-11 py-9 text-black">
                <form class="mt-4" action="/lamar/{{ $lowonganPekerjaan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="lowongan_pekerjaan_id" value="{{ $lowonganPekerjaan->id }}">
                    <input type="hidden" name="periode_id" value="{{ $lowonganPekerjaan->periode->id }}">
                    <input type="hidden" name="jabatan_id" value="{{ $lowonganPekerjaan->jabatan->id }}">

                    <h1 class="text-2xl font-semibold mb-4">Data Diri Pelamar</h1>
                    <div class="w-full space-y-4 mb-6 px-6">
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Nama Lengkap</span>
                            <label for="" class="w-3/4">{{ $user->name }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Tempat Lahir</span>
                            <label for="" class="w-3/4">{{ $dataUser->kota_tempat_lahir }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            @php
                                $tanggalLahir = \Carbon\Carbon::parse($dataUser->tanggal_lahir)->format('d-m-Y');
                            @endphp
                            <span class="font-semibold w-1/4">Tanggal Lahir</span>
                            <label for="" class="w-3/4">{{ $tanggalLahir }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Jenis Kelamin</span>
                            <label for="" class="w-3/4">{{ $dataUser->jenis_kelamin }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Agama</span>
                            <label for="" class="w-3/4">{{ $dataUser->agama }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Status</span>
                            <label for="" class="w-3/4">{{ $dataUser->status }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Alamat Tinggal</span>
                            <label for="" class="w-3/4">{{ $dataUser->alamat_tinggal }}</label>
                        </div>
                    </div>

                    <h1 class="text-2xl font-semibold mb-4">Riwayat Pendidikan dan Pengalaman</h1>
                    <div class="w-full space-y-4 mb-6 px-6">
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Pendidikan Terakhir</span>
                            <label for="" class="w-3/4">{{ $dataUser->pendidikan_terakhir }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">IPK</span>
                            <label for="" class="w-3/4">{{ $dataUser->IPK }}</label>
                        </div>
                        <div>
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold w-1/4">Pengalaman Kerja</span>
                                <div class="w-3/4">
                                    @foreach (json_decode($dataUser->pengalaman_kerja) as $pengalamanKerja)
                                        <div><label for="">{{ $pengalamanKerja }}</label></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold w-1/4">Pengalaman Organisasi</span>
                                <div class="w-3/4">
                                    @foreach (json_decode($dataUser->pengalaman_organisasi) as $pengalamanOrganisasi)
                                        <div><label for="">{{ $pengalamanOrganisasi }}</label></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="text-2xl font-semibold mb-4">Kontak Pelamar</h1>
                    <div class="w-full space-y-4 mb-6 px-6">
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Nomor Handphone</span>
                            <label for="" class="w-3/4">{{ $dataUser->nomor_handphone }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Alamat Email</span>
                            <label for="" class="w-3/4">{{ $user->email }}</label>
                        </div>
                        <h1 class="font-semibold w-1/4">Sosial Media</h1>
                        @if (!empty($dataUser) && is_array($sosialMediaArray = json_decode($dataUser->sosial_media, true)))
                            @if (count($sosialMediaArray) > 0)
                                <div class="flex items-center space-x-4">
                                    <span class="w-1/4">Linkedin</span>
                                    <a href="{{ $sosialMediaArray[0] }}" target="_blank">{{ $sosialMediaArray[0] }}</a>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="w-1/4">Instagram</span>
                                    <a href="{{ $sosialMediaArray[1] }}" target="_blank">{{ $sosialMediaArray[1] }}</a>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="w-1/4">Twitter</span>
                                    <a href="{{ $sosialMediaArray[2] }}" target="_blank">{{ $sosialMediaArray[2] }}</a>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="w-1/4">Blog</span>
                                    <a href="{{ $sosialMediaArray[3] }}" target="_blank">{{ $sosialMediaArray[3] }}</a>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="w-1/4">Github</span>
                                    <a href="{{ $sosialMediaArray[4] }}" target="_blank">{{ $sosialMediaArray[4] }}</a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <h1 class="text-2xl font-semibold mb-4">Dokumen Pelamar</h1>
                    <div class="w-full space-y-4 mb-6 px-6">
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Curriculum Vitae</span>
                            <label for="" class="w-3/4">{{ $dataUser->curriculum_vitae }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Ijazah</span>
                            <label for="" class="w-3/4">{{ $dataUser->ijazah }}</label>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="font-semibold w-1/4">Surat Lamaran Kerja</span>
                            <label for="" class="w-3/4">{{ $dataUser->surat_lamaran_kerja }}</label>
                        </div>
                    </div>
                    <div class="flex mt-6">
                        <a href="/melamar-pekerjaan"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>
                        <button type="submit"
                            class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kirim
                            Lamaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
