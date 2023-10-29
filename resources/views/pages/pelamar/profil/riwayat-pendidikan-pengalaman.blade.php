@extends('layouts.app-pelamar')

@section('content')
    <div class="flex w-screen h-auto justify-center pt-12 pb-12">
        <div class="flex w-3/4 h-auto">
            <div class="w-1/3 h-auto">
                {{-- Nama --}}
                <div class="flex w-full h-auto bg-white p-4 mb-6 rounded-md shadow-md">
                    @if ($user->profile_photo_path == null)
                        <div class="h-20 w-20 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                                <!-- Icon SVG here -->
                            </svg>
                        </div>
                    @else
                        <img class="h-20 w-20 rounded-full border border-slate-300"
                            src="{{ asset('foto-profil/' . $user->profile_photo_path) }}" alt="Foto Profil">
                    @endif
                    <div class="flex flex-col ml-4">
                        <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                        <h1 class="text-base text-gray-600">{{ $user->role }}</h1>
                    </div>
                </div>
                {{-- Sidebar --}}
                <div class="w-full h-auto bg-white p-4 rounded-md shadow-md">
                    <a href="{{ route('profil') }}" class="flex w-full h-auto items-center py-4 border-b border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <!-- Icon SVG here -->
                        </svg>
                        <h1 class="font-semibold text-lg ml-2">Profil</h1>
                    </a>
                    @php
                        $userId = Crypt::encrypt($user->id);
                    @endphp
                    <a href="/profil/lengkapi-dokumen/{{ $userId }}" class="flex w-full h-auto items-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <!-- Icon SVG here -->
                        </svg>
                        <h1 class="font-semibold text-lg ml-2">Lengkapi Dokumen</h1>
                    </a>
                </div>
            </div>
            {{-- Konten --}}
            <div class="w-2/3 h-auto pl-6">
                <div class="w-full h-auto bg-white p-6 rounded-md shadow-md">
                    <a href="{{ route('profil') }}" class="flex items-center text-blue-500 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <g id="evaArrowIosBackOutline0">
                                <g id="evaArrowIosBackOutline1">
                                    <path id="evaArrowIosBackOutline2" fill="currentColor"
                                        d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64Z" />
                                </g>
                            </g>
                        </svg>
                        <h1 class="text-xl font-semibold ml-2">Kembali</h1>
                    </a>
                    <h1 class="text-2xl font-bold mb-6 mt-4">Informasi Pribadi</h1>
                    <div class="w-full border-t border-gray-200 pt-6">
                        <h1 class="text-xl font-semibold mb-3">Data Pribadi</h1>
                        <form action="/profil/riwayat-pendidikan-pengalaman/{{ $user->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="w-full space-y-4 mb-6 px-6">
                                <div>
                                    <h1 class="text-lg font-semibold">Pendidikan Terakhir</h1>
                                    @if (!@empty($dataUser))
                                        <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                            placeholder="Contoh Pengisian : Strata 1 (2020-2024)" name="pendidikan_terakhir"
                                            value="{{ $dataUser->pendidikan_terakhir }}">
                                    @else
                                        <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                            placeholder="Contoh : Strata 1 (2020-2024)" name="pendidikan_terakhir">
                                    @endif
                                </div>
                                <div>
                                    <h1 class="text-lg font-semibold">IPK</h1>
                                    @if (!@empty($dataUser))
                                        <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                            placeholder="Contoh Pengisian : 38.5" name="IPK"
                                            value="{{ $dataUser->IPK }}">
                                    @else
                                        <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                            placeholder="Contoh Pengisian : 38.5" name="IPK">
                                    @endif
                                </div>
                                <div>
                                    <h1 class="text-lg font-semibold">Pengalaman Kerja</h1>
                                    @if (!empty($dataUser) && is_array(json_decode($dataUser->pengalaman_kerja)))
                                        @foreach (json_decode($dataUser->pengalaman_kerja) as $pengalamanKerja)
                                            <div class="input-container-pengalaman-kerja">
                                                <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                                    placeholder="Contoh Pengisian : PT. XXXX - Direktur (2012-2024)"
                                                    name="pengalaman_kerja[]" value="{{ $pengalamanKerja }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-container-pengalaman-kerja">
                                            <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                                placeholder="Contoh Pengisian : PT. XXXX - Direktur (2012-2024)"
                                                name="pengalaman_kerja[]">
                                        </div>
                                    @endif
                                    <button type="button" onclick="tambahPengalamanKerja()"
                                        class="text-blue-500 mt-2 hover:text-blue-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg></button>
                                </div>

                                <div>
                                    <h1 class="text-lg font-semibold">Pengalaman Organisasi</h1>
                                    @if (!empty($dataUser) && is_array(json_decode($dataUser->pengalaman_organisasi)))
                                        @foreach (json_decode($dataUser->pengalaman_organisasi) as $pengalaman)
                                            <div class="input-container-pengalaman-organisasi">
                                                <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                                    placeholder="Contoh Pengisian : Organisasi A - Anggota (2015-2019)"
                                                    name="pengalaman_organisasi[]" value="{{ $pengalaman }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-container-pengalaman-organisasi">
                                            <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
                                                placeholder="Contoh Pengisian : Organisasi A - Anggota (2015-2019)"
                                                name="pengalaman_organisasi[]">
                                        </div>
                                    @endif
                                    <button type="button" onclick="tambahPengalamanOrganisasi()"
                                        class="text-blue-500 mt-2 hover:text-blue-600"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                            fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                        </svg></button>
                                </div>
                                <div class="flex w-full h-auto items-center justify-center border-t border-gray-200 pt-3">
                                    <button type="submit"
                                        class="px-9 py-2 text-base text-white font-bold bg-red-500 rounded-md">Simpan
                                        Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tambahPengalamanKerja() {
            const inputContainers = document.querySelectorAll('.input-container-pengalaman-kerja');
            const lastInputContainer = inputContainers[inputContainers.length - 1];

            const newInputContainer = document.createElement('div');
            newInputContainer.className = 'input-container-pengalaman-kerja';
            newInputContainer.innerHTML = `
        <input class="w-full px-3 py-2 mt-2 rounded-lg border border-gray-200"
            placeholder="Contoh Pengisian : PT. XXXX - Direktur (2012-2024)"
            name="pengalaman_kerja[]">
    `;

            lastInputContainer.after(newInputContainer);
        }


        function tambahPengalamanOrganisasi() {
            const inputContainers = document.querySelectorAll('.input-container-pengalaman-organisasi');
            const lastInputContainer = inputContainers[inputContainers.length - 1];

            const newInputContainer = document.createElement('div');
            newInputContainer.className = 'input-container-pengalaman-organisasi';
            newInputContainer.innerHTML = `
        <input class="w-full px-3 py-2 rounded-lg border border-gray-200"
            placeholder="Contoh Pengisian : Organisasi A - Anggota (2015-2019)"
            name="pengalaman_organisasi[]">
    `;

            lastInputContainer.after(newInputContainer);
        }
    </script>
@endsection
