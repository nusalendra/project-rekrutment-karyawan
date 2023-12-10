<header class="sticky top-0 bg-white border-b z-30 shadow-md w-full">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex items-center text-black justify-between h-16 -mb-px">

            <!-- Header: Left side -->
            <div class="flex items-center font-semibold space-x-6">
                <button class="text-slate-500 hover:text-slate-600 lg:hidden" @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar" :aria-expanded="sidebarOpen">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="5" width="16" height="2" />
                        <rect x="4" y="11" width="16" height="2" />
                        <rect x="4" y="17" width="16" height="2" />
                    </svg>
                </button>
                <a href=""><img class="mx-auto" src="/images/pt-umdi.png" width="180" height="67"
                        alt=""></a>
                {{-- <a href="/" class="{{ Request::is('/') ? 'text-blue-600' : 'hover:text-blue-700' }}">Beranda</a> --}}
                <a href="/"
                    class="{{ Request::is('/') ? 'text-blue-600' : 'hover:text-blue-700' }}">Lamaran
                    Pekerjaan</a>
            </div>

            <!-- Header: Right side -->
            <div class="flex items-center space-x-6 font-semibold">

                <a href="/login" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Masuk</a>


            </div>
        </div>
    </div>
</header>
