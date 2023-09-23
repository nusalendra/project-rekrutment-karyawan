@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded overflow-y-auto max-h-[820px]">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="/jabatan/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex mb-1">
                        {{-- Nama Jabatan --}}
                        <div class="w-1/2 mx-3">
                            <label for="nama"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Jabatan <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="nama" name="nama"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                placeholder="Masukkan Jabatan Kosong"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="w-1/2 mx-3">
                            <label for="gaji_awal"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Gaji Awal <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="gaji_awal" name="gaji_awal"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                placeholder="Tambahkan Kisaran Nominal Gaji Awal"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="w-1/2 mx-3">
                            <label for="gaji_akhir"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Gaji Akhir <span
                                    class="text-red-700">*</span></label>
                            <input required type="text" id="gaji_akhir" name="gaji_akhir"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                placeholder="Tambahkan Kisaran Nominal Gaji Akhir"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full mx-3">
                            <label for="deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Jabatan <span
                                    class="text-red-700">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full mx-3">
                            <label for="benefit_pekerjaan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Benefit Pekerjaan <span
                                    class="text-red-700">*</span></label>
                            <textarea class="form-control" id="benefit_pekerjaan" name="benefit_pekerjaan"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full mx-3">
                            <label for="kriteria"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kriteria <span
                                    class="text-red-700">*</span></label>
                            <textarea class="form-control" id="kriteria" name="kriteria"></textarea>
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/jabatan"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <?php $showSidebar = false; ?>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#benefit_pekerjaan'), {
                toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#kriteria'), {
                toolbar: ['bold', 'italic', 'underline', 'bulletedList', 'numberedList', 'undo', 'redo']
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            padding-left: 25px;
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection
