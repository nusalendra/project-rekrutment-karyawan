@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="flex-1 mt-2 ml-12 text-blue-600">
            </div>
            <div class="px-12 pt-5 text-black">
                <div class="flex items-center mb-8">
                    <a href="/kandidat-posisi"
                        class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2">
                        <p class="font-semibold text-sm">Kembali</p>
                    </a>
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Data Kandidat</h2>
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
                                    <h1 class="flex w-full justify-center">Email</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Nomor Handphone</h1>
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
                                        <h1 class="flex w-full justify-center">{{ $item->nama_user }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->email }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->nomor_handphone }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">
                                            @php
                                                $pelamarIdEncrypt = Crypt::encrypt($item->id);
                                                $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaanIdDecrypt);
                                            @endphp

                                            <a href="{{ route('kandidat-posisi-detail', ['pelamarId' => $pelamarIdEncrypt, 'lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                                                class="{{ $title === 'Detail Pelamar' }} text-black mr-1 flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    fill="currentColor" class="bi bi-person-lines-fill mt-0.5"
                                                    viewBox="0 0 17 17">
                                                    <path
                                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                                </svg>
                                                <p class="ml-1">Detail</p>
                                            </a>
                                        </h1>
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
@endsection
