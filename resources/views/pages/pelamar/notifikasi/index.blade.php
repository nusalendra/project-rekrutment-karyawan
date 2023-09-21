@extends('layouts.app-pelamar')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="bg-white bg-auto rounded h-[840px] overflow-y-auto">
            <div class="px-12 pt-5 text-black">
                <div
                    class="flex justify-between bg-white rounded-md items-center mb-5">
                    <h1 class="font-semibold text-xl p-2.5">Notifikasi</h1>
                    <a href="#" class="text-blue-500 font-semibold p-2.5" id="mark-all-as-read">
                        Tandai dibaca semua
                    </a>
                </div>
                <div class="bg-gray-300 dark:bg-gray-700 dark:text-gray-400 rounded isi-notifikasi">
                    <!-- Loop melalui notifikasi -->
                    @foreach ($notifikasi as $notification)
                        <div class="border-b border-gray-300 py-3 px-2.5 notification @if ($notification->status) read @endif"
                            data-id="{{ $notification->id }}">
                            <a href="/beranda">
                                <h2 class="font-semibold text-lg">{{ $notification->pesan }}</h2>
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
