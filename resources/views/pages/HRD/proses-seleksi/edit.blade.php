@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white mt-2 rounded shadow-md overflow-y-auto max-h-[800px]">
            <div class="px-11 py-9 text-black">
                <div class="flex justify-between">
                    <h1 class="text-2xl font-semibold mb-4">Data Diri Pelamar</h1>
                    <h1 class="text-2xl font-semibold mb-4">Penilaian Pelamar</h1>
                </div>
                <form action="{{ route('proses-seleksi-update', ['lowonganPekerjaanId' => $lowonganPekerjaanId]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="pelamar_id" value="{{ $data->id }}">
                    <input type="hidden" name="periode_id" value="{{ $lowonganPekerjaan->periode_id }}">
                    <input type="hidden" name="jabatan_id" value="{{ $lowonganPekerjaan->jabatan_id }}">
                    @foreach ($subkriteria as $item)
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-1/4">
                                <span class="font-semibold">{{ $item->nama }}</span>
                            </div>
                            <div class="w-3/4">
                                @if ($item->nama === 'Nama Lengkap')
                                    {{ $dataUser->user->name }}
                                @elseif ($item->nama === 'Kota Tempat Lahir')
                                    {{ $dataUser->kota_tempat_lahir }}
                                @elseif ($item->nama === 'Tanggal Lahir')
                                    {{ \Carbon\Carbon::parse($dataUser->tanggal_lahir)->format('d-m-Y') }}
                                @elseif ($item->nama === 'Jenis Kelamin')
                                    {{ $dataUser->jenis_kelamin }}
                                @elseif ($item->nama === 'Agama')
                                    {{ $dataUser->agama }}
                                @elseif ($item->nama === 'Status')
                                    {{ $dataUser->status }}
                                @elseif ($item->nama === 'Alamat Tinggal')
                                    {{ $dataUser->alamat_tinggal }}
                                @elseif ($item->nama === 'Pendidikan Terakhir')
                                    {{ $dataUser->pendidikan_terakhir }}
                                @elseif ($item->nama === 'IPK')
                                    {{ $dataUser->IPK }}
                                @elseif ($item->nama === 'Pengalaman Kerja')
                                    @foreach (json_decode($dataUser->pengalaman_kerja) as $pengalamanKerja)
                                        <div>
                                            <label for="">{{ $pengalamanKerja }}</label>
                                        </div>
                                    @endforeach
                                @elseif ($item->nama === 'Pengalaman Organisasi')
                                    @foreach (json_decode($dataUser->pengalaman_organisasi) as $pengalamanOrganisasi)
                                        <div>
                                            <label for="">{{ $pengalamanOrganisasi }}</label>
                                        </div>
                                    @endforeach
                                @elseif ($item->nama === 'Nomor yang Bisa Dihubungi')
                                    {{ $dataUser->nomor_handphone }}
                                @elseif ($item->nama === 'Email')
                                    {{ $dataUser->user->email }}
                                @elseif ($item->nama === 'Sosial Media')
                                    @if (!empty($dataUser) && is_array($sosialMediaArray = json_decode($dataUser->sosial_media, true)))
                                        @if (count($sosialMediaArray) > 0)
                                            <div class="flex items-center space-x-4">
                                                <span class="w-1/4">Linkedin</span>
                                                <a href="{{ $sosialMediaArray[0] }}"
                                                    target="_blank">{{ $sosialMediaArray[0] }}</a>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-1/4">Instagram</span>
                                                <a href="{{ $sosialMediaArray[1] }}"
                                                    target="_blank">{{ $sosialMediaArray[1] }}</a>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-1/4">Twitter</span>
                                                <a href="{{ $sosialMediaArray[2] }}"
                                                    target="_blank">{{ $sosialMediaArray[2] }}</a>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-1/4">Blog</span>
                                                <a href="{{ $sosialMediaArray[3] }}"
                                                    target="_blank">{{ $sosialMediaArray[3] }}</a>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class="w-1/4">Github</span>
                                                <a href="{{ $sosialMediaArray[4] }}"
                                                    target="_blank">{{ $sosialMediaArray[4] }}</a>
                                            </div>
                                        @endif
                                    @endif
                                @elseif ($item->nama === 'Dokumen Surat Lamaran')
                                    <div class="flex w-full h-16">
                                        <div class="flex items-center mt-2">
                                            @isset($dataUser->surat_lamaran_kerja)
                                                <a href="{{ route('unduh-dokumen-seleksi-pelamar', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->surat_lamaran_kerja]) }}"
                                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                                        viewBox="0 0 17 17">
                                                        <path
                                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                                    </svg>
                                                    <h1 class="text-white">Unduh Dokumen</h1>
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                    {{-- {{ $dataUser->surat_lamaran_kerja }} --}}
                                @elseif ($item->nama === 'Dokumen CV')
                                    <div class="flex w-full h-16">
                                        <div class="flex items-center  mt-2">
                                            @isset($dataUser->curriculum_vitae)
                                                <a href="{{ route('unduh-dokumen-seleksi-pelamar', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->curriculum_vitae]) }}"
                                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                                        viewBox="0 0 17 17">
                                                        <path
                                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                                    </svg>
                                                    <h1 class="text-white">Unduh Dokumen</h1>
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                    {{-- {{ $dataUser->curriculum_vitae }} --}}
                                @elseif ($item->nama === 'Dokumen Ijazah')
                                    <div class="flex w-full h-16">
                                        <div class="flex items-center  mt-2">
                                            @isset($dataUser->ijazah)
                                                <a href="{{ route('unduh-dokumen-seleksi-pelamar', ['dokumenName' => basename($dataUser->user->name), 'fileName' => $dataUser->ijazah]) }}"
                                                    class="flex justify-center items-center bg-blue-500 h-10 px-3 py-1 space-x-1 rounded-lg hover:bg-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                        fill="currentColor" class="bi bi-cloud-arrow-down-fill text-white"
                                                        viewBox="0 0 17 17">
                                                        <path
                                                            d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                                    </svg>
                                                    <h1 class="text-white">Unduh Dokumen</h1>
                                                </a>
                                            @endisset
                                        </div>
                                    </div>
                                    {{-- {{ $dataUser->ijazah }} --}}
                                @endif
                            </div>
                            <div class="w-1/4">
                                <select name="pengukuran_id[{{ $item->id }}]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($subkriteria as $subkriteriaItem)
                                        @if ($subkriteriaItem->id === $item->id)
                                            @foreach ($subkriteriaItem->pengukuran as $subkriteriaPengukuran)
                                                <option value="{{ $subkriteriaPengukuran->id }}">
                                                    {{ $subkriteriaPengukuran->nama }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="pt-6 flex justify-center">
                        <button type="submit" name="status_lamaran" value="Ditolak"
                            class="mr-3 tidakLulusButton text-white bg-red-500 hover:bg-red-600 border border-red-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Tolak Lamaran
                        </button>
                        <button type="submit" name="status_lamaran" value="Diterima"
                            class="lulusButton text-white bg-green-500 hover:bg-green-600 border border-green-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Terima Lamaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $showSidebar = false; ?>
@endsection
