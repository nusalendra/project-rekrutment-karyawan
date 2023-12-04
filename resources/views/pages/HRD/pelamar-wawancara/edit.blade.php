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
                <div class="grid gap-4">
                    <div class="col-span-1 space-y-0.5 font-semibold">
                        <div class="flex w-full h-16">
                            <label for="nama" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Nama
                                Pelamar</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $data->user->name }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="kota_tempat_lahir"
                                class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Kota
                                Tempat Lahir</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $dataUser->kota_tempat_lahir }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="tanggal_lahir" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Tanggal
                                Lahir</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ date('d-m-Y', strtotime($dataUser->tanggal_lahir)) }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="jenis_kelamin" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Jenis
                                Kelamin</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $dataUser->jenis_kelamin }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="agama"
                                class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Agama</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $dataUser->agama }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="status"
                                class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Status</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">{{ $dataUser->status }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="alamat_tinggal" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Alamat
                                Tinggal</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $dataUser->alamat_tinggal }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="email"
                                class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Email</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $data->user->email }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="nomor_handphone" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Nomor
                                Handphone</label>
                            <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                {{ $dataUser->nomor_handphone }}
                            </p>
                        </div>
                        <div class="flex w-full h-16">
                            <label for="sosial_media" class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Sosial
                                Media : </label>
                        </div>
                        <div class="ml-3">
                            @if (!empty($dataUser) && is_array($sosialMediaArray = json_decode($dataUser->sosial_media, true)))
                                @if (count($sosialMediaArray) > 0)
                                    <div class="flex items-center space-x-4">
                                        <span class="flex w-1/6 text-gray-600 p-2 items-center">1. Linkedin</span>
                                        <a class="flex w-2/3 text-gray-700 tracking-wide items-center"
                                            href="{{ $sosialMediaArray[0] }}"
                                            target="_blank">{{ $sosialMediaArray[0] }}</a>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="flex w-1/6 text-gray-600  p-2 items-center">2. Instagram</span>
                                        <a class="flex w-2/3 text-gray-700 tracking-wide items-center"
                                            href="{{ $sosialMediaArray[1] }}"
                                            target="_blank">{{ $sosialMediaArray[1] }}</a>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="flex w-1/6 text-gray-600  p-2 items-center">3. Twitter</span>
                                        <a class="flex w-2/3 text-gray-700 tracking-wide items-center"
                                            href="{{ $sosialMediaArray[2] }}"
                                            target="_blank">{{ $sosialMediaArray[2] }}</a>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="flex w-1/6 text-gray-600  p-2 items-center">4. Blog</span>
                                        <a class="flex w-2/3 text-gray-700 tracking-wide items-center"
                                            href="{{ $sosialMediaArray[3] }}"
                                            target="_blank">{{ $sosialMediaArray[3] }}</a>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="flex w-1/6 text-gray-600  p-2 items-center">5. Github</span>
                                        <a class="flex w-2/3 text-gray-700 tracking-wide items-center"
                                            href="{{ $sosialMediaArray[4] }}"
                                            target="_blank">{{ $sosialMediaArray[4] }}</a>
                                    </div>
                                @endif
                            @endif
                        </div>
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
                    <h1 class="text-lg font-bold">Riwayat Pendidikan dan Pengalaman</h1>
                </div>
                <div class="bg-white px-4 py-4 shadow space-y-0.5">
                    <div class="grid gap-4">
                        <div class="col-span-1 space-y-0.5 font-semibold">
                            <div class="flex w-full h-16">
                                <label for="pendidikan_terakhir"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Pendidikan
                                    Terakhir</label>
                                <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                    {{ $dataUser->pendidikan_terakhir }}
                                </p>
                            </div>
                            <div class="flex w-full h-16">
                                <label for="IPK"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">IPK</label>
                                <p class="flex w-2/3 pl-3 text-gray-700 tracking-wide items-center">
                                    {{ $dataUser->IPK }}
                                </p>
                            </div>
                            <div class="flex w-full h-auto">
                                <label for="pengalaman_kerja"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Pengalaman Kerja</label>
                                <div class="flex flex-col pl-3 text-gray-700 tracking-wide items-center">
                                    @foreach (json_decode($dataUser->pengalaman_kerja) as $pengalamanKerja)
                                        <li>{{ $pengalamanKerja }}</li>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex w-full h-auto">
                                <label for="pengalaman_organisasi"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Pengalaman
                                    Organisasi</label>
                                <div class="flex flex-col pl-3 pt-3 text-gray-700 tracking-wide items-center">
                                    @foreach (json_decode($dataUser->pengalaman_organisasi) as $pengalamanOrganisasi)
                                        <li>{{ $pengalamanOrganisasi }}</li>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex w-full h-16">
                                <label for="surat_lamaran_kerja"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Surat
                                    Lamaran Kerja</label>
                                <div class="flex items-center pl-3 mt-2">
                                    <a href="{{ route('unduh-dokumen-pelamar-wawancara', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->surat_lamaran_kerja]) }}"
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
                                <label for="curriculum_vitae"
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Curriculum Vitae</label>
                                <div class="flex items-center pl-3 mt-2">
                                    <a href="{{ route('unduh-dokumen-pelamar-wawancara', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->curriculum_vitae]) }}"
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
                                    class="flex w-1/6 pl-3 text-gray-600 bg-blue-50 items-center">Ijazah</label>
                                <div class="flex items-center pl-3 mt-2">
                                    <a href="{{ route('unduh-dokumen-pelamar-wawancara', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->ijazah]) }}"
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
                    </div>
                </div>
            </div>
            <div class="mt-9 flex justify-between items-center">
                <a href="/pelamar-wawancara/data/{{ $lowonganPekerjaanId }}"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kembali</a>
            
                <form action="{{ route('pelamar-wawancara-update', ['lowonganPekerjaanId' => $lowonganPekerjaanId]) }}" method="POST" class="mx-auto text-center">
                    @csrf
                    <input type="hidden" name="pelamar_id" value="{{ $data->id }}">
                    <button type="submit" name="status_lamaran" value="Tahap Wawancara Ditolak"
                        class="mr-3 text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tolak Pelamar
                    </button>
                    <button type="submit" name="status_lamaran" value="Pelamar Disetujui"
                        class="text-white bg-gradient-to-r from-green-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Setujui Pelamar
                    </button>
                </form>
            </div>            
        </div>
    </div>
    <?php $showSidebar = false; ?>
@endsection
