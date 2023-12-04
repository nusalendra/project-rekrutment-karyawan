@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4 text-black">
        <div class="bg-white p-4 rounded-md shadow-md">
            <div class="flex items-center">
                <h2 class="text-2xl font-bold mx-4">Data Hasil Tes Potensi Akademik Pelamar</h2>
            </div>
            <div class="bg-white p-4 rounded-md shadow-md">
                <div class="text-md font-semibold">
                    <p class="mb-2">Status Skor Tes : </p>
                    <p class="text-red-500">>= 200 & < 500 Total Skor</p>
                    <p class="text-green-700">>= 500 & <= 800 Total Skor</p>
                </div>
                <div class="mt-5 flex flex-col space-y-2">
                    <label for="countries" class="block text-sm font-medium dark:text-white">Posisi Jabatan</label>
                    <div class="flex items-center">
                        <select id="lowonganPekerjaanSelect"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5 me-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Pilih</option>
                            @foreach ($lowonganPekerjaan as $jabatanId => $lowonganPekerjaans)
                                @foreach ($lowonganPekerjaans as $item)
                                    <option value="{{ $item->id }}">{{ $item->jabatan->nama }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <form action="{{ route('hitung-skor') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lowonganPekerjaanId" id="lowonganPekerjaanId">
                            <button type="submit"
                                class="text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Hitung
                                Skor Semua Pelamar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            @foreach ($pelamarTesPotensiAkademik->groupBy('pelamar_id') as $pelamarId => $pelamarTesGrouped)
                <!-- Satu kotak untuk satu pelamar -->
                <div class="dataContainer bg-white p-4 rounded-md shadow-md overflow-y-auto">
                    @php $firstItem = $pelamarTesGrouped->first(); @endphp
                    <h3 class="text-lg font-semibold text-blue-600 mb-2">{{ $firstItem->pelamar->user->name }}</h3>
                    @php
                        // Ambil skorTes untuk pelamar tertentu dari array
                        $skorTes = $skorTesPelamar[$firstItem->pelamar->id];
                    @endphp
                    @if ($skorTes && $skorTes->count() > 0)
                        @php $totalSkor = $skorTes->sum('skor_tes'); @endphp
                        @if ($totalSkor < 500)
                            <h4 class="text-base font-semibold mt-3">Total Skor Tes : <span
                                    class="text-red-500 ">{{ $totalSkor }}</span></h4>
                        @else
                            <h4 class="text-base font-semibold mt-3">Total Skor Tes : <span
                                    class="text-green-700 ">{{ $totalSkor }}</span>
                            </h4>
                        @endif
                    @else
                        <h4 class="text-base font-semibold mt-3">Total Skor Tes : 0</h4>
                    @endif
                    <h4 class="text-base font-semibold mt-3">Tes Potensi Akademik :</h4>
                    @foreach ($pelamarTesGrouped as $item)
                        @php
                            $pelamarTPAId = Crypt::encrypt($item->id);
                        @endphp
                        <div class="bg-blue-100 p-4 rounded-md mb-2 mt-2 transition duration-300 max-h-[150px]">
                            <h5 class="text-lg font-semibold text-blue-600 mb-2">{{ $item->tesPotensiAkademik->nama }}</h5>
                            @if ($item->updated_at)
                                <p class="text-black font-medium">Tanggal / Waktu Menyelesaikan Tes:
                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y / H:i') }}</p>
                                <span class="text-green-700 mr-2 font-semibold">Status: Sudah Dikerjakan</span>
                                <a href="/hasil-tes-potensi-akademik/koreksi-tes/{{ $pelamarTPAId }}"
                                    class="text-blue-500 hover:underline font-semibold">Koreksi Tes</a>
                            @else
                                <p class="text-red-600">Status: Belum Dikerjakan</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <?php $showSidebar = true; ?>
    <script>
        document.getElementById('lowonganPekerjaanSelect').addEventListener('change', function() {
            var selectedLowonganPekerjaanId = this.value;

            // Update nilai input hidden
            document.getElementById('lowonganPekerjaanId').value = selectedLowonganPekerjaanId;

            // Cek apakah opsi default dipilih (nilai kosong)
            if (selectedLowonganPekerjaanId) {
                // Tampilkan elemen dengan class 'dataContainer'
                var dataContainers = document.querySelectorAll('.dataContainer');
                dataContainers.forEach(container => {
                    container.style.display = 'block';
                });
            } else {
                // Sembunyikan elemen dengan class 'dataContainer'
                var dataContainers = document.querySelectorAll('.dataContainer');
                dataContainers.forEach(container => {
                    container.style.display = 'none';
                });
            }
        });

        // Jalankan secara otomatis setelah halaman dimuat
        window.addEventListener('load', function() {
            // Simulasikan perubahan agar script dijalankan saat halaman dimuat
            var event = new Event('change');
            document.getElementById('lowonganPekerjaanSelect').dispatchEvent(event);
        });
    </script>

    <script>
        document.getElementById('lowonganPekerjaanSelect').addEventListener('change', function() {
            var selectedLowonganPekerjaanId = this.value;

            // Gunakan AJAX untuk mengirim permintaan ke server
            fetch('/hasil-tes-potensi-akademik/get-pelamar-by-lowongan-pekerjaan/' + selectedLowonganPekerjaanId)
                .then(response => response.json())
                .then(data => {
                    // Update tampilan atau lakukan operasi sesuai kebutuhan
                    console.log('Data Pelamar:', data.pelamarTes);

                    // Perbarui visibilitas elemen berdasarkan hasil permintaan
                    var dataContainers = document.querySelectorAll('.dataContainer');

                    // Sembunyikan semua elemen
                    dataContainers.forEach(container => {
                        container.style.display = 'none';
                    });

                    // Tampilkan elemen yang sesuai
                    if (data.pelamarTes && data.pelamarTes.length > 0) {
                        dataContainers.forEach(container => {
                            container.style.display = 'block';
                        });
                    }

                    // Lakukan operasi sesuai kebutuhan untuk menampilkan data pelamarTes
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
