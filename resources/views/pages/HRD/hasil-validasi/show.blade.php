@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="flex-1 mt-2 ml-12 text-blue-600">
            </div>
            <div class="px-12 pt-5 text-black">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="flex h-full font-bold text-gray-700 items-center drop-shadow-md text-xl ">Data Hasil Validasi
                        Pelamar
                    </h2>
                </div>
                <div class="flex mb-4">
                    <a href="/hasil-validasi"
                        class="mr-2 text-white bg-cyan-500 hover:bg-cyan-600 border border-cyan-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"">
                        <p class="font-semibold text-sm">Kembali</p>
                    </a>

                    <button type="button"
                        class="text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                        id="toggleButton">
                        Pilih Pelamar
                    </button>

                    <button type="button"
                        class="text-white mr-2 bg-red-700 hover:bg-red-800 border border-red-700 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                        id="cancelButton" style="display: none;">
                        Batal
                    </button>

                    @php
                        $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaanIdDecrypt);
                    @endphp
                    <form
                        action="{{ route('kirim-notifikasi-pelamar', ['lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="pilihPelamar[]" id="pilihPelamar">
                        <button type="submit"
                            class="text-white bg-green-600 hover:bg-green-700 border border-green-600 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                            id="sendButton" style="display: none;">
                            Setujui Lamaran & Kirim Notifikasi
                        </button>
                    </form>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-base text-left text-black dark:text-gray-400">
                        <thead
                            class="text-md border-x border-gray-300 text-gray-700 bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-start"></h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Peringkat</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Nama Lengkap</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Status Lamaran</h1>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <h1 class="flex w-full justify-center">Skor Hasil Validasi</h1>
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
                                        <input type="checkbox" name="pilihPelamar[]" value="{{ $item->id }}"
                                            data-pelamar-id="{{ $item->id }}" disabled>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $index + 1 }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->nama_user }}</h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ $item->status_lamaran }}
                                        </h1>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">{{ number_format($item->hasil_penilaian, 3) }}</h1>
                                    </td>                                    
                                    {{-- <td class="px-6 py-4">
                                        <h1 class="flex w-full justify-center">
                                            @php
                                                $pelamarIdEncrypt = Crypt::encrypt($item->id);
                                                $lowonganPekerjaanIdEncrypt = Crypt::encrypt($lowonganPekerjaanIdDecrypt);
                                            @endphp
                                            
                                            <a href="{{ route('hasil-validasi-detail', ['pelamarId' => $pelamarIdEncrypt, 'lowonganPekerjaanId' => $lowonganPekerjaanIdEncrypt]) }}"
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
                                    </td> --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const checkboxes = document.querySelectorAll('input[name="pilihPelamar[]"]');
        const pilihPelamarInput = document.getElementById('pilihPelamar'); // Input hidden
        const toggleButton = document.getElementById('toggleButton');
        const cancelButton = document.getElementById('cancelButton');
        const sendButton = document.getElementById('sendButton');
        const errorContainer = document.getElementById('errorContainer');

        function toggleButtons(activateSendButton) {
            checkboxes.forEach(checkbox => {
                checkbox.disabled = !activateSendButton;
            });

            toggleButton.style.display = 'none';
            cancelButton.style.display = activateSendButton ? 'inline-block' : 'none';
            sendButton.style.display = activateSendButton ? 'inline-block' : 'none';
        }

        toggleButton.addEventListener('click', function() {
            toggleButtons(true);
        });

        cancelButton.addEventListener('click', function() {
            checkboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });

            toggleButtons(false); // Memanggil fungsi toggleButtons dengan parameter false
            toggleButton.style.display = 'inline-block'; // Menampilkan kembali tombol "Pilih Pelamar"
        });

        sendButton.addEventListener('click', function() {
            const selectedPelamar = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedPelamar.push(checkbox.value);
                }
            });

            console.log(selectedPelamar);

            if (selectedPelamar.length === 0) {
                errorContainer.textContent = 'Pilih setidaknya satu pelamar sebelum mengirim notifikasi.';
                return;
            }

            // errorContainer.textContent = ''; // Menghapus pesan kesalahan sebelum menampilkan yang baru

            pilihPelamarInput.value = selectedPelamar.join(',');

            $.ajax({
                url: '/hasil-validasi/kirim-notifikasi/' + encodeURIComponent(
                    '{{ $lowonganPekerjaanIdEncrypt }}'),
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pilihPelamar: selectedPelamar
                },
                success: function(response) {
                    if (response.error) {
                        console.error("Error: " + response.error);
                    } else {
                        console.log(response);
                        checkboxes.forEach(checkbox => {
                            checkbox.disabled = true;
                        });
                        toggleButtons(false);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const selectedPelamar = [];
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        selectedPelamar.push(checkbox.value);
                    }
                });
                pilihPelamarInput.value = selectedPelamar.join(',');
            });
        });
    </script>
@endsection
