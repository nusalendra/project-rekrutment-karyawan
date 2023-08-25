@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="/periode/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        {{-- Nama Periode --}}
                        <div class="w-1/2 mx-3">
                            <label for="nama"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Periode <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="nama" name="nama" placeholder="Masukkan Nama Periode"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        {{-- Tanggal Mulai Periode --}}
                        <div class="w-1/2 mx-3 mt-5">
                            <div class="relative w-full">
                                <label for="tanggal_mulai"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    Mulai Periode <span class="text-red-700">*</span></label>
                                <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="tanggal_mulai" name="tanggal_mulai" placeholder="dd-mm-yyyy"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        </div>

                        {{-- Tanggal Akhir Periode --}}
                        <div class="w-1/2 mx-3 mt-5">
                            <div class="relative w-full">
                                <label for="tanggal_akhir"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Tanggal
                                    Akhir Periode <span class="text-red-700">*</span></label>
                                <div class="absolute mt-7 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="tanggal_akhir" name="tanggal_akhir" placeholder="dd-mm-yyyy"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/periode/index"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
    </div>

    {{-- Flatpicker script --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Menentukan tanggal/bulan/tahun flatpicker --}}
    <script>
        flatpickr(
            "#tanggal_mulai, #tanggal_akhir", {
                dateFormat: "d-m-Y",
                minDate: "today",
                allowInput: true,
            });
    </script>

    {{-- Checklist Narasumber Script --}}
    <script>
        const checkboxItems = document.querySelectorAll('.checkbox-item');
        const selectedValues = document.getElementById('selectedValues');

        checkboxItems.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let values = [];
                checkboxItems.forEach(function(item) {
                    if (item.checked) {
                        values.push(item.nextElementSibling.textContent);
                    }
                });
                selectedValues.textContent = values.join(', ');
            });
        });
    </script>

    <?php $showSidebar = false; ?>
@endsection
