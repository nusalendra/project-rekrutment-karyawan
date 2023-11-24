@extends('layouts.app-pelamar')

@section('content')
    <div class="flex w-screen h-full items-center justify-center bg-slate-100 mx-auto ">
        <div class="h-1/2 w-2/5 bg-white bg-auto rounded-xl border-2 border-gray-300">
            <div class="flex flex-col w-full h-full pt-9 text-black items-center justify-between">
                <div class="relative flex w-full items-center">
                    <a href="/tes-tpa"
                        class="absolute flex z-10 ml-3 py-1 px-3 font-semibold items-center space-x-1 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z" />
                                <path fill="currentColor"
                                    d="M3.076 5.617A1 1 0 0 1 4 5h10a7 7 0 1 1 0 14H5a1 1 0 1 1 0-2h9a5 5 0 1 0 0-10H6.414l1.793 1.793a1 1 0 0 1-1.414 1.414l-3.5-3.5a1 1 0 0 1-.217-1.09Z" />
                            </g>
                        </svg>
                        <h1>KEMBALI</h1>
                    </a>
                    <h2 class="w-full flex justify-center font-bold text-xl z-0">{{ $tesPotensiAkademik->nama }}
                    </h2>
                </div>
                <div class="w-full mt-6">
                    <h1 class="flex text-2xl justify-center font-medium mb-10">Anda belum menyelesaikan Tes ini</h1>
                    <div class="flex flex-col px-12 mb-10 justify-center space-y-1">
                        <h1 class="flex justify-center">Mulai Pengerjaan :
                            {{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_mulai)->format('d-m-Y') }}
                            Jam
                            {{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_mulai)->format('H:i') }}
                        </h1>
                        <h1 class="flex justify-center">
                            Batas Pengerjaan :
                            {{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_selesai)->format('d-m-Y') }}
                            Jam
                            {{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_selesai)->format('H:i') }}

                        </h1>
                    </div>
                </div>

                <div class="flex flex-col w-full justify-center items-center">

                    <a id="tenggatWaktu" href="/tes-tpa/mulai-tes/{{ $id }}"
                        class="flex items-center justify-center bg-blue-500 px-3 py-1 mb-14 space-x-3 text-white rounded-lg hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M8 16h2V8H8v8Zm4 0l6-4l-6-4v8Zm0 6q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22Zm0-2q3.35 0 5.675-2.325T20 12q0-3.35-2.325-5.675T12 4Q8.65 4 6.325 6.325T4 12q0 3.35 2.325 5.675T12 20Zm0-8Z" />
                        </svg>
                        <h1 class="text-lg font-semibold">MULAI TES</h1>
                    </a>

                    <h2 class="w-full text-sm font-medium text-white px-12 pb-6 pt-3 text-justify bg-sky-700 rounded-b-xl">
                        Tetap percayalah pada kemampuan Anda. Tes Potensi Akademik adalah peluang untuk menunjukkan potensi
                        akademik Anda, jadi percayalah pada diri sendiri dan kerjakan yang terbaik.</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tenggatWaktu = document.getElementById("tenggatWaktu");

            var waktuMulai = new Date("{{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_mulai) }}");
            var waktuSelesai = new Date("{{ \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_selesai) }}");
            var waktuSekarang = new Date();

            if (waktuSekarang >= waktuMulai && waktuSekarang <= waktuSelesai) {
                tenggatWaktu.addEventListener("click", function(event) {
                    window.location.href = tenggatWaktu.getAttribute("href");

                    event.preventDefault();
                });
            } else {
                tenggatWaktu.style.pointerEvents = "none";
                tenggatWaktu.style.opacity = "0.5"; // Contoh: Mengurangi kejelasan untuk menunjukkan nonaktif
            }
        });
    </script>
@endsection
