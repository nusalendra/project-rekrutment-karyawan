@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-white p-4 rounded-md shadow-md">
            <div class="flex items-center mb-4">
                <h2 class="text-2xl font-semibold mx-4">Data Tes Potensi Akademik Pelamar</h2>
            </div>
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="flex flex-col space-y-2">
                    <p class="text-lg font-semibold text-gray-600">
                        Total Pelamar yang Telah Menyelesaikan Tes : {{ $pelamarTes->groupBy('pelamar_id')->count() }}
                        Pelamar
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            @foreach ($pelamarTes->groupBy('pelamar_id') as $pelamarId => $pelamarTesGrouped)
                <!-- Satu kotak untuk satu pelamar -->
                <div class="bg-white p-4 rounded-md shadow-md overflow-y-auto">
                    @php $firstItem = $pelamarTesGrouped->first(); @endphp
                    <h3 class="text-lg font-semibold text-blue-500 mb-2">{{ $firstItem->pelamar->user->name }}</h3>
                    <h4 class="text-base font-semibold mt-3">Tes pada Jabatan :
                        {{ $firstItem->tesPotensiAkademik->lowonganPekerjaan->jabatan->nama }}</h4>
                    <h4 class="text-base font-semibold mt-3">Tes Potensi Akademik :</h4>
                    @foreach ($pelamarTesGrouped as $item)
                    @php
                        $pelamarTPAId = Crypt::encrypt($item->id)
                    @endphp
                        <div class="bg-blue-100 p-4 rounded-md mb-2 mt-2 transition duration-300 max-h-[150px]">
                            <h5 class="text-lg font-semibold text-blue-500 mb-2">{{ $item->tesPotensiAkademik->nama }}</h5>
                            @if ($item->updated_at)
                                <p class="text-gray-600">Tanggal / Waktu Menyelesaikan Tes:
                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y / H:i') }}</p>
                                <span class="text-green-700 mr-2">Status: Sudah Dikerjakan</span>
                                <a href="/hasil-tes-potensi-akademik/koreksi-tes/{{ $pelamarTPAId }}" class="text-blue-500 hover:underline">Koreksi Tes</a>
                            @else
                                <p class="text-gray-600">Status: Belum Dikerjakan</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>


    <?php $showSidebar = true; ?>
@endsection
