@extends('layouts.app-pelamar')

@section('content')
    <div class="flex w-screen h-auto justify-center pt-12 pb-12">
        <div class="flex w-3/4 h-auto">
            <div class="w-1/3 h-auto">
                {{-- Nama --}}
                <div class="flex w-full h-auto bg-white pl-3 mb-6 rounded-md border border-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 48 48">
                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M24 27a8 8 0 1 0 0-16a8 8 0 0 0 0 16Zm0-2a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z" />
                            <path
                                d="M44 24c0 11.046-8.954 20-20 20S4 35.046 4 24S12.954 4 24 4s20 8.954 20 20ZM33.63 39.21A17.915 17.915 0 0 1 24 42a17.916 17.916 0 0 1-9.832-2.92c-.24-.3-.483-.61-.73-.93A2.144 2.144 0 0 1 13 36.845c0-1.077.774-1.98 1.809-2.131c6.845-1 11.558-.914 18.412.035A2.077 2.077 0 0 1 35 36.818c0 .48-.165.946-.463 1.31c-.307.374-.61.735-.907 1.082Zm3.355-2.744c-.16-1.872-1.581-3.434-3.49-3.698c-7.016-.971-11.92-1.064-18.975-.033c-1.92.28-3.335 1.856-3.503 3.733A17.94 17.94 0 0 1 6 24c0-9.941 8.059-18 18-18s18 8.059 18 18a17.94 17.94 0 0 1-5.015 12.466Z" />
                        </g>
                    </svg>
                    <div class="flex flex-col w-full h-auto justify-center pl-3">
                        <h1 class="font-bold text-lg">Muchammad Arif Siddiqi</h1>
                        <h1 class="text-base">Pelamar</h1>
                        <h1 class="text-base">Universitas</h1>
                    </div>
                </div>
                {{-- Sidebar --}}
                <div class="w-full h-auto bg-white px-6 rounded-md border border-gray-200">
                    <a href="{{ route('profil') }}"
                        class="flex w-full h-auto items-center space-x-6 py-4 border-b border-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <g fill="none">
                                <path
                                    d="M24 0v24H0V0h24ZM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018Zm.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01l-.184-.092Z" />
                                <path fill="currentColor"
                                    d="M11 2a5 5 0 1 0 0 10a5 5 0 0 0 0-10Zm0 11c-2.395 0-4.575.694-6.178 1.671c-.8.49-1.484 1.065-1.978 1.69C2.358 16.977 2 17.713 2 18.5c0 .845.411 1.511 1.003 1.986c.56.45 1.299.748 2.084.956C6.665 21.859 8.771 22 11 22l.685-.005a1 1 0 0 0 .89-1.428A5.973 5.973 0 0 1 12 18c0-1.252.383-2.412 1.037-3.373a1 1 0 0 0-.72-1.557c-.43-.046-.87-.07-1.317-.07Zm9.616 2.469a1 1 0 1 0-1.732-1l-.336.582a2.995 2.995 0 0 0-1.097-.001l-.335-.581a1 1 0 1 0-1.732 1l.335.58a2.997 2.997 0 0 0-.547.951H14.5a1 1 0 0 0 0 2h.671a3.021 3.021 0 0 0 .549.95l-.336.581a1 1 0 1 0 1.732 1l.336-.581c.359.066.73.068 1.097 0l.335.581a1 1 0 1 0 1.732-1l-.335-.58c.242-.284.426-.607.547-.951h.672a1 1 0 1 0 0-2h-.671a3.029 3.029 0 0 0-.549-.95l.336-.581Z" />
                            </g>
                        </svg>
                        <h1 class="font-semibold text-lg tracking-wide">Profil</h1>
                    </a>
                    <a href="" class="flex w-full h-auto items-center space-x-6 py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75V2.5Zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5h6Zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5h6Z"
                                clip-rule="evenodd" />
                            <path fill="currentColor"
                                d="M15.75 2.824c0-.184.193-.301.336-.186c.121.098.23.212.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25V2.824Z" />
                        </svg>
                        <h1 class="font-semibold text-lg tracking-wide">Lengkapi Dokumen</h1>
                    </a>
                </div>
            </div>
            {{-- Konten --}}
            <div class="w-2/3 h-auto pl-6">
                <div class="w-full h-auto bg-white pt-6 pb-3">
                    <a href="{{ route('profil') }}"
                        class="flex items-center pl-4 text-base font-bold mb-6 tracking-wide space-x-1 text-blue-500 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
                            <g id="evaArrowIosBackOutline0">
                                <g id="evaArrowIosBackOutline1">
                                    <path id="evaArrowIosBackOutline2" fill="currentColor"
                                        d="M13.83 19a1 1 0 0 1-.78-.37l-4.83-6a1 1 0 0 1 0-1.27l5-6a1 1 0 0 1 1.54 1.28L10.29 12l4.32 5.36a1 1 0 0 1-.78 1.64Z" />
                                </g>
                            </g>
                        </svg>
                        <h1>Kembali</h1>
                    </a>
                    <h1 class="px-6 text-xl font-bold mb-6 tracking-wide">Informasi Pribadi</h1>
                    <div class="w-full h-auto border-t border-gray-200 pt-6">
                        <div class="w-full h-auto">
                            <h1 class="text-lg font-semibold mb-3 px-6">Data Pribadi</h1>
                            <form action="">
                                <div class="w-full h-auto space-y-3 font-medium mb-6 px-6">
                                    <h1>Nama Lengkap</h1>
                                    <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200">
                                </div>
                                <div class="w-full h-auto space-y-3 font-medium mb-6 px-6">
                                    <h1>Tempat & Tanggal Lahir</h1>
                                    <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200">
                                </div>
                                <div class="w-full h-auto space-y-3 font-medium mb-12 px-6">
                                    <h1>Jenis Kelamin</h1>
                                    <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200">
                                </div>
                                <div class="w-full h-auto space-y-3 font-medium mb-12 px-6">
                                    <h1>Agama</h1>
                                    <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200">
                                </div>
                                <div class="flex w-full h-auto items-center justify-center border-t border-gray-200 pt-3">
                                    <button type="submit" class="px-9 py-2 text-base text-white font-bold bg-red-500 rounded-md">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
