@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-screen mx-auto">
        <div class="bg-white bg-auto rounded h-full">
            <div class="px-11 pt-9 text-black ">
                <h2 class="font-bold text-gray-700 drop-shadow-md text-xl mb-8">Pertanyaan Tes Potensi Akademik</h2>
                <div class="grid grid-cols-1 mb-6 ">
                    <div class="rounded border border-neutral-300 py-4 px-6">
                        <div class="mb-3">
                            <label for="" class="w-32 text-right font-bold text-gray-700">Form Pertanyaan Tes</label>
                        </div>
                        <form action="{{ route('tes-potensi-akademik-store-pertanyaan', $tesPotensiAkademikId) }}"
                            method="post" enctype="multipart/form-data" class="w-full grid space-y-6">
                            @csrf
                            <input type="hidden" name="tes_potensi_akademik_id" value="{{ $tesPotensiAkademikId }}">

                            <div class="formContainer">
                                {{-- Pertanyaan --}}
                                <div class="flex justify-between items-center mb-3" data-container-id="pertanyaanContainer">
                                    <label for="pertanyaan" class="w-1/5 pr-4 text-left text-gray-700">Pertanyaan</label>
                                    <div class="flex">
                                        <select name="jenis_input_pertanyaan"
                                            class="jenisInputDropdown w-72 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="textarea">Textarea</option>
                                            <option value="file">File Input  (PNG / JPG 1MB)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1 pl-10 textareaContainer" data-input-id="textareaContainer_b">
                                        <textarea type="text" name="pertanyaan" rows="1" oninput="autoResizeTextarea(this)"
                                            class="w-full pertanyaan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex-1 pl-10 hidden fileInputContainer"
                                        data-input-id="fileInputContainer_b">
                                        <input
                                            class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input_b" accept=".png, .jpg" maxlength="1048576"
                                            name="file_input_pertanyaan" type="file">
                                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help_b">File
                                            Type : PNG / JPG (1MB)</p> --}}
                                    </div>
                                </div>
                                {{-- Pilihan A --}}
                                <div class="flex justify-between items-center mb-3" data-container-id="pilihanAContainer">
                                    <label for="pilihan_a" class="w-1/5 pr-4 text-left text-gray-700">A</label>
                                    <div class="flex">
                                        <select name="jenis_input_pilihan_a"
                                            class="jenisInputDropdown w-72  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="textarea">Textarea</option>
                                            <option value="file">File Input  (PNG / JPG 1MB)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1 pl-10 textareaContainer" data-input-id="textareaContainer_a">
                                        <textarea type="text" name="pilihan_a" rows="1" oninput="autoResizeTextarea(this)"
                                            class="w-full pertanyaan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex-1  pl-10 hidden fileInputContainer"
                                        data-input-id="fileInputContainer_a">
                                        <input
                                            class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input_a" accept=".png, .jpg" maxlength="1048576"
                                            name="file_input_pilihan_a" type="file">
                                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help_a">File
                                            Type : PNG / JPG (1MB)</p> --}}
                                    </div>
                                </div>

                                {{-- Pilihan B --}}
                                <div class="flex justify-between items-center mb-3" data-container-id="pilihanBContainer">
                                    <label for="pilihan_b" class="w-1/5 pr-4 text-left text-gray-700">B</label>
                                    <div class="flex">
                                        <select name="jenis_input_pilihan_b"
                                            class="jenisInputDropdown w-72  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="textarea">Textarea</option>
                                            <option value="file">File Input  (PNG / JPG 1MB)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1 pl-10 textareaContainer" data-input-id="textareaContainer_b">
                                        <textarea type="text" name="pilihan_b" rows="1" oninput="autoResizeTextarea(this)"
                                            class="w-full pertanyaan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex-1 pl-10 hidden fileInputContainer"
                                        data-input-id="fileInputContainer_b">
                                        <input
                                            class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input_b" accept=".png, .jpg" maxlength="1048576"
                                            name="file_input_pilihan_b" type="file">
                                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help_b">File
                                            Type : PNG / JPG (1MB)</p> --}}
                                    </div>
                                </div>
                                {{-- PIlihan C --}}
                                <div class="flex justify-between items-center mb-3" data-container-id="pilihanCContainer">
                                    <label for="pilihan_c" class="w-1/5 pr-4 text-left text-gray-700">C</label>
                                    <div class="flex">
                                        <select name="jenis_input_pilihan_c"
                                            class="jenisInputDropdown w-72  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="textarea">Textarea</option>
                                            <option value="file">File Input  (PNG / JPG 1MB)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1 pl-10 textareaContainer" data-input-id="textareaContainer_b">
                                        <textarea type="text" name="pilihan_c" rows="1" oninput="autoResizeTextarea(this)"
                                            class="w-full pertanyaan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex-1  pl-10 hidden fileInputContainer"
                                        data-input-id="fileInputContainer_b">
                                        <input
                                            class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input_b" accept=".png, .jpg" maxlength="1048576"
                                            name="file_input_pilihan_c" type="file">
                                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help_b">File
                                            Type : PNG / JPG (1MB)</p> --}}
                                    </div>
                                </div>
                                {{-- Pilihan D --}}
                                <div class="flex justify-between items-center mb-3" data-container-id="pilihanDContainer">
                                    <label for="pilihan_d" class="w-1/5 pr-4 text-left text-gray-700">D</label>
                                    <div class="flex">
                                        <select name="jenis_input_pilihan_d"
                                            class="jenisInputDropdown w-72  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="textarea">Textarea</option>
                                            <option value="file">File Input  (PNG / JPG 1MB)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1 pl-10 textareaContainer" data-input-id="textareaContainer_b">
                                        <textarea type="text" name="pilihan_d" rows="1" oninput="autoResizeTextarea(this)"
                                            class="w-full pertanyaan bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                    </div>
                                    <div class="flex-1 pl-10 hidden fileInputContainer"
                                        data-input-id="fileInputContainer_b">
                                        <input
                                            class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input_b" accept=".png, .jpg" maxlength="1048576"
                                            name="file_input_pilihan_d" type="file">
                                        {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help_b">File
                                            Type : PNG / JPG (1MB)</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <label for="jawaban" class="w-1/5 pr-4 text-left text-gray-700">Jawaban</label>
                                <div class="flex w-4/5 justify-between">
                                    <div class="flex items-center space-x-3 justify-center">
                                        <input type="radio" name="jawaban" value="A" required>
                                        <label for="pilihan_a">A</label>
                                    </div>
                                    <div class="flex items-center space-x-3 justify-center">
                                        <input type="radio" name="jawaban" value="B" required>
                                        <label for="pilihan_b">B</label>
                                    </div>
                                    <div class="flex items-center space-x-3 justify-center">
                                        <input type="radio" name="jawaban" value="C" required>
                                        <label for="pilihan_c">C</label>
                                    </div>
                                    <div class="flex items-center space-x-3 justify-center">
                                        <input type="radio" name="jawaban" value="D" required>
                                        <label for="pilihan_d">D</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <a href="/tes-potensi-akademik"
                                    class="text-gray-900 bg-white hover:bg-blue-100 focus:ring-2 border border-blue-200 focus:inline-none focus:ring-white-300 font-medium rounded text-sm px-2.5 py-1.5 text-center inline-flex items-center dark:bg-white-600 dark:hover:bg-white-700 dark:focus:ring-blue-800">Kembali</a>
                                <button type="submit"
                                    class="pointer-events-auto rounded bg-indigo-600 px-3 py-2 text-[0.8125rem] font-semibold leading-5 text-white hover:bg-indigo-500">
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-12 pb-12">
                    <table class="w-full text-base text-left text-gray-700 dark:text-gray-700">
                        <thead
                            class="text-md border-x border-gray-300 text-gray-700 bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">No</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Pertanyaan</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">A</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">B</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">C</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">D</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Jawaban</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Aksi</h1>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaanTesPotensiAkademik as $pertanyaan)
                                <tr
                                    class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <h1 class="flex w-full justify-center">{{ $loop->index + 1 }}</h1>
                                    </th>
                                    <td class="px-6 py-4">
                                        @if ($pertanyaan->pertanyaan)
                                            <h1 class="flex w-full justify-center text-gray-600 cutTextClass">
                                                {{ $pertanyaan->pertanyaan }}
                                            </h1>
                                        @else
                                            <h1 class="flex w-full justify-center text-gray-600">Soal Gambar</h1>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($pertanyaan->pilihan_a)
                                            <h1 class="flex w-full justify-center text-gray-600 cutTextClass">
                                                {{ $pertanyaan->pilihan_a }}
                                            </h1>
                                        @else
                                            <h1 class="flex w-full justify-center text-gray-600">Pilihan Soal Gambar</h1>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($pertanyaan->pilihan_b)
                                            <h1 class="flex w-full justify-center text-gray-600 cutTextClass">
                                                {{ $pertanyaan->pilihan_b }}
                                            </h1>
                                        @else
                                            <h1 class="flex w-full justify-center text-gray-600">Pilihan Soal Gambar</h1>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($pertanyaan->pilihan_c)
                                            <h1 class="flex w-full justify-center text-gray-600 cutTextClass">
                                                {{ $pertanyaan->pilihan_c }}
                                            </h1>
                                        @else
                                            <h1 class="flex w-full justify-center text-gray-600">Pilihan Soal Gambar</h1>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($pertanyaan->pilihan_d)
                                            <h1 class="flex w-full justify-center text-gray-600 cutTextClass">
                                                {{ $pertanyaan->pilihan_d }}
                                            </h1>
                                        @else
                                            <h1 class="flex w-full justify-center text-gray-600">Pilihan Soal Gambar</h1>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->jawaban }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center space-x-3">
                                            <form
                                                action="{{ route('tes-potensi-akademik-delete-pertanyaan', ['tesPotensiAkademikId' => $tesPotensiAkademikId, 'pertanyaanTesPotensiAkademikId' => $pertanyaan->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="pointer-events-auto text-white bg-red-600 hover:bg-red-400 border border-red-200 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center">Hapus</button>
                                            </form>
                                        </h1>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Menentukan tanggal/bulan/tahun flatpicker --}}
    <script>
        function autoResizeTextarea(textarea) {
            textarea.style.height = "auto"; // Set ulang tinggi textarea agar ketinggiannya bisa disesuaikan

            // Tetapkan tinggi textarea sesuai dengan scrollHeight (tinggi konten) atau minimum ketinggian (jika isinya lebih pendek)
            textarea.style.height = (textarea.scrollHeight > textarea.clientHeight ? textarea.scrollHeight : textarea
                .clientHeight) + "px";
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menangani perubahan jenis input
            function toggleInputType(container) {
                var textareaContainer = container.querySelector('.textareaContainer');
                var fileInputContainer = container.querySelector('.fileInputContainer');
                var dropdown = container.querySelector('.jenisInputDropdown');

                textareaContainer.style.display = dropdown.value === 'textarea' ? 'flex' : 'none';
                fileInputContainer.style.display = dropdown.value === 'file' ? 'flex' : 'none';
            }

            // Tangani perubahan dropdown untuk pertanyaan
            var pertanyaanContainer = document.querySelector('[data-container-id="pertanyaanContainer"]');
            toggleInputType(pertanyaanContainer); // Memastikan status awal setelah halaman dimuat

            pertanyaanContainer.addEventListener('change', function() {
                toggleInputType(pertanyaanContainer);
            });

            // Tangani perubahan dropdown dan checkbox untuk pilihan A, B, C, D
            var allInputContainers = document.querySelectorAll('[data-container-id^="pilihan"]');
            allInputContainers.forEach(function(container) {
                toggleInputType(container); // Memastikan status awal setelah halaman dimuat

                container.addEventListener('change', function() {
                    toggleInputType(container);
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk memotong teks
            function truncateText(elements, maxLength) {
                elements.forEach(function(element) {
                    var text = element.textContent.trim();
                    if (text.length > maxLength) {
                        element.textContent = text.substring(0, maxLength) + '...';
                    }
                });
            }

            // Panggil fungsi truncateText dengan kelas "cutTextClass" dan panjang maksimum yang diinginkan
            var cutTextElements = document.querySelectorAll('.cutTextClass');
            var maxLength = 30; // Tetapkan panjang maksimum yang diinginkan
            truncateText(cutTextElements, maxLength);
        });
    </script>
    <?php $showSidebar = false; ?>
@endsection
