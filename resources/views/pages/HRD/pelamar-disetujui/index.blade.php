@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="px-12 pt-9 text-black">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Lamaran Pekerjaan
                    </h2>
                </div>
                <div class="flex items-center justify-end mb-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="searchInput" value="{{ $searchTerm }}"
                            class="block w-full px-10 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari Periode / Jabatan...">
                    </div>
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
                                    <h1 class="flex w-full justify-center">Periode</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Jabatan</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tanggal Mulai s/d Tutup</h1>
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
                                    <td class="px-6 py-4" colspan="7">
                                        <h1 class="flex w-full justify-center">Tidak Ada Data Lamaran Pekerjaan</h1>
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
                                            <h1 class="flex w-full justify-center">{{ $item->periode->nama }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">{{ $item->jabatan->nama }}
                                            </h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">
                                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}
                                                s/d
                                                {{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('d-m-Y') }}</h1>
                                        </td>
                                        <td class="px-6 py-4">
                                            <h1 class="flex w-full justify-center">
                                                @php
                                                    $lowonganPekerjaanIdEncrypt = Crypt::encrypt($item->id);
                                                @endphp
                                                {{-- Edit --}}
                                                <a href="/pelamar-disetujui/data/{{ $lowonganPekerjaanIdEncrypt }}"
                                                    class="{{ $title === 'Data Validasi Pelamar' }} text-black mr-1 flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                        fill="currentColor" class="bi bi-clipboard-data-fill mt-0.5"
                                                        viewBox="0 0 17 17">
                                                        <path
                                                            d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                                                        <path
                                                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V8Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" />
                                                    </svg>
                                                    <p class="ml-1">Buka</p>
                                                </a>
                                            </h1>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let searchTerm = ''; // Variabel untuk menyimpan term pencarian saat ini
        const tableBody = document.getElementById('tableBody');
        const paginationLinks = document.querySelector('.pagination-links');

        // Fungsi untuk memuat data dengan parameter pencarian dan halaman
        const loadData = async (searchTerm, page) => {
            try {
                const response = await fetch(`/pelamar-disetujui?search=${searchTerm}&page=${page}`);
                const html = await response.text();
                const tempContainer = document.createElement('div');
                tempContainer.innerHTML = html;
                const newData = tempContainer.querySelector('#tableBody');

                if (newData) {
                    tableBody.innerHTML = newData.innerHTML;

                    // Tampilkan paginasi jika ada lebih dari satu halaman
                    if (paginationLinks) {
                        const newPaginationLinks = tempContainer.querySelector('.pagination-links');
                        if (newPaginationLinks) {
                            paginationLinks.innerHTML = newPaginationLinks.innerHTML; // Update pagination links
                        } else {
                            paginationLinks.innerHTML = ''; // Kosongkan pagination links jika tidak ada
                        }
                    }
                } else {
                    console.error('Invalid response format:', html);
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        searchInput.addEventListener('input', () => {
            searchTerm = searchInput.value; // Simpan term pencarian saat ini
            loadData(searchTerm, 1); // Ganti page ke 1 saat pencarian berubah
        });

        if (paginationLinks) {
            paginationLinks.addEventListener('click', (event) => {
                event.preventDefault();

                const hrefAttribute = event.target.getAttribute('href');

                // Periksa apakah elemen yang diklik merupakan tautan (link)
                if (hrefAttribute) {
                    const pageMatch = hrefAttribute.match(/page=(\d+)/); // Match halaman dari tautan paginate
                    if (pageMatch) {
                        const nextPage = pageMatch[1];
                        loadData(searchTerm, nextPage); // Gunakan searchTerm yang disimpan
                    }
                }
            });
        }
    </script>
    <?php $showSidebar = true; ?>
@endsection
