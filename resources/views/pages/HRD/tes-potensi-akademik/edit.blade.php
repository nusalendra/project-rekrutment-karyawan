@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Edit Data</h2>

                <form action="{{ route('tes-potensi-akademik-update', $tesPotensiAkademik->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="w-1/2 mx-3 mt-5">
                            <div class="relative w-full">
                                <label for="nama"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Nama TPA <span
                                        class="text-red-700">*</span></label>
                                <input required type="text" id="nama" name="nama" placeholder="Masukkan Nama TPA" value="{{ $tesPotensiAkademik->nama }}"
                                    title="Tidak diperbolehkan menggunakan karakter khusus"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                        <div class="w-1/2 mx-3 mt-5">
                            <label for="lowongan_pekerjaan_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Untuk Jabatan <span
                                    class="text-red-700">*</span></label>
                            <select id="lowongan_pekerjaan_id" name="lowongan_pekerjaan_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected @disabled(true)>Pilih Jabatan</option>
                                @foreach ($lowonganPekerjaan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $tesPotensiAkademik->lowongan_pekerjaan_id ? 'selected' : '' }}>
                                        {{ $item->jabatan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        @php
                            $tanggalWaktuMulai = \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_mulai)->format('d-m-Y / H:i');
                            $tanggalWaktuSelesai = \Carbon\Carbon::parse($tesPotensiAkademik->tanggal_waktu_selesai)->format('d-m-Y / H:i');
                        @endphp
                        {{-- Tanggal & Waktu Mulai TPA --}}
                        <div class="w-1/2 mx-3 mt-5">
                            <div class="relative w-full">
                                <label for="tanggal_waktu_mulai"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    & Waktu Mulai <span class="text-red-700">*</span></label>
                                <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input required type="text" name="tanggal_waktu_mulai" id="tanggal_waktu_mulai"
                                    value="{{ $tanggalWaktuMulai }}" placeholder="dd-mm-yyyy"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        </div>
                        {{-- Tanggal & Waktu Selesai Mulai TPA --}}
                        <div class="w-1/2 mx-3 mt-5">
                            <div class="relative w-full">
                                <label for="tanggal_waktu_selesai"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    & Waktu Selesai <span class="text-red-700">*</span></label>
                                <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="tanggal_waktu_selesai" name="tanggal_waktu_selesai"
                                    value="{{ $tanggalWaktuSelesai }}" placeholder="dd-mm-yyyy" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/tes-potensi-akademik"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>

        </div>
    </div>

    {{-- Flatpicker script --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Menentukan tanggal/bulan/tahun flatpicker --}}
    <script>
        flatpickr(
            "#tanggal_waktu_mulai, #tanggal_waktu_selesai", {
                enableTime: 'true',
                dateFormat: "d-m-Y / H:i",
                minDate: "today",
                time_24hr: true,
                allowInput: true,
            });
    </script>

    <?php $showSidebar = false; ?>
@endsection
