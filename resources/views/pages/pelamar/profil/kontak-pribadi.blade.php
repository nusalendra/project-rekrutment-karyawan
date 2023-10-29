@extends('layouts.app-pelamar')

@section('content')
    <div class="flex w-screen h-auto justify-center pt-12 pb-12">
        <div class="flex w-3/4 h-auto">
            <div class="w-1/3 h-auto">
                {{-- Nama --}}
                <div class="flex w-full h-auto bg-white pl-3 mb-6 rounded-md border border-gray-200">
                    @if ($user->profile_photo_path == null)
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 48 48">
                            <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path d="M24 27a8 8 0 1 0 0-16a8 8 0 0 0 0 16Zm0-2a6 6 0 1 0 0-12a6 6 0 0 0 0 12Z" />
                                <path
                                    d="M44 24c0 11.046-8.954 20-20 20S4 35.046 4 24S12.954 4 24 4s20 8.954 20 20ZM33.63 39.21A17.915 17.915 0 0 1 24 42a17.916 17.916 0 0 1-9.832-2.92c-.24-.3-.483-.61-.73-.93A2.144 2.144 0 0 1 13 36.845c0-1.077.774-1.98 1.809-2.131c6.845-1 11.558-.914 18.412.035A2.077 2.077 0 0 1 35 36.818c0 .48-.165.946-.463 1.31c-.307.374-.61.735-.907 1.082Zm3.355-2.744c-.16-1.872-1.581-3.434-3.49-3.698c-7.016-.971-11.92-1.064-18.975-.033c-1.92.28-3.335 1.856-3.503 3.733A17.94 17.94 0 0 1 6 24c0-9.941 8.059-18 18-18s18 8.059 18 18a17.94 17.94 0 0 1-5.015 12.466Z" />
                            </g>
                        </svg>
                    @else
                        <img class="w-20 h-auto mx-2 my-3 border border-slate-300 rounded-full"
                            src="{{ asset('foto-profil/' . $user->profile_photo_path) }}" alt="Foto Profil">
                    @endif
                    <div class="flex flex-col w-full h-auto justify-center pl-3">
                        <h1 class="font-bold text-lg">{{ $user->name }}</h1>
                        <h1 class="text-base">{{ $user->role }}</h1>
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
                    @php
                        $userId = Crypt::encrypt($user->id);
                    @endphp
                    <a href="/profil/lengkapi-dokumen/{{ $userId }}"
                        class="flex w-full h-auto items-center space-x-6 py-4">
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
                    <h1 class="px-6 text-xl font-bold mb-6 tracking-wide">Kontak Pribadi</h1>
                    <div class="w-full h-auto border-t border-gray-200 pt-6">
                        <div class="w-full h-auto">
                            <h1 class="text-lg font-semibold mb-3 px-6">Kontak Pribadi</h1>
                            <form action="/profil/kontak-pribadi/{{ $user->id }}" method="POST">
                                @csrf
                                <div class="w-full h-auto space-y-3 font-medium mb-6 px-6">
                                    <h1>Nomor Handphone</h1>
                                    @if (!@empty($dataUser))
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            name="nomor_handphone" value="{{ $dataUser->nomor_handphone }}">
                                    @else
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            name="nomor_handphone">
                                    @endif
                                </div>
                                <div class="w-full h-auto space-y-3 font-medium mb-6 px-6">
                                    <h1>Alamat Email</h1>
                                    @if (!@empty($user))
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            name="email" value="{{ $user->email }}">
                                    @else
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            name="email">
                                    @endif
                                </div>
                                <div class="w-full h-auto space-y-3 font-medium mb-6 px-6">
                                    <h1>Sosial Media</h1>
                                    @if (!empty($dataUser) && is_array($sosialMediaArray = json_decode($dataUser->sosial_media, true)))
                                        @if (count($sosialMediaArray) > 0)
                                            <label for="">
                                                {{-- Linkedin --}}
                                                <div class="flex align-items-center mt-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-linkedin mt-1" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                                    </svg>
                                                    <span class="ml-2">Linkedin</span>
                                                </div>
                                            </label>

                                            <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                                placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                                value="{{ $sosialMediaArray[0] ?? '' }}">
                                            {{-- Instagram --}}
                                            <label for="">
                                                <div class="flex align-items-center mt-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-instagram mt-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                    </svg>
                                                    <span class="ml-2">Instagram</span>
                                                </div>
                                            </label>
                                            <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                                placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                                value="{{ $sosialMediaArray[1] ?? '' }}">

                                            {{-- Twitter --}}
                                            <label for="">
                                                <div class="flex align-items-center mt-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-twitter-x mt-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                                                    </svg>
                                                    <span class="ml-2">Twitter</span>
                                                </div>
                                            </label>
                                            <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                                placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                                value="{{ $sosialMediaArray[2] ?? '' }}">
                                            {{-- Blog --}}
                                            <label for="">
                                                <div class="flex align-items-center mt-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-browser-chrome mt-1"
                                                        viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                                    </svg>
                                                    <span class="ml-2">Blog</span>
                                                </div>
                                            </label>
                                            <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                                placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                                value="{{ $sosialMediaArray[3] ?? '' }}">
                                            {{-- Github --}}
                                            <label for="">
                                                <div class="flex align-items-center mt-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-github mt-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                                    </svg>
                                                    <span class="ml-2">Github</span>
                                                </div>
                                            </label>
                                            <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                                placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                                value="{{ $sosialMediaArray[4] ?? '' }}">
                                        @endif
                                    @else
                                        {{-- Linkedin --}}
                                        <label for="">
                                            <div class="flex align-items-center mt-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-linkedin mt-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                                </svg>
                                                <span class="ml-2">Linkedin</span>
                                            </div>
                                        </label>
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                            value="">
                                        {{-- Instagram --}}
                                        <label for="">
                                            <div class="flex align-items-center mt-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-instagram mt-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                                </svg>
                                                <span class="ml-2">Instagram</span>
                                            </div>
                                        </label>
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                            value="">
                                        {{-- Twitter --}}
                                        <label for="">
                                            <div class="flex align-items-center mt-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-twitter-x mt-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                                                </svg>
                                                <span class="ml-2">Twitter</span>
                                            </div>
                                        </label>
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                            value="">
                                        {{-- Blog --}}
                                        <label for="">
                                            <div class="flex align-items-center mt-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-browser-chrome mt-1"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                                </svg>
                                                <span class="ml-2">Blog</span>
                                            </div>
                                        </label>
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                            value="">
                                        {{-- Github --}}
                                        <label for="">
                                            <div class="flex align-items-center mt-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-github mt-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                                                </svg>
                                                <span class="ml-2">Github</span>
                                            </div>
                                        </label>
                                        <input class="w-full h-auto px-3 py-1 rounded-xl border-2 border-gray-200"
                                            placeholder="Contoh Pengisian : Nama Akun (Link)" name="sosial_media[]"
                                            value="">
                                    @endif
                                </div>
                                <div class="flex w-full h-auto items-center justify-center border-t border-gray-200 pt-3">
                                    <button type="submit"
                                        class="px-9 py-2 text-base text-white font-bold bg-red-500 rounded-md">Simpan
                                        Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
