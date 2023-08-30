@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="{{ route('jabatanUpdate', $jabatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex mb-1">
                        {{-- Nama Jabatan --}}
                        <div class="w-1/2 mx-3">
                            <label for="nama"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jabatan <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="nama" name="nama" value="{{ $jabatan->nama }}"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                placeholder="Masukkan Jabatan Kosong"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="w-1/2 mx-3">
                            <label for="gaji"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Gaji <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="gaji" name="gaji" value="{{ $jabatan->gaji }}"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                placeholder="Tambahkan Kisaran Nominal Gaji"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full mx-3">
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Jabatan <span
                                    class="text-red-700">*</span></label>
                            <textarea
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="deskripsi" id="" cols="30" rows="10" placeholder="Tulis Deskripsi Jabatan...">{{ $jabatan->deskripsi }}</textarea>
                            {{-- <input required type="hidden" id="deskripsi" name="deskripsi"
                                value="{{ $jabatan->deskripsi }}">
                            <trix-editor input="deskripsi" class="trix-content"
                                placeholder="Tulis Deskripsi Jabatan..."></trix-editor> --}}
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full mx-3">
                            <label for="kriteria"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kriteria <span
                                    class="text-red-700">*</span></label>
                            <textarea
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="kriteria" id="" cols="30" rows="10" placeholder="Tulis Kriteria Jabatan...">{{ $jabatan->kriteria }}</textarea>
                            {{-- <input required type="hidden" id="kriteria" name="kriteria" value="{{ $jabatan->kriteria }}">
                            <trix-editor input="kriteria" class="trix-content"
                                placeholder="Tulis Kriteria Jabatan..."></trix-editor> --}}
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/jabatan/index"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>

        </div>
    </div>

    <?php $showSidebar = false; ?>
    <!-- Trix Editor -->
    {{-- <link rel="stylesheet" type="text/css" href="/trix-editor/trix.css">
    <script type="text/javascript" src="/trix-editor/trix.js"></script>

    <script>
        document.addEventListener("trix-file-accept", event => {
            event.preventDefault()
        });
    </script> --}}
@endsection
