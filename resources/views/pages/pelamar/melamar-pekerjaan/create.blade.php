@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Data Lamaran</h2>

                <form action="/lamar/ {{ $lowonganPekerjaan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="lowongan_pekerjaan_id" value="{{ $lowonganPekerjaan->id }}">
                    <input type="hidden" name="periode_id" value="{{ $lowonganPekerjaan->periode->id }}">
                    <input type="hidden" name="jabatan_id" value="{{ $lowonganPekerjaan->jabatan->id }}">
                    <div class="mb-4">
                        <label for="kriteria" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Pilih
                            kriteria dengan status anda saat ini dengan benar !</label>
                        @foreach ($kriteriaWithSubkriteria as $kriteria)
                            <select id="kriteria_{{ $kriteria->id }}" name="kriteria[{{ $kriteria->id }}]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>{{ $kriteria->nama }}</option>
                                @foreach ($kriteria->subkriteria as $subkriteria)
                                    <option value="{{ $subkriteria->id }}">{{ $subkriteria->nama }}</option>
                                @endforeach
                            </select>
                            <br>
                        @endforeach
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/melamar-pekerjaan"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
