@extends('layouts.app-guest')

@section('content')
    <div class="flex justify-center mt-8">
        <!-- Kolom kiri: Daftar Card -->
        <div class=" text-black rounded-lg p-5 overflow-y-auto">
            <h1 class="font-semibold text-xl">Lamaran Pekerjaan</h1>
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="searchInput" value="{{ $searchTerm }}"
                    class="block w-full px-4 py-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari Posisi Jabatan...">
            </div>
            <div class="card-container mt-5">
                @foreach ($data as $item)
                    @php
                        $jabatanIdEncrypt = Crypt::encrypt($item->jabatan->id);
                    @endphp
                    <a href="#" onclick="showDetail('{{ $jabatanIdEncrypt }}')"
                        class="block max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 mb-3">
                        <div class="content overflow-y-hidden h-24">
                            <h5 class="mb-2 text-lg underline font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $item->jabatan->nama }}</h5>
                            <p class="text-xs text-gray-700 dark:text-gray-400">Lamaran Dibuka :
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}

                                {{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('d-m-Y') }}</p>
                            <p class="text-xs text-gray-700 dark:text-gray-400">Sisa Kuota Lamaran : {{ $item->kuota }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Kolom kanan: Detail Card -->
        <div id="detailCard" class="bg-white rounded-lg p-5 w-1/2 mx-3 overflow-y-auto max-h-[800px]">

        </div>
    </div>
    <style>
        .card-container {
            max-height: 620px;
            /* Atur tinggi maksimal container sesuai kebutuhan */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function showDetail(id) {
            // Mengganti URL dengan ID jabatan
            history.pushState({}, '', `/lamaran-pekerjaan/${id}`);

            // Lakukan permintaan AJAX atau tindakan lain sesuai kebutuhan
            axios.get(`/get-detail-jabatan/${id}`)
                .then(response => {
                    const detailCard = document.getElementById('detailCard');
                    detailCard.innerHTML = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
    {{-- <script>
        const periodeDropdown = document.getElementById('periode_id');
        const tanggalAwalSpan = document.getElementById('tanggal_awal');
        const tanggalAkhirSpan = document.getElementById('tanggal_akhir');

        periodeDropdown.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const tanggalAwal = selectedOption.getAttribute('data-tanggal-awal');
            const tanggalAkhir = selectedOption.getAttribute('data-tanggal-akhir');

            tanggalAwalSpan.textContent = tanggalAwal;
            tanggalAkhirSpan.textContent = tanggalAkhir;
        });
    </script> --}}
@endsection
