@extends('layouts.app-hrd')

@section('content')
    <div class="px-28 pt-5 pb-6 bg-slate-100 mx-auto overflow-y-auto">
        <div class="h-auto w-full bg-white bg-auto rounded-xl border-2 border-gray-300 p-5 mb-5">
            <h3 class="text-lg font-bold text-blue-500 mb-2">{{ $pelamarTes->pelamar->user->name }}</h3>
            <h5 class="text-lg font-bold mb-2">Jenis Tes : {{ $pelamarTes->tesPotensiAkademik->nama }}</h5>
            @if ($pelamarTes->updated_at)
                <p class="text-md font-bold">Tanggal / Waktu Menyelesaikan Tes :
                    {{ \Carbon\Carbon::parse($pelamarTes->updated_at)->format('d-m-Y / H:i') }}</p>
            @endif
        </div>
        <div class="h-auto w-full bg-white bg-auto rounded-xl border-2 border-gray-300">
            <div class="flex flex-col w-full h-full py-12 px-16 text-black">

                <form action="" class="w-full h-auto" method="POST">
                    @csrf
                    @php
                        // Fungsi bantuan untuk mencari jawaban berdasarkan pertanyaan_tpa_id
                        function findJawabanByPertanyaanId($dataJawaban, $pertanyaanId)
                        {
                            foreach ($dataJawaban as $jawaban) {
                                if ($jawaban->pertanyaan_tpa_id == $pertanyaanId) {
                                    return $jawaban;
                                }
                            }
                            return null;
                        }
                    @endphp
                    @php
                        $jumlahBenar = 0;
                        $jumlahSalah = 0;
                    @endphp

                    @foreach ($pertanyaanTes as $soal)
                        <input type="hidden" name="pertanyaan[{{ $soal->id }}]" value="{{ $soal->id }}">
                        <div class="w-full h-auto space-y-3 mb-6">
                            <div class="flex space-x-3 text-xl font-bold">
                                <h1>{{ $loop->index + 1 }}.</h1>
                                <h1 class="">{{ $soal->pertanyaan }}</h1>
                            </div>
                            <div class="pl-6 space-y-3">
                                @php
                                    // Mencari jawaban yang sesuai berdasarkan pertanyaan_tpa_id
                                    $jawabanPelamar = findJawabanByPertanyaanId($dataJawaban, $soal->id);
                                    $jawabanBenar = $soal->jawaban;
                                @endphp
                                @foreach (['A', 'B', 'C', 'D'] as $option)
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="pilihan[{{ $soal->id }}]"
                                            value="{{ $option }}" disabled
                                            {{ $jawabanPelamar && $jawabanPelamar->pilihan_jawaban === $option ? 'checked' : '' }}>
                                        <label for="pilihan_{{ $soal->id }}_{{ $option }}">
                                            {{ $soal->{'pilihan_' . strtolower($option)} }}
                                        </label>
                                        @if ($jawabanPelamar)
                                            @if ($jawabanPelamar->pilihan_jawaban === $option)
                                                @if ($jawabanPelamar->pilihan_jawaban === $jawabanBenar)
                                                    <!-- Jawaban benar, berikan ikon centang -->
                                                    @php
                                                        $jumlahBenar++;
                                                    @endphp
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-check2 text-green-700"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                    </svg>
                                                @else
                                                    <!-- Jawaban salah, berikan ikon "X" -->
                                                    @php
                                                        $jumlahSalah++;
                                                    @endphp
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-x-lg text-red-700"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                    </svg>
                                                @endif
                                            @elseif ($soal->jawaban === $option)
                                                <!-- Jawaban benar, berikan ikon centang -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-check2 text-green-700"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                </svg>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="text-right">
                        <h1 class="font-bold text-lg">Jumlah Jawaban :</h1>
                        <h2 class="font-bold text-green-700 text-md">Benar : {{ $jumlahBenar }}</h2>
                        <h2 class="font-bold text-red-700 text-md">Salah : {{ $jumlahSalah }}</h2>
                    </div>



                    <div class="w-full flex justify-center">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Simpan Jawaban
                        </button>
                        <div id="popup-modal" tabindex="-1"
                            class="flex hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-stone-200 rounded-lg  dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Sudahkah Anda
                                            menyelesaikan seluruh pertanyaan dan yakin dengan respons yang telah Anda
                                            berikan ?</h3>
                                        <button data-modal-hide="popup-modal" type="submit"
                                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                            Ya, Saya Yakin
                                        </button>
                                        <button data-modal-hide="popup-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                            Cek Ulang Jawaban</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $showSidebar = false; ?>
@endsection
