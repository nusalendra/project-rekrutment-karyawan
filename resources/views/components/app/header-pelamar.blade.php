<header class="sticky top-0 bg-white border-b z-30 shadow-md w-full">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 -mb-px">

            <!-- Header: Left side -->
            {{-- <div class="flex">
                
                <!-- Hamburger button -->
                <button
                    class="text-slate-500 hover:text-slate-600 lg:hidden"
                    @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar"
                    :aria-expanded="sidebarOpen"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>

            </div> --}}
            <div class="flex items-center space-x-6 text-gray-700 font-semibold">
                <a href=""><img class="mx-auto" src="/images/pt-umdi.png" width="180" height="67" alt=""></a>
                <a href="" class="hover:text-blue-700">Beranda</a>
                <a href="" class="hover:text-blue-700">Panduan Lamaran</a>
                <a href="" class="hover:text-blue-700">Posisi Tersedia</a>
                <a href="" class="hover:text-blue-700">Lamaran Saya</a>
            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-3">


                <!-- Search Button with Modal -->
                {{-- <x-modal-search /> --}}

                <!-- Notifications button -->
                <x-dropdown-notifications align="right" />

                <!-- Info button -->
                {{-- <x-dropdown-help align="right" /> --}}

                <!-- Divider -->
                {{-- <hr class="w-px h-6 bg-slate-200" /> --}}

                <!-- User button -->
                <x-dropdown-profile align="right" />

            </div>

        </div>
    </div>
</header>
