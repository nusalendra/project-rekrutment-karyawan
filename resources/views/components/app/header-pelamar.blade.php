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
                {{-- <a href="/beranda"
                    class="{{ Request::is('beranda') ? 'text-blue-600' : 'hover:text-blue-700' }}">Beranda</a> --}}
                <a href="/melamar-pekerjaan"
                    class="{{ Request::is('melamar-pekerjaan') ? 'text-blue-600' : 'hover:text-blue-700' }}">Lamaran
                    Pekerjaan</a>
                <a href="/notifikasi"
                    class="{{ Request::is('notifikasi') ? 'text-blue-600' : 'hover:text-blue-700' }}">Notifikasi</a>
                <a href="/lamaran-saya"
                    class="{{ Request::is('lamaran-saya') ? 'text-blue-600' : 'hover:text-blue-700' }}">Lamaran
                    Saya</a>
                <a href="#" onclick="return false;"
                    class="flex items-center {{ Request::is('tes-tpa*') ? 'text-blue-600' : 'hover:text-blue-700' }}"
                    id="tes-link">
                    Tes Potensi Akademik
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor"
                        class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                        <path
                            d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                    </svg>
                </a>

                <div id="popup-modal-tpa" tabindex="-1"
                    class="flex hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-[50%] max-h-full">
                        <div class="relative bg-gray-100 rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-black bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="popup-modal-tpa">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-red-600 w-12 h-12 dark:text-red-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-black dark:text-black">Anda harus menyelesaikan
                                    tahap seleksi pelamar sebelum dapat mengakses halaman ini. Pengaksesan halaman ini
                                    hanya dapat dilakukan setelah tim HRD mengirimkan notifikasi persetujuan. <br> Mohon
                                    bersabar dan tunggu hingga tim HRD memberi tahu Anda melalui halaman notifikasi
                                    tentang ketersediaan akses. Proses seleksi saat ini sedang berlangsung, dan kami
                                    akan memberitahu Anda segera setelah tahap tersebut selesai. <br><br> Terima kasih
                                    atas
                                    pengertian dan kerjasama Anda dalam menjalani proses ini.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Header: Right side -->
            <div class="flex items-center space-x-3">


                <!-- Search Button with Modal -->
                {{-- <x-modal-search /> --}}

                <!-- Notifications button -->
                {{-- <x-dropdown-notifications align="right" /> --}}

                <!-- Info button -->
                {{-- <x-dropdown-help align="right" /> --}}

                <!-- Divider -->
                {{-- <hr class="w-px h-6 bg-slate-200" /> --}}

                <!-- User button -->
                <x-profil-pelamar align="right" />

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalId = 'popup-modal-tpa';
            var tesLink = document.getElementById('tes-link');
            var modal = document.getElementById(modalId);
    
            if (tesLink) {
                tesLink.addEventListener('click', function(event) {
                    var currentPage = window.location.pathname;
                    var allowedPage = '/tes-tpa';
    
                    // Ganti sesuai dengan URL yang Anda harapkan setelah enkripsi pelamarId
                    var allowedPageWithId = '/tes-tpa/';
    
                    if (currentPage === allowedPage || currentPage.startsWith(allowedPageWithId)) {
                        return;
                    }
    
                    event.preventDefault();
                    toggleModal();
                });
            }
    
            function toggleModal() {
                if (modal) {
                    modal.classList.toggle('hidden');
                }
            }
    
            // Tambahkan event listener untuk tombol close modal
            var closeModalButton = document.querySelector('[data-modal-hide="' + modalId + '"]');
            if (closeModalButton) {
                closeModalButton.addEventListener('click', function() {
                    toggleModal();
                });
            }
        });
    </script>    
</header>
