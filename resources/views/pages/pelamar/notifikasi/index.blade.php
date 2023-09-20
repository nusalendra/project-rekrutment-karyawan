@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-stone-200 bg-auto rounded h-216">
            <div class="px-12 pt-5 text-black">
                <div
                    class="flex justify-between bg-gray-300 dark:bg-gray-700 dark:text-gray-400 rounded-md items-center mb-5">
                    <h1 class="font-semibold text-xl p-2.5">Notifikasi</h1>
                    <a href="#" class="text-blue-500 font-semibold p-2.5">Tandai sudah dibaca</a>
                </div>
                <div class="bg-white rounded isi-notifikasi">
                    <div id="notification-div"></div>
                    <!-- Notifikasi 1 -->
                    <div class="border-b border-gray-300 py-3 px-2.5">
                        <a href="">
                            <h2 class="font-semibold text-lg">Notifikasi 1</h2>
                            <p class="text-sm text-gray-500">Isi notifikasi pertama.</p>
                        </a>
                    </div>

                    <!-- Notifikasi 2 -->
                    <div class="border-b border-gray-300 py-3 px-2.5">
                        <a href="">
                            <h2 class="font-semibold text-lg">Notifikasi 2</h2>
                            <p class="text-sm text-gray-500">Isi notifikasi kedua.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
