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
                                    <h1 class="flex w-full justify-center">Status Lamaran</h1>
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
                            @foreach ($data as $index => $item)
                                <tr
                                    class="bg-white border-b border-x border-gray-300 dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $index + 1 }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->lowonganPekerjaan->jabatan->nama }}
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
                                        @elseif($item->status_lamaran == 'Disetujui')
                                            <button type="button"
                                                class="focus:outline-none text-white bg-green-800 hover:bg-green-900 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                                                @disabled(true)>Lamaran Disetujui</button>
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
                                                {{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y, H:i:s') }}</h1>
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
                                                class="{{ $title === 'Detail Pelamar' }} text-black mr-1 flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    fill="currentColor" class="bi bi-person-lines-fill mt-0.5"
                                                    viewBox="0 0 17 17">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                                <p class="ml-1">Detail Lamaran</p>
                                            </a>
                                            {{-- Batalkan Lamaran --}}
                                            <button id="showModal"
                                                class="text-black mr-1 flex bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    fill="currentColor" class="bi bi-person-lines-fill mt-0.5"
                                                    viewBox="0 0 17 17">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                                <p class="ml-1">Batalkan Lamaran</p>
                                            </button>
                                            <div id="modal"
                                                class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                                                <div class="bg-white rounded-lg p-8 w-1/2">
                                                    <h2 class="text-xl font-semibold text-red-600  mb-4">Konfirmasi</h2>
                                                    <p>Apakah Anda yakin ingin membatalkan lamaran?</p>
                                                    <div class="mt-6 flex justify-end">
                                                        <button id="cancel"
                                                            class="bg-gray-400 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded mr-4">Tidak</button>
                                                        <button id="confirm"
                                                            class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded"><a
                                                                href="/lamaran-saya/delete/{{ $item->id }}">Ya, Saya
                                                                Yakin</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </h1>
                                    </td>
                                </tr>
                            @endforeach
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
        const showModalButton = document.getElementById('showModal');
        const modal = document.getElementById('modal');
        const confirmButton = document.getElementById('confirm');
        const cancelButton = document.getElementById('cancel');

        showModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        confirmButton.addEventListener('click', () => {
            // Lakukan tindakan yang sesuai ketika pengguna menekan OK
            modal.classList.add('hidden');
        });

        cancelButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
@endsection
