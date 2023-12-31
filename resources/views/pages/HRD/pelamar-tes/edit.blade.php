@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4">
            <div
                class="flex w-full bg-green-600 pt-4 pb-2 px-4  border-b-8 border-emerald-200 text-white space-x-3 rounded-t-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="26.67" viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M528 32H48C21.5 32 0 53.5 0 80v16h576V80c0-26.5-21.5-48-48-48zM0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V128H0v304zm352-232c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zM176 192c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64zM67.1 396.2C75.5 370.5 99.6 352 128 352h8.2c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h8.2c28.4 0 52.5 18.5 60.9 44.2c3.2 9.9-5.2 19.8-15.6 19.8H82.7c-10.4 0-18.8-10-15.6-19.8z" />
                </svg>
                <h1 class="text-lg font-bold">Data Diri Pelamar</h1>
            </div>
            <div class="bg-white px-4 py-4 shadow">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1 space-y-0.5 font-semibold">
                        <div class="flex w-full h-16">
                            <label for="nama" class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Nama
                                Pelamar</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $data->user->name }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="kota_tempat_lahir" class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Tempat,
                                Tanggal Lahir</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $data->user->TTL }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="alamat"
                                class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Alamat</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $data->user->alamat }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="jenis_kelamin" class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Jenis
                                Kelamin</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $data->user->jenis_kelamin }}</p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="agama"
                                class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Agama</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $data->user->agama }}</p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="nomor_handphone" class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Nomor
                                Handphone</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $data->user->nomor_handphone }}</p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="curriculum_vitae"
                                class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Curriculum Vitae</label>
                            <div class="flex items-center pl-3 mt-2">
                                <a href="{{ route('unduh-dokumen-pelamar-diterima', ['dokumenName' => basename($data->user->name), 'fileName' => $data->user->curriculum_vitae]) }}"
                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                        viewBox="0 0 17 17">
                                        <path
                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                    </svg>
                                    <h1 class="text-white">Unduh Dokumen</h1>
                                </a>
                            </div>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="pas_foto" class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Pas
                                Foto</label>
                            <div class="flex items-center pl-3 mt-2">
                                <a href="{{ route('unduh-dokumen-pelamar-diterima', ['dokumenName' => basename($data->user->name), 'fileName' => $data->user->pas_foto]) }}"
                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                        viewBox="0 0 17 17">
                                        <path
                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                    </svg>
                                    <h1 class="text-white">Unduh Dokumen</h1>
                                </a>
                            </div>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="ijazah"
                                class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Ijazah / Transkrip
                                Nilai</label>
                            <div class="flex items-center pl-3 mt-2">
                                <a href="{{ route('unduh-dokumen-pelamar-diterima', ['dokumenName' => basename($data->user->name), 'fileName' => $data->user->ijazah]) }}"
                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                        viewBox="0 0 17 17">
                                        <path
                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                    </svg>
                                    <h1 class="text-white">Unduh Dokumen</h1>
                                </a>
                            </div>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="surat_lamaran_kerja"
                                class="flex w-1/3 pl-3 text-gray-600 bg-blue-50 items-center">Surat
                                Lamaran Kerja</label>
                            <div class="flex items-center pl-3 mt-2">
                                <a href="{{ route('unduh-dokumen-pelamar-diterima', ['dokumenName' => basename($data->user->name), 'fileName' => $data->user->surat_lamaran_kerja]) }}"
                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                        viewBox="0 0 17 17">
                                        <path
                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                    </svg>
                                    <h1 class="text-white">Unduh Dokumen</h1>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <!-- Foto pelamar kanan -->
                        @if ($data->user->pas_foto != null)
                            <img src="{{ asset('dokumen-peserta/Dokumen_' . $data->user->name . '/' . $data->user->pas_foto) }}"
                                alt="Foto Pelamar" class="w-1/3 rounded">
                        @else
                            <div class="flex w-48 h-56 items-end rounded border-4 border-gray-600 text-gray-600 bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" viewBox="0 0 36 32">
                                    <path fill="currentColor"
                                        d="M.5 31.983a.503.503 0 0 0 .612-.354c1.03-3.843 5.216-4.839 7.718-5.435c.627-.149 1.122-.267 1.444-.406c2.85-1.237 3.779-3.227 4.057-4.679a.5.5 0 0 0-.165-.473c-1.484-1.281-2.736-3.204-3.526-5.416a.492.492 0 0 0-.103-.171c-1.045-1.136-1.645-2.337-1.645-3.294c0-.559.211-.934.686-1.217a.5.5 0 0 0 .243-.408C10.042 5.036 13.67 1.026 18.12 1l.107.007c4.472.062 8.077 4.158 8.206 9.324a.498.498 0 0 0 .178.369c.313.265.459.601.459 1.057c0 .801-.427 1.786-1.201 2.772a.522.522 0 0 0-.084.158c-.8 2.536-2.236 4.775-3.938 6.145a.502.502 0 0 0-.178.483c.278 1.451 1.207 3.44 4.057 4.679c.337.146.86.26 1.523.403c2.477.536 6.622 1.435 7.639 5.232a.5.5 0 0 0 .966-.26c-1.175-4.387-5.871-5.404-8.393-5.95c-.585-.127-1.09-.236-1.336-.344c-1.86-.808-3.006-2.039-3.411-3.665c1.727-1.483 3.172-3.771 3.998-6.337c.877-1.14 1.359-2.314 1.359-3.317c0-.669-.216-1.227-.644-1.663C27.189 4.489 23.19.076 18.227.005l-.149-.002c-4.873.026-8.889 4.323-9.24 9.83c-.626.46-.944 1.105-.944 1.924c0 1.183.669 2.598 1.84 3.896c.809 2.223 2.063 4.176 3.556 5.543c-.403 1.632-1.55 2.867-3.414 3.676c-.241.105-.721.22-1.277.352c-2.541.604-7.269 1.729-8.453 6.147a.5.5 0 0 0 .354.612z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-9">
                <div
                    class="flex w-full bg-green-600 pt-4 pb-2 px-4  border-b-8 border-emerald-200 text-white space-x-3 rounded-t-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M9 6h11M5 6.01l.01-.011M5 12.01l.01-.011M3.8 17.8l.8.8l2-2M9 12h11M9 18h11" />
                    </svg>
                    <h1 class="text-lg font-bold">Data Seleksi Pelamar</h1>
                </div>
                <div class="bg-white px-4 py-4 shadow space-y-0.5">
                    @php
                        $kriteriaSebelumnya = null; // Inisialisasi variabel untuk menyimpan kriteria sebelumnya
                    @endphp

                    @foreach ($dataPenilaian as $item)
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1 font-semibold mt-2.5">
                                @if ($item->kriteria->nama != $kriteriaSebelumnya)
                                    <div class="bg-blue-50 p-2 rounded-md">
                                        <label for="nama"
                                            class="text-gray-600 text-lg">{{ $item->kriteria->nama }}</label>
                                    </div>
                                    @php
                                        $kriteriaSebelumnya = $item->kriteria->nama;
                                    @endphp
                                @endif

                                <div class="flex w-full items-center h-16 border-t border-gray-300 mt-2">
                                    <p class="w-1/3 pl-3 text-gray-700 text-lg tracking-wide">
                                        {{ $item->subkriteria->nama }}
                                    </p>
                                    <p class="flex w-1/3 pl-3 text-gray-700 text-lg tracking-wide">
                                        {{ $item->pengukuran->nama }}</p>

                                    @php
                                        $unduhDokumenTampil = false; // Inisialisasi variabel untuk mengontrol tampilan tombol "Unduh Dokumen"
                                    @endphp

                                    @foreach ($dataDokumenPendukung as $dokumenPendukung)
                                        @if ($dokumenPendukung->subkriteria_id == $item->subkriteria->id)
                                            @if (!$unduhDokumenTampil)
                                                <div class="flex items-center pl-3 mt-2">
                                                    <a href="{{ route('download-dokumen-pelamar-diterima', ['filename' => basename($dokumenPendukung->dokumen), 'pelamarName' => $data->user->name]) }}"
                                                        class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                            height="17" fill="currentColor"
                                                            class="bi bi-cloud-arrow-down-fill text-white"
                                                            viewBox="0 0 17 17">
                                                            <path
                                                                d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                                        </svg>
                                                        <h1 class="text-white">Unduh Dokumen</h1>
                                                    </a>
                                                    @php
                                                        $unduhDokumenTampil = true; // Setel variabel agar tombol tidak ditampilkan lagi
                                                    @endphp
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-9">
                <a href="/lamaran-disetujui/data/{{ $lowonganPekerjaanId }}"
                    class="text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">Kembali</a>
            </div>
        </div>
    </div>
    <?php $showSidebar = false; ?>
@endsection
