@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4">
            <h1 class="text-lg font-bold mb-2">Data Diri Pelamar</h1>
            <div class="bg-white p-4 rounded shadow">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <div>
                            <label for="nama" class="text-gray-600">Nama Pelamar</label>
                            <p class="text-black">{{ $data->user->name }}</p>
                        </div>
                        <div class="mt-2">
                            <label for="tempat_lahir" class="text-gray-600">Tempat, Tanggal Lahir</label>
                            <p class="text-black">{{ $data->user->TTL }}</p>
                        </div>
                        <div class="mt-2">
                            <label for="alamat" class="text-gray-600">Alamat</label>
                            <p class="text-black">{{ $data->user->alamat }}</p>
                        </div>
                        <div class="mt-2">
                            <label for="jenis_kelamin" class="text-gray-600">Jenis Kelamin</label>
                            <p class="text-black">{{ $data->user->jenis_kelamin }}</p>
                        </div>
                        <div class="mt-2">
                            <label for="agama" class="text-gray-600">Agama</label>
                            <p class="text-black">{{ $data->user->agama }}</p>
                        </div>
                        <div class="mt-2">
                            <label for="nomor_handphone" class="text-gray-600">Nomor Handphone</label>
                            <p class="text-black">{{ $data->user->nomor_handphone }}</p>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <!-- Foto pelamar kanan -->
                        <img src="url_ke_foto_pelamar.jpg" alt="Foto Pelamar" class="w-full h-auto rounded">
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <h1 class="text-lg font-bold mb-2">Data Seleksi Pelamar</h1>
                <div class="bg-white p-4 rounded shadow">
                    @foreach ($dataPenilaian as $item)
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <div class="mt-2">
                                    <label for="nama" class="text-gray-600">{{ $item->kriteria->nama }}</label>
                                    <p class="text-black">{{ $item->subkriteria->nama }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <form action="{{ route('antrian-pelamar-update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="pelamar_id" value="{{ $data->id }}">

                        @if ($data->status_lamaran === 'Disetujui')
                            <button
                                class="text-white bg-green-400 hover:bg-green-500 border border-green-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                disabled>{{ $data->status_lamaran }}</button>
                        @elseif ($data->status_lamaran === 'Ditolak')
                            <button
                                class="text-white bg-red-500 hover:bg-red-600 border border-red-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                                disabled>{{ $data->status_lamaran }}</button>
                        @else
                            <a href="{{ route('antrian-pelamar') }}"
                                class="tidakLulusButton text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">Kembali</a>
                            <button type="submit" name="status_lamaran" value="Disetujui"
                                class="lulusButton text-white bg-green-400 hover:bg-green-500 border border-green-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                Disetujui
                            </button>
                            <button type="submit" name="status_lamaran" value="Ditolak"
                                class="tidakLulusButton text-white bg-red-500 hover:bg-red-600 border border-red-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                Ditolak
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php $showSidebar = false; ?>
@endsection
