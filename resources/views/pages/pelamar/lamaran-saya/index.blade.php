@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="px-12 pt-5 text-black">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Lamaran Saya
                    </h2>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-base text-left text-black dark:text-gray-400">
                        <thead
                            class="text-md border-x border-gray-300 text-gray-700 bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">No</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Posisi Dilamar</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Status</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tanggal Melamar</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tanggal Diputuskan</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Aksi</h1>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @if (count($data) == 0)
                                <tr
                                    class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4" colspan="6">
                                        <h1 class="flex w-full justify-center">Anda belum melamar pekerjaan</h1>
                                    </td>
                                </tr>
                            @else
                                @foreach ($data as $index => $item)
                                    <tr
                                        class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">{{ $index + 1 }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">
                                                {{ $item->lowonganPekerjaan->jabatan->nama }}
                                            </h1>
                                        </td>
                                        <td class="px-6 py-4 flex justify-center">
                                            @if ($item->status_lamaran == 'Ditolak')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    @disabled(true)>Lamaran Ditolak</button>
                                            @elseif($item->status_lamaran == 'Diterima')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                                    @disabled(true)>Lamaran Diterima</button>
                                            @elseif($item->status_lamaran == 'Divalidasi')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-900"
                                                    @disabled(true)>Lamaran Divalidasi</button>
                                            @elseif($item->status_lamaran == 'Tahap Tes Potensi Akademik')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                                    @disabled(true)>Tahap Tes Potensi Akademik</button>
                                            @elseif($item->status_lamaran == 'Tahap Tes Potensi Akademik Ditolak')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    @disabled(true)>Tahap Tes Potensi Akademik Ditolak</button>
                                            @elseif($item->status_lamaran == 'Tahap Pengoreksian Tes Potensi Akademik')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-cyan-800 hover:bg-cyan-900 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-900"
                                                    @disabled(true)>Tahap Pengoreksian Tes Potensi
                                                    Akademik</button>
                                            @elseif($item->status_lamaran == 'Pelamar Disetujui')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                                    @disabled(true)>Pelamar Disetujui</button>
                                            @elseif($item->status_lamaran == 'Tahap Wawancara')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    @disabled(true)>Tahap Wawancara</button>
                                            @elseif($item->status_lamaran == 'Tahap Wawancara Ditolak')
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    @disabled(true)>Tahap Wawancara Ditolak</button>
                                            @else
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"
                                                    @disabled(true)>Lamaran Diproses</button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y, H:i:s') }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($item->updated_at == null)
                                                <h1 class="flex w-full justify-center">
                                                    -</h1>
                                            @else
                                                <h1 class="flex w-full justify-center">
                                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y, H:i:s') }}
                                                </h1>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">
                                                @php
                                                    $pelamarIdEncrypt = Crypt::encrypt($item->id);
                                                    $lowonganPekerjaanIdEncrypt = Crypt::encrypt($item->lowonganPekerjaan->id);
                                                @endphp
                                                {{-- Detail --}}
                                                <a href="/lamaran-saya/detail/{{ $pelamarIdEncrypt }}/{{ $lowonganPekerjaanIdEncrypt }}"
                                                    class="{{ $title === 'Detail Pelamar' }} text-black mr-2 flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                        fill="currentColor" class="bi bi-person-lines-fill mt-0.5"
                                                        viewBox="0 0 17 17">
                                                        <path
                                                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                    </svg>
                                                    <p class="ml-1">Detail Lamaran</p>
                                                </a>
                                                {{-- Batalkan Lamaran --}}
                                                @if ($item->status_lamaran == 'Proses')
                                                    <button id="batalLamaranButton_{{ $item->id }}"
                                                        data-modal-target="modal-batalkan-lamaran"
                                                        data-modal-toggle="modal-batalkan-lamaran"
                                                        class="text-black mr-1 flex bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                        type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                            height="17" fill="currentColor"
                                                            class="bi bi-person-lines-fill mt-0.5" viewBox="0 0 17 17">
                                                            <path
                                                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                        </svg>
                                                        <p class="ml-1">Batalkan Lamaran</p>
                                                    </button>

                                                    <div id="batalLamaranActionModal" tabindex="-1"
                                                        class="flex hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                                            <div
                                                                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <div class="p-4 md:p-5 text-center">
                                                                    <svg class="mx-auto mb-4 text-red-700 w-12 h-12 dark:text-red-200"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 20 20">
                                                                        <path stroke="currentColor" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                    </svg>
                                                                    <h3
                                                                        class="mb-5 text-lg font-normal text-black dark:text-gray-400">
                                                                        Apakah Anda yakin ingin membatalkan lamaran ?</h3>
                                                                    <button id="cancel"
                                                                        data-modal-hide="modal-batalkan-lamaran"
                                                                        type="button"
                                                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                                        cancel</button>
                                                                    <button id="confirm"
                                                                        data-modal-hide="modal-batalkan-lamaran"
                                                                        type="button"
                                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                        <a href="/lamaran-saya/delete/{{ $item->id }}">Ya,
                                                                            Saya
                                                                            Yakin</a>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </h1>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $data->links() }}
                    @if ($data->hasPages())
                        <div class="pagination-links pt-6">
                            {{ $data->appends(['search' => $searchTerm])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("batalLamaranActionModal");
            var cancelButton = document.getElementById("cancel");

            // Event listener untuk tombol "Batalkan Lamaran"
            document.querySelectorAll('[data-modal-toggle="modal-batalkan-lamaran"]').forEach(function(button) {
                button.addEventListener("click", function() {
                    modal.classList.remove("hidden");
                });
            });

            // Event listener untuk tombol "cancel" pada modal
            cancelButton.addEventListener("click", function() {
                modal.classList.add("hidden");
            });
        });
    </script>
@endsection
