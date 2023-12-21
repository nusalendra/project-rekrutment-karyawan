@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">

            <div class="px-12 pt-5 text-black">
                <div class="flex items-center mb-3">
                    <a href="/pelamar-tes"
                        class="mr-2 text-white bg-cyan-600 hover:bg-cyan-700 border border-cyan-600 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"">
                        <p class="font-semibold text-sm">Kembali</p>
                    </a>
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Data Pelamar Tes
                    </h2>
                </div>
                <div class="flex mb-4 justify-center">
                    @php
                        $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaanIdDecrypt);
                    @endphp
                    <form
                        action="{{ route('kirim-notifikasi-tes', ['lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 border border-blue-600 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 me-2 py-2.5 text-center inline-flex items-center">
                            Kirim Notifikasi Akses Halaman TPA
                        </button>
                    </form>
                    <form action="{{ route('lulus-tpa', ['lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 border border-green-600 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 me-2 py-2.5 text-center inline-flex items-center">
                            Pindahkan Pelamar ke Antrian Tes Wawancara (Skor >= 550)
                        </button>
                    </form>
                    <form action="{{ route('tidak-lulus-tpa', ['lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-700 border border-red-600 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Tolak Pelamar Untuk Tahap Ini (Skor < 500) </button>
                    </form>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-base text-left text-black dark:text-gray-400">
                        <thead
                            class="text-md border-x border-gray-300 text-gray-700 bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">No</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Nama Lengkap</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Status</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Skor Tes Potensi Akademik</h1>
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tanggal Melamar</h1>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @if (count($data) == 0)
                                <tr
                                    class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4" colspan="6">
                                        <h1 class="flex w-full justify-center">Tidak Ada Data Pelamar Tes</h1>
                                    </td>
                                </tr>
                            @else
                                @foreach ($data as $index => $item)
                                    <tr
                                        class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">{{ $index + 1 }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">{{ $item->user->name }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">{{ $item->status_lamaran }}</h1>
                                        </td>
                                        @if ($item->skorTesPelamar && $item->skorTesPelamar->skor_tes && $item->skorTesPelamar->skor_tes > 0)
                                            @if ($item->skorTesPelamar->skor_tes < 550)
                                                <td class="px-6 py-4">
                                                    <h1 class="flex text-red-700 w-full justify-center">
                                                        {{ $item->skorTesPelamar->skor_tes }}
                                                    </h1>
                                                </td>
                                            @else
                                                <td class="px-6 py-4">
                                                    <h1 class="flex text-green-500 w-full justify-center">
                                                        {{ $item->skor_tes }}
                                                    </h1>
                                                </td>
                                            @endif
                                        @else
                                            <td class="px-6 py-4">
                                                <h1 class="flex w-full justify-center">0</h1>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- {{ $data->links() }} --}}
                    {{-- @if ($data->hasPages())
                    <div class="pagination-links pt-6">
                        {{ $data->appends(['search' => $searchTerm])->links() }}
                    </div>
                @endif --}}
                </div>
            </div>
        </div>
    </div>
    <?php $showSidebar = false; ?>
@endsection
