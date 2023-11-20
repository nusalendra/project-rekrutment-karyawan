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
                                    @foreach (json_decode($dataUser->pengalaman_kerja ?? '[]') as $pengalamanKerja)
                                        <div><label for="">{{ $pengalamanKerja }}</label></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center space-x-4">
                                <span class="font-semibold w-1/4">Pengalaman Organisasi</span>
                                <div class="w-3/4">
                                    @foreach (json_decode($dataUser->pengalaman_organisasi ?? '[]') as $pengalamanOrganisasi)
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
    <div id="popup-overlay" class="hidden fixed top-0 right-0 left-0 bottom-0 bg-black opacity-50 z-40"></div>
    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block" type="button">
    </button>

    <div id="popup-modal" tabindex="-1"
        class="flex justify-center items-center hidden overflow-y-auto overflow-x-hidden fixed top-1/2 right-0 left-1/2 z-50 transform w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Informasi yang perlu diisi untuk melamar belum lengkap. Silakan lengkapi data Anda dengan menekan
                        tombol di bawah ini.
                    </h3>
                    <a href="/profil">
                        <button data-modal-hide="popup-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">Lengkapi
                            Data</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if any data is empty
            const dataUserEmpty = {!! json_encode($dataUserEmpty) !!}; // You need to pass the data from your backend

            if (dataUserEmpty) {
                // Show the modal and overlay
                const modal = document.getElementById('popup-modal');
                const overlay = document.getElementById('popup-overlay');
                modal.classList.remove('hidden');
                overlay.classList.remove('hidden');
            }
        });
    </script>
@endsection
