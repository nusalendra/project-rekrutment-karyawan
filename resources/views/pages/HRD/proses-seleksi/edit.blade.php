@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4">
            <div
                class="flex justify-between w-full bg-green-600 pt-4 pb-2 px-4  border-b-8 border-emerald-200 text-white space-x-3 rounded-t-lg">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="26.67" viewBox="0 0 576 512">
                        <path fill="currentColor"
                            d="M528 32H48C21.5 32 0 53.5 0 80v16h576V80c0-26.5-21.5-48-48-48zM0 432c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V128H0v304zm352-232c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zm0 64c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16zM176 192c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64zM67.1 396.2C75.5 370.5 99.6 352 128 352h8.2c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h8.2c28.4 0 52.5 18.5 60.9 44.2c3.2 9.9-5.2 19.8-15.6 19.8H82.7c-10.4 0-18.8-10-15.6-19.8z" />
                    </svg>
                    <h1 class="text-lg font-bold ml-3">Lamaran Pelamar</h1>
                </div>
                <div class="flex">
                    <h1 class="text-lg font-bold mr-3">Penilaian Lamaran Pelamar</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="26.67" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                      </svg>
                </div>
            </div>
            <div class="bg-white px-4 py-4 shadow">
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
                            <div class="w-3/4 font-semibold">
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
                                @elseif ($item->nama === 'Nomor Handphone')
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
                                @endif
                            </div>
                            <div class="w-1/4">
                                <select name="pengukuran_id[{{ $item->id }}]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    
                                    @foreach ($subkriteria as $subkriteriaItem)
                                        @if ($subkriteriaItem->id === $item->id)
                                            @foreach ($subkriteriaItem->pengukuran as $subkriteriaPengukuran)
                                                @php
                                                    $isDataAvailable = false;
                            
                                                    // Tambahkan kondisi untuk kolom lain sesuai kebutuhan
                                                    if ($item->nama === 'Nama Lengkap') {
                                                        $isDataAvailable = $dataUser->user->name != null;
                                                    } elseif ($item->nama === 'Kota Tempat Lahir') {
                                                        $isDataAvailable = $dataUser->kota_tempat_lahir != null;
                                                    } elseif ($item->nama === 'Tanggal Lahir') {
                                                        $isDataAvailable = $dataUser->tanggal_lahir != null;
                                                    } elseif ($item->nama === 'Jenis Kelamin') {
                                                        $isDataAvailable = $dataUser->jenis_kelamin != null;
                                                    } elseif ($item->nama === 'Agama') {
                                                        $isDataAvailable = $dataUser->agama != null;
                                                    } elseif ($item->nama === 'Status') {
                                                        $isDataAvailable = $dataUser->status != null;
                                                    } elseif ($item->nama === 'IPK') {
                                                        $isDataAvailable = $dataUser->IPK != null;
                                                    } elseif ($item->nama === 'Pengalaman Kerja') {
                                                        $isDataAvailable = $dataUser->pengalmaan_kerja != null;
                                                    } elseif ($item->nama === 'Pengalaman Organisasi') {
                                                        $isDataAvailable = $dataUser->pengalaman_organisasi != null;
                                                    }
                            
                                                @endphp
                            
                                                <option value="{{ $subkriteriaPengukuran->id }}" {{ $isDataAvailable ? 'selected' : '' }}>
                                                    {{ $subkriteriaPengukuran->nama }}
                                                </option>
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
