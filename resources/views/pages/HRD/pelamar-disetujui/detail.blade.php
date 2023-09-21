@extends('layouts.app-hrd')

@section('content')
    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4">
            <h1 class="text-lg font-bold mb-2">Data Diri Pelamar</h1>
            <div class="bg-white px-8 py-6 rounded shadow">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1 space-y-3 font-semibold">
                        <div class="flex w-full">
                            <label for="nama" class="w-1/3 text-gray-600">Nama Pelamar</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span class="mr-4">:</span>{{ $data->user->name }}
                            </p>
                        </div>
                        <div class="flex w-full">
                            <label for="tempat_lahir" class="w-1/3 text-gray-600 ">Tempat, Tanggal Lahir</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span class="mr-4">:</span>{{ $data->user->TTL }}
                            </p>
                        </div>
                        <div class="flex w-full">
                            <label for="alamat" class="w-1/3 text-gray-600">Alamat</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span
                                    class="mr-4">:</span>{{ $data->user->alamat }}</p>
                        </div>
                        <div class="flex w-full">
                            <label for="jenis_kelamin" class="w-1/3 text-gray-600">Jenis Kelamin</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span
                                    class="mr-4">:</span>{{ $data->user->jenis_kelamin }}</p>
                        </div>
                        <div class="flex w-full">
                            <label for="agama" class="w-1/3 text-gray-600">Agama</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span
                                    class="mr-4">:</span>{{ $data->user->agama }}</p>
                        </div>
                        <div class="flex w-full">
                            <label for="nomor_handphone" class="w-1/3 text-gray-600">Nomor Handphone</label>
                            <p class="w-2/3 text-gray-700 tracking-wide"><span
                                    class="mr-4">:</span>{{ $data->user->nomor_handphone }}</p>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <!-- Foto pelamar kanan -->
                        <img src="url_ke_foto_pelamar.jpg" alt="Foto Pelamar" class="w-full h-auto rounded">
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h1 class="text-lg font-bold mb-2">Data Seleksi Pelamar</h1>
                <div class="bg-white px-8 py-6 rounded shadow space-y-3">
                    @foreach ($dataPenilaian as $item)
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1 font-semibold">
                                <div class="flex w-full">
                                    <label for="nama" class="w-1/3 text-gray-600">{{ $item->kriteria->nama }}</label>
                                    <p class="w-2/3 text-gray-700 tracking-wide"><span
                                            class="mr-4">:</span>{{ $item->subkriteria->nama }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pt-6">
                        <button
                            class="text-white bg-green-500 hover:bg-green-600 border border-green-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">Lamaran
                            {{ $data->status_lamaran }}</button>
                    </div>
                </div>
                <div class="mt-9">
                    <a href="{{ route('pelamar-disetujui') }}"
                        class="tidakLulusButton text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 focus:outline-none focus:ring-white-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">Kembali</a>
                </div>
            </div>
        </div>
    </div>


    <?php $showSidebar = false; ?>
@endsection
