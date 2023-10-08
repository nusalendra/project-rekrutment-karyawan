@extends('layouts.app-manajer')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="px-12 pt-9 text-black">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Subkriteria
                    </h2>
                    <div class="flex space-x-6 items-center">
                        <a href="/subkriteria/create"
                            class="{{ $title === 'Tambah Data' }} w-36 h-8 text-black flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill-add my-2" viewBox="0 0 16 16">
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path
                                    d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                            </svg>
                            <p class="my-1 ml-1">Tambah Data</p>
                        </a>
                    </div>
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
                            placeholder="Jabatan / Kriteria / Subkriteria...">
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
                                    <h1 class="flex w-full justify-center">Jabatan</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Kriteria</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Tipe Kriteria</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Subkriteria</h1>
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
                                        <h1 class="flex w-full justify-center">{{ $index + $data->firstItem() }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->nama_jabatan }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->nama_kriteria }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->tipe }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->nama_subkriteria }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">
                                            @php
                                                $subkriteriaId = Crypt::encrypt($item->id);
                                            @endphp
                                            {{-- Edit --}}
                                            <a href="/subkriteria/edit/{{ $subkriteriaId }}"
                                                class="{{ $title === 'Edit Data' }} text-black mr-1 flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square my-2"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            {{-- Delete --}}
                                            <a href="/subkriteria/delete/{{ $item->id }}"
                                                class="text-black flex bg-yellow-300 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3 my-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </a>
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
        let searchTerm = ''; // Variabel untuk menyimpan term pencarian saat ini
        const tableBody = document.getElementById('tableBody');
        const paginationLinks = document.querySelector('.pagination-links');

        // Fungsi untuk memuat data dengan parameter pencarian dan halaman
        const loadData = async (searchTerm, page) => {
            try {
                const response = await fetch(`/subkriteria?search=${searchTerm}&page=${page}`);
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
