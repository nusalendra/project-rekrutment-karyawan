@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto h-216 mt-2 rounded">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-7">Tambah Data</h2>

                <form action="{{ route('subkriteria-update', $subkriteria->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="flex mb-1">
                            <div class="w-1/2 mx-3">
                                <label for="jabatan_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan <span
                                        class="text-red-700">*</span></label>
                                <select id="jabatan_id" name="jabatan_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled>Pilih Jabatan</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $subkriteria->jabatan_id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex mb-1">
                            <div class="w-1/2 mx-3 mt-5">
                                <label for="kriteria_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kriteria <span
                                        class="text-red-700">*</span></label>
                                <select id="kriteria_id" name="kriteria_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled>Pilih Kriteria</option>
                                    @foreach ($kriteria as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $subkriteria->kriteria_id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex mb-1">
                            {{-- Nama Subkriteria --}}
                            <div class="w-1/2 mx-3 mt-5">
                                <label for="nama"
                                    class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Subkriteria <span
                                        class="text-red-700">*</span></label>
                                <input required type="text" id="nama" name="nama"
                                    value="{{ $subkriteria->nama }}" placeholder="Masukkan Nama Subkriteria"
                                    title="Tidak diperbolehkan menggunakan karakter khusus"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex mx-3 mt-5">
                        <a href="/subkriteria"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
                    </div>
            </div>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jabatan_id').change(function() {
                var selectedJabatanId = $(this).val();
                $.ajax({
                    url: '/subkriteria/get-kriteria/' + selectedJabatanId,
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
        });
    </script>

    <?php $showSidebar = false; ?>
@endsection
