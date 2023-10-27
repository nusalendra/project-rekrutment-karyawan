@extends('layouts.app-pelamar')

@section('content')
    <div class="container mx-auto flex space-x-4 p-4 mt-4">
        <!-- Bagian Pilihan Posisi dan Tes Potensi Akademik (Sebelah Kiri) -->
        <div class="w-1/2 bg-white p-4 rounded-md shadow-md overflow-y-auto max-h-[850px] h-[850px]">
            <h2 class="text-xl font-semibold mb-4">Pilihan Posisi dan Tes Potensi Akademik</h2>
            @foreach ($tesPotensiAkademik as $lowonganPekerjaanId => $tesGroup)
                @if (count($tesGroup) > 0)
                    <div class="bg-blue-100 p-4 rounded-md mb-4">
                        <h3 class="text-lg font-semibold mb-2">
                            Posisi: {{ $tesGroup[0]->lowonganPekerjaan->jabatan->nama }}
                        </h3>
                        <h4 class="text-base font-semibold mt-3">Tes Potensi Akademik:</h4>
                        @foreach ($tesGroup as $tes)
                            <div
                                class="bg-white p-4 rounded-md shadow-sm mb-2 mt-3 transition duration-300 transform hover:scale-105">
                                <h5 class="text-base font-semibold">{{ $tes->nama }}</h5>
                                @php
                                    $statusSudahDikerjakan = !is_null($tes->updated_at);
                                    $TPAId = Crypt::encrypt($tes->id);
                                @endphp
                                <span class="{{ $statusSudahDikerjakan ? 'text-blue-500' : 'text-red-500' }} mr-2">
                                    Status: {{ $statusSudahDikerjakan ? 'Sudah Dikerjakan' : 'Belum Dikerjakan' }}
                                    {{-- <a href="#" class="text-blue-500 hover:underline">Lihat Hasil</a> --}}
                                </span>
                                @if (!$statusSudahDikerjakan)
                                    <a href="tes-tpa/detail/{{ $TPAId }}" class="text-blue-500 hover:underline">Mulai
                                        Tes</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

        </div>

        <!-- Bagian Informasi Panduan (Sebelah Kanan) -->
        <div class="w-1/2 bg-white p-4 rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-4">Panduan Mengikuti Tes Potensi Akademik</h2>
            <p class="text-gray-600">Silakan pilih posisi yang sesuai dengan Anda di sebelah kiri. Kemudian, ikuti panduan
                berikut:</p>
            <ol class="list-decimal list-inside text-gray-600 ml-4">
                <li>Pastikan Anda berada di ruangan yang tenang dan bebas gangguan.</li>
                <li>Siapkan kertas dan pena jika diperlukan untuk perhitungan atau catatan.</li>
                <li>Baca instruksi setiap soal dengan teliti.</li>
                <li>Pilih jawaban yang menurut Anda benar.</li>
                <li>Klik tombol "Selesai" saat Anda telah menyelesaikan tes.</li>
            </ol>
            <p class="text-gray-600 mt-4">Jika Anda memiliki pertanyaan atau mengalami kesulitan, hubungi tim dukungan kami.
            </p>
        </div>
    </div>
@endsection
