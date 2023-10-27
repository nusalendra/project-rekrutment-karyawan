@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white p-4 rounded-md shadow-md">
            <div class="flex items-center mb-4">
                <a href="/tes-potensi-akademik" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                    Kembali
                </a>
                <h2 class="text-2xl font-semibold mx-4">Data Tes Potensi Akademik Pelamar</h2>
            </div>
            <div class="bg-white p-4 rounded-md shadow-md">
                <p class="text-2xl font-semibold text-blue-500 mb-4">tes</p>
                <div class="flex flex-col space-y-2">
                    <p class="text-lg font-semibold text-gray-600">
                        Tanggal & Waktu Tes Dilaksanakan:
                    </p>
                    <p class="text-lg font-semibold text-gray-600">
                        Total Pelamar yang Telah Menyelesaikan Tes: {{ $pelamarTes->count() }} Pelamar
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            @foreach ($pelamarTes as $item)
                <!-- Tes Potensi Akademik Dummy Data 1 -->
                <div class="bg-white p-4 rounded-md shadow-md overflow-y-auto">
                    <h3 class="text-lg font-semibold text-blue-500 mb-2">{{ $item->pelamar->user->name }}</h3>
                    <h4 class="text-base font-semibold mt-3">Tes Potensi Akademik :</h4>
                    <div class="bg-blue-100 p-4 rounded-md mb-2 mt-2 transition duration-300 max-h-[150px]">
                        <h5 class="text-lg font-semibold text-blue-500 mb-2">{{ $item->nama }}</h5>
                        <p class="text-gray-600">Deskripsi Tes Contoh 1 yang lebih panjang untuk melihat tampilan
                            scroll.
                        </p>
                        <span class="text-red-500 mr-2">Status: Belum Dikerjakan</span>
                        <a href="#" class="text-blue-500 hover:underline">Mulai Tes</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <?php $showSidebar = true; ?>
@endsection
