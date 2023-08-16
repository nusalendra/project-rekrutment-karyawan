<div class="bg-stone-200">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>
    {{-- Sidebar Logo --}}
    
    <!-- Sidebar -->
    <div id="sidebar"
        class="flex flex-col absolute z-40 left-0 top-0 mt-16 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-72 lg:w-20 lg:sidebar-expanded:!w-72 2xl:!w-72 shrink-0 bg-stone-300 border-r-6 pl-4 transition-all duration-200 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

        <!-- Links -->
        <div class="space-y-8 mt-3">
            <!-- Pages group -->
            <div class="">
                <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
                    <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
                        aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block"></span>
                </h3>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'bg-stone-300' }} @endif"
                        >
                        <a class="block text-black hover:text-blue-600 truncate transition duration-150 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'hover:text-blue-600' }} @endif"
                            href="/dashboard">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                            d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-indigo-200' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                    </svg>
                                    <span
                                        class="text-base font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'text-blue-600' }} @endif">Dashboard</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['dashboard'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- Master Data -->
                    <li class="px-3 py-2 rounded-sm mb-0.5 mt-3 last:mb-0 @if (in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test'])) {{ 'bg-gray' }} @endif"
                        x-data="{ open: {{ in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test']) ? 1 : 0 }} }">
                        <a class="block text-black hover:text-blue-600 truncate transition duration-150 @if (in_array(Request::segment(1), ['master_data'])) {{ 'hover:text-black' }} @endif"
                            href="#0" @click.prevent="sidebarExpanded ? open = !open : sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-700' }} @endif"
                                            d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                                            d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" />
                                    </svg>
                                    <span
                                        class="text-base font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 @if (in_array(Request::segment(1), ['narasumber', 'pelatihan', 'daftar-pelatihan', 'peserta', 'absen', 'tujuan-pembayaran', 'nilai-post-test'])) {{ 'text-blue-600' }} @endif">Master
                                        Data</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['ecommerce'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1 @if (!in_array(Request::segment(1), ['ecommerce'])) {{ 'hidden' }} @endif"
                                :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('narasumberIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/narasumber/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Narasumber</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('pelatihanIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/pelatihan/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pelatihan</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('daftarPelatihanIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/daftar-pelatihan/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Daftar Peserta
                                            Pelatihan</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('pesertaIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/peserta/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Akun Peserta</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('absenIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/absen/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Presensi
                                        </span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('tujuanPembayaranIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/tujuan-pembayaran/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tujuan Pembayaran
                                        </span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-black hover:text-blue-600 transition duration-150 truncate mt-2 @if (Route::is('nilaiPostTestIndex')) {{ 'text-blue-600' }} @endif"
                                        href="/nilai-post-test/index">
                                        <span
                                            class="text-base font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Nilai Post Test
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    {{-- Register Narasumber --}}
                    <li class="px-3 py-2 rounded-sm mb-0.5 mt-3 last:mb-0 @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'bg-gray' }} @endif">
                        <a class="block text-black hover:text-blue-600 truncate transition duration-150 @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'hover:text-blue-600' }} @endif"
                            href="/register-narasumber/create">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'text-indigo-600' }}@else{{ 'text-slate-600' }} @endif"
                                            d="M12 3c-4.963 0-9 4.037-9 9s4.037 9 9 9 9-4.037 9-9-4.037-9-9-9z" />
                                        <path
                                            class="fill-current @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'text-indigo-200' }}@else{{ 'text-slate-400' }} @endif"
                                            d="M12 15c-1.654 0-3-1.346-3-3 0-.462.113-.894.3-1.285L6 6l4.714 3.301A2.973 2.973 0 0112 9c1.654 0 3 1.346 3 3s-1.346 3-3 3z" />
                                    </svg>
                                    <span
                                        class="text-base font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200 @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'text-blue-600' }} @endif">Register Narasumber</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex shrink-0 ml-2 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400 @if (in_array(Request::segment(1), ['register-narasumber'])) {{ 'rotate-180' }} @endif"
                                        :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400"
                            d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>