@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="/pengukuran/create" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="flex mb-1">
                            <div class="w-1/2 mx-3">
                                <label for="jabatan_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan <span
                                        class="text-red-700">*</span></label>
                                <select id="jabatan_id" name="jabatan_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected @disabled(true)>Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/2 mx-3">
                                <label for="kriteria_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kriteria <span
                                        class="text-red-700">*</span></label>
                                <select id="kriteria_id" name="kriteria_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected @disabled(true)>Pilih Kriteria</option>
                                </select>
                            </div>
                            <div class="w-1/2 mx-3">
                                <label for="subkriteria_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subkriteria <span
                                        class="text-red-700">*</span></label>
                                <select id="subkriteria_id" name="subkriteria_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected @disabled(true)>Pilih Subkriteria</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex mb-1">
                            <div class="w-1/2 mx-3 mt-5">
                                <label for="nama"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Pengukuran <span
                                        class="text-red-700">*</span></label>
                                <input required type="text" id="nama" name="nama"
                                    placeholder="Masukkan Nama Pengukuran"
                                    title="Tidak diperbolehkan menggunakan karakter khusus"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-1/2 mx-3 mt-5">
                                <label for="skor"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Skor <span
                                        class="text-red-700">*</span></label>
                                <input required type="text" id="skor" name="skor"
                                    placeholder="Masukkan Skor"
                                    title="Tidak diperbolehkan menggunakan karakter khusus"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                        <div class="mx-3 mt-5">
                            <label for="keterangan"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Keterangan Pengukuran (Opsional)</label>
                            <input required type="text" id="keterangan" name="keterangan"
                                placeholder="Contoh : Memilih IPK C apabila IPK < 3"
                                title="Tidak diperbolehkan menggunakan karakter khusus"
                                class="w-full h-28 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/pengukuran"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jabatan_id').change(function() {
                var selectedJabatanId = $(this).val();
                $.ajax({
                    url: '/pengukuran/get-kriteria/' + selectedJabatanId,
                    type: 'GET',
                    success: function(response) {
                        var kriteriaSelect = $('#kriteria_id');
                        kriteriaSelect.empty(); // Hapus opsi kriteria sebelumnya
                        kriteriaSelect.append($('<option>').text('Pilih Kriteria').attr(
                            'disabled', 'disabled').attr('selected', 'selected'));
                        $.each(response.kriteria, function(index, kriteria) {
                            kriteriaSelect.append($('<option>').text(kriteria.nama)
                                .attr('value', kriteria.id));
                        });
                    }
                });
            });

            $('#kriteria_id').change(function() {
                var selectedKriteriaId = $(this).val();
                $.ajax({
                    url: '/pengukuran/get-subkriteria/' + selectedKriteriaId,
                    type: 'GET',
                    success: function(response) {
                        var subkriteriaSelect = $('#subkriteria_id');
                        subkriteriaSelect.empty(); // Hapus opsi kriteria sebelumnya
                        subkriteriaSelect.append($('<option>').text('Pilih Subkriteria').attr(
                            'disabled', 'disabled').attr('selected', 'selected'));
                        $.each(response.subkriteria, function(index, subkriteria) {
                            subkriteriaSelect.append($('<option>').text(subkriteria
                                    .nama)
                                .attr('value', subkriteria.id));
                        });
                    }
                });
            });
        });
    </script>

    <?php $showSidebar = false; ?>
@endsection
