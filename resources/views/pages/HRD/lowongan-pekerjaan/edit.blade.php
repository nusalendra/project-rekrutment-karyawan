@extends('layouts.app')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="{{ route('lowonganPekerjaanUpdate', $lowonganPekerjaan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="w-1/2 mx-3">
                            <label for="periode_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periode <span
                                    class="text-red-700">*</span></label>
                            <select id="periode_id" name="periode_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected @disabled(true)>Pilih Periode</option>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $lowonganPekerjaan->periode_id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-1/2 mx-3 mt-5">
                            <label for="jabatan_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan <span
                                    class="text-red-700">*</span></label>
                            <select id="jabatan_id" name="jabatan_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected @disabled(true)>Pilih Jabatan</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $lowonganPekerjaan->jabatan_id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kuota --}}
                        <div class="w-1/2 mx-3 mt-5">
                            <label for="kuota"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Kuota Pelamar <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="kuota" name="kuota" value="{{ $lowonganPekerjaan->kuota }}"
                                placeholder="Masukkan Total Kuota Pelamar"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/lowongan-pekerjaan/index"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
    <?php $showSidebar = false; ?>
@endsection
