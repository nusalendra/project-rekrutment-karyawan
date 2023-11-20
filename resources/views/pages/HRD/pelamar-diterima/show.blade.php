@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">

            <div class="px-12 pt-5 text-black">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Data Lamaran Pelamar
                        Diterima
                    </h2>
                </div>
                <div class="flex mb-4">
                    <a href="/pelamar-diterima"
                        class="mr-2 text-white bg-cyan-500 hover:bg-cyan-600 border border-cyan-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"">
                        <p class="font-semibold text-sm">Kembali</p>
                    </a>

                    @php
                        $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaanIdDecrypt);
                    @endphp
                    <form action="{{ route('validasi', ['lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                        method="POST">
                        @csrf

                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="block text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center"
                            type="button">
                            Validasi Semua Pelamar
                        </button>
                        <div id="popup-modal" tabindex="-1"
                            class="flex hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-stone-200 rounded-lg  dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-md text-center font-normal text-gray-500 dark:text-gray-400">
                                            Ingin
                                            melakukan validasi semua pelamar?</h3>
                                        <h3 class="text-lg font-bold text-red-500 dark:text-red-400">Harap
                                            Dimengerti</h3>
                                        <h3 class="mb-5 text-sm font-semibold text-red-500 dark:text-red-400">
                                            Pastikan hanya melakukan validasi sekali karena jika melakukan lebih dari satu
                                            kali dapat menyebabkan ketidakselarasan skor pelamar!!!</h3>
                                        <div class="flex justify-center">
                                            <button data-modal-hide="popup-modal" type="button"
                                                class="me-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Kembali</button>
                                            <button data-modal-hide="popup-modal" type="submit"
                                                class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Lanjutkan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                    <h1 class="flex w-full justify-center">Nama Lengkap</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Status Lamaran</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tanggal Melamar</h1>
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Aksi</h1>
                                </th> --}}
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
                                        <h1 class="flex w-full justify-center">{{ $item->user->name }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->status_lamaran }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y, H:i:s') }}</h1>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $data->links() }} --}}
                    {{-- @if ($data->hasPages())
                    <div class="pagination-links pt-6">
                        {{ $data->appends(['search' => $searchTerm])->links() }}
                    </div>
                @endif --}}
                </div>
            </div>
        </div>
    </div>
    <?php $showSidebar = false; ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-modal-toggle]').on('click', function() {
                var targetModalId = $(this).data('modal-toggle');
                $('#' + targetModalId).toggleClass('hidden');
            });

            $('[data-modal-hide]').on('click', function() {
                var targetModalId = $(this).data('modal-hide');
                $('#' + targetModalId).addClass('hidden');
            });
        });
    </script>
@endsection
