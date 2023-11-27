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
            <div class="text-left p-4">
                <h1 class="font-bold text-lg">Jumlah Jawaban :</h1>
                <h2 class="font-bold text-blue-700 text-md">Total Soal : {{ $pelamarTes->total_pertanyaan }} Soal</h2>
                <h2 class="font-bold text-green-700 text-md">Jawaban Benar : {{ $pelamarTes->total_jawaban_benar }}</h2>
                <h2 class="font-bold text-red-700 text-md">Jawaban Salah : {{ $pelamarTes->total_jawaban_salah }}</h2>
            </div>
        </div>
        <div class="h-auto w-full bg-white bg-auto rounded-xl border-2 border-gray-300">
            <div class="flex flex-col w-full h-full py-12 px-16 text-black">
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

                @foreach ($pertanyaanTes as $soal)
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
                            @php
                                // Mencari jawaban yang sesuai berdasarkan pertanyaan_tpa_id
                                $jawabanPelamar = findJawabanByPertanyaanId($dataJawaban, $soal->id);
                                $jawabanBenar = $soal->jawaban;
                            @endphp
                            @foreach (['A', 'B', 'C', 'D'] as $option)
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="{{ $option }}"
                                        disabled
                                        {{ $jawabanPelamar && $jawabanPelamar->pilihan_jawaban === $option ? 'checked' : '' }}>
                                    @if ($soal->{'file_input_pilihan_' . strtolower($option)})
                                        <!-- Pemeriksaan apakah kolom berisi gambar pada pilihan -->
                                        <img width="350" height="350"
                                            src="{{ asset('file-pertanyaan/' . $soal->{'file_input_pilihan_' . strtolower($option)}) }}"
                                            alt="Pilihan {{ $option }} Image">
                                    @else
                                        <label for="pilihan_{{ $soal->id }}_{{ $option }}">
                                            {{ $soal->{'pilihan_' . strtolower($option)} }}
                                        </label>
                                    @endif
                                    @if ($jawabanPelamar)
                                        @if ($jawabanPelamar->pilihan_jawaban === $option)
                                            @if ($jawabanPelamar->pilihan_jawaban === $jawabanBenar)
                                                <!-- Jawaban benar, berikan ikon centang -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-check2 text-green-700"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                </svg>
                                            @else
                                                <!-- Jawaban salah, berikan ikon "X" -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-x-lg text-red-700" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                                                </svg>
                                            @endif
                                        @elseif ($soal->jawaban === $option)
                                            <!-- Jawaban benar, berikan ikon centang -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-check2 text-green-700" viewBox="0 0 16 16">
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
            </div>
        </div>
    </div>

    <?php $showSidebar = false; ?>
@endsection
