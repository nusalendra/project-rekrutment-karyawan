@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto mt-2 rounded overflow-y-auto max-h-[800px]">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-2">Isi Data Lamaran</h2>
                <label for="" class="text-sm font-medium text-gray-900 dark:text-white mb-3">Pilih
                    kriteria dengan status anda saat ini dengan benar !</label><br>
                <form class="mt-4" action="/lamar/ {{ $lowonganPekerjaan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="lowongan_pekerjaan_id" value="{{ $lowonganPekerjaan->id }}">
                    <input type="hidden" name="periode_id" value="{{ $lowonganPekerjaan->periode->id }}">
                    <input type="hidden" name="jabatan_id" value="{{ $lowonganPekerjaan->jabatan->id }}">

                    @foreach ($kriteriaWithSubkriteria as $kriteria)
                        <label class="text-base font-semibold text-gray-900 dark:text-white">{{ $kriteria->nama }}</label>
                        @foreach ($kriteria->subkriteria as $subkriteria)
                            <div class="flex items-center">
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $subkriteria->nama }}" disabled>
                                <div class="p-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z" />
                                    </svg>
                                </div>
                                <select id="kriteria_{{ $kriteria->id }}_{{ $subkriteria->id }}"
                                    name="pengukuran_id[{{ $kriteria->id }}][{{ $subkriteria->id }}]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option selected disabled></option>
                                    @foreach ($subkriteria->pengukuran as $pengukuran)
                                        <option value="{{ $pengukuran->id }}">{{ $pengukuran->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach ($subkriteria->pengukuran as $pengukuran)
                                <li class="text-xs ml-5">{{ $pengukuran->keterangan }}</li>
                            @endforeach
                            <div class="pt-2.5 mb-5">
                                <label for="" class="text-xs font-bold text-gray-900 dark:text-white">Upload Dokumen
                                    Pendukung (File : pdf)</label><br>
                                <input type="file" name="dokumen[{{ $kriteria->id }}][{{ $subkriteria->id }}][]"
                                    value="{{ $subkriteria->id }}" accept="application/pdf"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full mt-1.5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    multiple>
                                <label for="" class="text-xs font-medium">Jika terdapat banyak file disarankan untuk
                                    penggabungan file</label>
                            </div>
                        @endforeach
                    @endforeach

                    <div class="flex mt-5">
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
