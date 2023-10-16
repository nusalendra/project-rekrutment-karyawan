@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white bg-auto rounded h-[830px] overflow-y-auto pb-5">
            <div class="px-12 pt-5 text-black">
                <div class="flex justify-between bg-white rounded-md items-center mb-5">
                    <h1 class="font-semibold text-xl p-2.5">Notifikasi</h1>
                    <a href="#" class="text-blue-500 font-semibold p-2.5" id="mark-all-as-read">
                        Tandai dibaca semua
                    </a>
                </div>
                <div class="bg-gray-300 dark:bg-gray-700 dark:text-gray-400 rounded isi-notifikasi">
                    <!-- Loop melalui notifikasi -->
                    @foreach ($notifikasi as $notification)
                        <div class="flex border-b border-gray-300 py-3 px-2.5 notification @if ($notification->status) read @endif"
                            data-id="{{ $notification->id }}">
                            <a href="#">
                                <h2 class="font-normal text-sm">{!! $notification->pesan !!}</h2>
                                <p class="text-xs text-stone-800 mt-1.5">
                                    {{ \Carbon\Carbon::parse($notification->created_at)->format('d-m-Y, H:i:s') }}</p>
                            </a>
                            <a href="/notifikasi/delete/{{ $notification->id }}"
                                class="text-black flex items-center focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm sm:w-auto px-4 py-2 ml-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-x-circle-fill text-red-700" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const markAllAsReadButton = document.getElementById('mark-all-as-read');
            const notifications = document.querySelectorAll('.notification');

            markAllAsReadButton.addEventListener('click', function() {
                markAllNotificationsAsRead(notifications);
            });

            notifications.forEach(notification => {
                notification.addEventListener('click', function() {
                    const notifikasiId = this.getAttribute('data-id');
                    markNotificationAsRead(notifikasiId);
                    this.classList.add(
                        'read'); // Menambahkan kelas 'read' ke notifikasi yang sudah dibaca
                });
            });

            function markAllNotificationsAsRead(notifications) {
                notifications.forEach(notification => {
                    const notifikasiId = notification.getAttribute('data-id');
                    markNotificationAsRead(notifikasiId);
                    notification.classList.add(
                        'read'); // Menambahkan kelas 'read' ke notifikasi yang sudah dibaca
                });
            }

            function markNotificationAsRead(notifikasiId) {
                // Kirim permintaan HTTP untuk menandai notifikasi sebagai sudah dibaca
                fetch('{{ route('notifikasi-markAsRead') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            notifikasi_id: notifikasiId
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Notification marked as read') {
                            // Notifikasi berhasil ditandai sebagai sudah dibaca
                        }
                    });
            }
        });
    </script>

    <style>
        .read {
            background-color: white !important;
            /* Ubah latar belakang menjadi putih */
            /* Gaya lain yang Anda butuhkan */
        }
    </style>
@endsection
