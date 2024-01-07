@extends('layouts.app-tes-tpa')

@section('content')
    <div class="w-screen h-screen px-28 pt-14 pb-6 bg-slate-100 mx-auto overflow-y-auto">
        <div class="h-auto w-full bg-white bg-auto rounded-xl border-2 border-gray-300">
            <div class="flex flex-col w-full h-full py-12 px-16 text-black">

                <div id="countdown" class="fixed top-0 right-32 p-4 text-lg font-bold"></div>

                <div id="waktu-habis" tabindex="-1"
                    class="flex hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-51 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-slate-200 rounded-lg shadow dark:bg-gray-700">
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-red-600 w-12 h-12 dark:text-red-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-semibold text-black dark:text-gray-400">Waktu pengerjaan tes
                                    telah berakhir!</h3>
                                    @php
                                        $pelamarIdEncrypt = Crypt::encrypt($pelamar->id)
                                    @endphp
                                <a href="/tes-tpa/{{ $pelamarIdEncrypt }}">
                                    <button data-modal-hide="waktu-habis" type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                        Kembali
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('kirim-jawaban', ['id' => $id, 'pelamarTesId' => $pelamarTesId->id]) }}"
                    class="w-full h-auto" method="POST">

                    @csrf
                    @foreach ($soalTes as $soal)
                        <input type="hidden" name="pertanyaan[{{ $soal->id }}]" value="{{ $soal->id }}">
                        <div class="w-full h-auto space-y-3 mb-6">
                            <div class="flex space-x-3 text-xl font-bold">
                                <h1>{{ $loop->index + 1 }}.</h1>
                                @if ($soal->file_input_pertanyaan)
                                    <!-- Pemeriksaan apakah kolom berisi gambar -->
                                    <img width="450" height="450"
                                        src="{{ asset('file-pertanyaan/' . $soal->file_input_pertanyaan) }}"
                                        alt="Pertanyaan Image">
                                @else
                                    <h1>{{ $soal->pertanyaan }}</h1>
                                @endif
                            </div>
                            <div class="pl-6 space-y-3">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="A" required>
                                    @if ($soal->file_input_pilihan_a)
                                        <!-- Pemeriksaan apakah kolom berisi gambar -->
                                        <img width="350" height="350"
                                            src="{{ asset('file-pertanyaan/' . $soal->file_input_pilihan_a) }}"
                                            alt="Pertanyaan Image">
                                    @else
                                        <h1>{{ $soal->pilihan_a }}</h1>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="B" required>
                                    @if ($soal->file_input_pilihan_b)
                                        <!-- Pemeriksaan apakah kolom berisi gambar -->
                                        <img width="350" height="350"
                                            src="{{ asset('file-pertanyaan/' . $soal->file_input_pilihan_b) }}"
                                            alt="Pertanyaan Image">
                                    @else
                                        <h1>{{ $soal->pilihan_b }}</h1>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="C" required>
                                    @if ($soal->file_input_pilihan_c)
                                        <!-- Pemeriksaan apakah kolom berisi gambar -->
                                        <img width="350" height="350"
                                            src="{{ asset('file-pertanyaan/' . $soal->file_input_pilihan_c) }}"
                                            alt="Pertanyaan Image">
                                    @else
                                        <h1>{{ $soal->pilihan_c }}</h1>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="D" required>
                                    @if ($soal->file_input_pilihan_d)
                                        <!-- Pemeriksaan apakah kolom berisi gambar -->
                                        <img width="350" height="350"
                                            src="{{ asset('file-pertanyaan/' . $soal->file_input_pilihan_d) }}"
                                            alt="Pertanyaan Image">
                                    @else
                                        <h1>{{ $soal->pilihan_d }}</h1>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                                        <button data-modal-hide="popup-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                            Cek Ulang Jawaban</button>
                                        <button data-modal-hide="popup-modal" type="submit"
                                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                            Ya, Saya Yakin
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script>
        // Ambil nilai waktu mulai dan waktu selesai dari server (dalam format waktu saja)
        var waktuMulai = "{{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_mulai)->format('H:i:s') }}";
        var waktuSelesai = "{{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_selesai)->format('H:i:s') }}";

        // Hitung sisa waktu
        var waktuSekarang = moment().format('H:mm:ss');
        var sisaWaktuMillis = moment(waktuSelesai, 'HH:mm:ss').diff(moment(waktuSekarang, 'HH:mm:ss'));
        var sisaWaktuDetik = moment.duration(sisaWaktuMillis).asSeconds();
        var x = setInterval(function() {
            sisaWaktuDetik--;

            var countdownElem = document.getElementById("countdown");
            countdownElem.innerHTML =
                '<div class="flex items-center">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-clock mr-2" viewBox="0 0 16 16">' +
                '<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />' +
                '<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7-7 0 1 1 1 8a7 7 0 0 1 14 0" />' +
                '</svg>' +
                Math.floor(sisaWaktuDetik / 60) + "m " + (sisaWaktuDetik % 60) + "s " +
                '</div>';

            // Jika hitungan mundur berakhir, tampilkan modal
            if (sisaWaktuDetik <= 0) {
                clearInterval(x);
                document.getElementById('waktu-habis').classList.remove('hidden');
            }
        }, 1000);
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-modal-toggle]').on('click', function() {
                var targetModalId = $(this).data('modal-toggle');
                $('#' + targetModalId).toggleClass('hidden');
            });

            $('[data-modal-hide]').on('click', function() {
                var targetModalId = $(this).data('modal-hide');
                $('#' + targetModalId).addClass('hidden');
            });
        });
    </script>
@endsection
