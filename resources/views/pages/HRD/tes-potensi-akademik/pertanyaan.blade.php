@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-screen mx-auto">
        <div class="bg-white bg-auto rounded h-full">
            <div class="px-11 pt-9 text-black ">
                <h2 class="font-bold text-gray-700 drop-shadow-md text-xl mb-8">Pertanyaan Tes Potensi Akademik</h2>
                <div class="grid grid-cols-2 mb-6 ">
                    <div class="rounded border border-neutral-300 py-4 px-6">
                        <div class="mb-3">
                            <label for="" class="w-32 text-right font-bold text-gray-700">Form Pertanyaan Tes</label>
                        </div>
                        <form action="{{ route('tes-potensi-akademik-store-pertanyaan', $tesPotensiAkademikId) }}"
                            method="post" class="w-full grid space-y-6">
                            @csrf
                            <input type="hidden" name="tes_potensi_akademik_id" value="{{ $tesPotensiAkademikId }}">

                            <div class="flex justify-between items-center mb-6">
                                <label for="pertanyaan" class="w-1/5 pr-4 text-left text-gray-700">Pertanyaan</label>
                                <div class="flex-1">
                                    <textarea required name="pertanyaan" id="pertanyaan" rows="1" oninput="autoResizeTextarea(this)"
                                        class="w-full pertanyaan rounded-md appearance-none border border-neutral-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent"></textarea>
                                    <input
                                        class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" name="file_input_pertanyaan" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">File Type
                                        : PNG / JPG</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="pilihan_a" class="w-1/5 pr-4 text-left text-gray-700">A</label>
                                <div class="flex-1">
                                    <textarea required type="text" name="pilihan_a" id="pilihan_a" rows="1" oninput="autoResizeTextarea(this)"
                                        class="w-full pertanyaan rounded-md appearance-none border border-neutral-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent"></textarea>
                                    <input
                                        class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" name="file_input_pilihan_a" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">File Type
                                        : PNG / JPG</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="pilihan_b" class="w-1/5 pr-4 text-left text-gray-700">B</label>
                                <div class="flex-1">
                                    <textarea required type="text" name="pilihan_b" id="pilihan_b" rows="1" oninput="autoResizeTextarea(this)"
                                        class="w-full pertanyaan rounded-md appearance-none border border-neutral-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent"></textarea>
                                    <input
                                        class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" name="file_input_pilihan_b" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">File Type
                                        : PNG / JPG</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="pilihan_c" class="w-1/5 pr-4 text-left text-gray-700">C</label>
                                <div class="flex-1">
                                    <textarea required type="text" name="pilihan_c" id="pilihan_c" rows="1" oninput="autoResizeTextarea(this)"
                                        class="w-full pertanyaan rounded-md appearance-none border border-neutral-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent"></textarea>
                                    <input
                                        class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" name="file_input_pilihan_c" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">File Type
                                        : PNG / JPG</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <label for="pilihan_d" class="w-1/5 pr-4 text-left text-gray-700">D</label>
                                <div class="flex-1">
                                    <textarea required type="text" name="pilihan_d" id="pilihan_d" rows="1" oninput="autoResizeTextarea(this)"
                                        class="w-full rounded-md appearance-none border border-neutral-300 py-2 px-2 bg-white text-gray-700 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-600 focus:border-transparent"></textarea>
                                    <input
                                        class="block w-full text-sm file_input text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_input" name="file_input_pilihan_d" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">File Type
                                        : PNG / JPG</p>
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
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->pertanyaan }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->pilihan_a }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->pilihan_b }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->pilihan_c }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center text-gray-600">{{ $pertanyaan->pilihan_d }}
                                        </h1>
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
        $(document).ready(function() {
            $(".pertanyaan").on("input", function() {
                $(this).parent().find(".file_input").prop("required", !$(this).val());
            });

            $(".file_input").on("input", function() {
                $(this).parent().find(".pertanyaan").prop("required", !$(this).val());
            });
        });
    </script>
    <?php $showSidebar = false; ?>
@endsection
