@extends('layouts.app-tes-tpa')

@section('content')
    <div class="w-screen h-screen px-28 pt-14 pb-6 bg-slate-100 mx-auto overflow-y-auto">
        <div class="h-auto w-full bg-white bg-auto rounded-xl border-2 border-gray-300">
            <div class="flex flex-col w-full h-full py-12 px-16 text-black">

                <form action="{{ route('kirim-jawaban', ['id' => $id, 'pelamarId' => $pelamarTesId->id]) }}"
                    class="w-full h-auto" method="POST">

                    @csrf
                    @foreach ($soalTes as $soal)
                        <input type="hidden" name="pertanyaan[{{ $soal->id }}]" value="{{ $soal->id }}">
                        <div class="w-full h-auto space-y-3 mb-6">
                            <div class="flex space-x-3 text-xl font-bold">
                                <h1>{{ $loop->index + 1 }}.</h1>
                                <h1 class="">{{ $soal->pertanyaan }}</h1>
                            </div>
                            <div class="pl-6 space-y-3">
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="A" required>
                                    <label for="pilihan_a_{{ $loop->index + 1 }}">{{ $soal->pilihan_a }}</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="B" required>
                                    <label for="pilihan_b_{{ $loop->index + 1 }}">{{ $soal->pilihan_b }}</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="C" required>
                                    <label for="pilihan_c_{{ $loop->index + 1 }}">{{ $soal->pilihan_c }}</label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <input type="radio" name="pilihan[{{ $soal->id }}]" value="D" required>
                                    <label for="pilihan_d_{{ $loop->index + 1 }}">{{ $soal->pilihan_d }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="w-full flex justify-center">
                        <button type="submit"
                            class="py-1.5 px-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">SIMPAN JAWABAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
