@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="content bg-white bg-auto mt-2 rounded overflow-y-auto max-h-[800px]">
            <div class="px-11 py-9 text-black">
                <h2 class="font-bold text-xl mb-2">Isi Data Lamaran</h2>
                <label for="" class="text-sm font-medium text-gray-900 dark:text-white mb-3">Pilih
                    kriteria dengan status anda saat ini dengan benar !</label><br>
                <form class="mt-4" action="/lamar/ {{ $lowonganPekerjaan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="lowongan_pekerjaan_id" value="{{ $lowonganPekerjaan->id }}">
                    <input type="hidden" name="periode_id" value="{{ $lowonganPekerjaan->periode->id }}">
                    <input type="hidden" name="jabatan_id" value="{{ $lowonganPekerjaan->jabatan->id }}">

                    @foreach ($kriteriaWithSubkriteria as $kriteria)
                        <label class="text-base font-semibold text-gray-900 dark:text-white">{{ $kriteria->nama }}</label>
                        @foreach ($kriteria->subkriteria as $subkriteria)
                            <div class="flex items-center">
                                <input type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $subkriteria->nama }}" disabled>
                                <div class="p-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z" />
                                    </svg>
                                </div>
                                <select id="kriteria_{{ $kriteria->id }}_{{ $subkriteria->id }}"
                                    name="pengukuran_id[{{ $kriteria->id }}][{{ $subkriteria->id }}]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                    <option selected disabled></option>
                                    @foreach ($subkriteria->pengukuran as $pengukuran)
                                        <option value="{{ $pengukuran->id }}">{{ $pengukuran->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach ($subkriteria->pengukuran as $pengukuran)
                                <li class="text-xs ml-5">{{ $pengukuran->keterangan }}</li>
                            @endforeach
                            <div class="pt-2.5 mb-5">
                                <label for="" class="text-xs font-bold text-gray-900 dark:text-white">Upload Dokumen
                                    Pendukung (File : pdf)</label><br>
                                <input type="file" name="dokumen[{{ $kriteria->id }}][{{ $subkriteria->id }}][]"
                                    value="{{ $subkriteria->id }}" accept="application/pdf"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full mt-1.5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    multiple>
                                <label for="" class="text-xs font-medium">Jika terdapat banyak file disarankan untuk
                                    penggabungan file</label>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="flex mt-5">
                        <a href="/melamar-pekerjaan"
                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Batal</a>

                        <button type="submit"
                            class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Pop Up Modal --}}
    <div id="popup-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-6 text-lg font-normal text-gray-500 dark:text-gray-400">
                    Sebelum anda mengisi data lamaran, diwajibkan untuk mengisi semua data diri anda terlebih dahulu. Tekan
                    Tombol <span class="font-semibold">Lengkapi Data Anda</span> untuk diarahkan ke halaman profil.
                </h3>
                <a href="/profil" data-modal-hide="popup-modal"
                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Lengkapi Data Anda
                </a>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataUserExist = @json($dataUserExist);
        if (dataUserExist && (dataUserExist.TTL == null || dataUserExist.alamat ==
                null || dataUserExist.jenis_kelamin == null || dataUserExist.nomor_handphone == null ||
                dataUserExist.agama == null || dataUserExist.curriculum_vitae == null || dataUserExist
                .pas_foto == null || dataUserExist.ijazah_transkrip == null || dataUserExist
                .surat_lamaran_kerja == null)) {
            const modal = document.getElementById('popup-modal');
            if (modal) {
                // Tampilkan modal
                modal.style.display = 'block';

                // Mengatur modal di tengah halaman
                modal.style.position = 'fixed';
                modal.style.top = '55%';
                modal.style.left = '58%';
                modal.style.transform = 'translate(-50%, -50%)';
            }
        }
    });
</script>
