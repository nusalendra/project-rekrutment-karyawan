@extends('layouts.app-hrd')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        <!-- Dashboard actions -->
        {{-- <div class="sm:flex sm:justify-between sm:items-center mb-8">

        <!-- Left: Avatars -->
        <x-dashboard.dashboard-avatars />

        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">

            <!-- Filter button -->
            <x-dropdown-filter align="right" />

            <!-- Datepicker built with flatpickr -->
            <x-datepicker />

            <!-- Add view button -->
            <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
                    <path
                        d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                </svg>
                <span class="hidden xs:block ml-2">Add View</span>
            </button>

        </div>

    </div> --}}
        <div class="">
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarTahunIni"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataLamaranPelamarPerJabatan"></canvas>
            </div>
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarLolosSeleksi"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarTesPotensiAkademik"></canvas>
            </div>
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarLolosTesPotensiAkademik"></canvas>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarTesWawancara"></canvas>
            </div>
            <div class="w-full h-auto px-6 py-3 bg-white flex justify-center">
                <canvas id="chartDataPelamarLolosTesWawancara"></canvas>
            </div>
        </div>
        
        <!-- Cards -->
        <div class="grid grid-cols-12 gap-6 h-100 w-50">


            <!-- Line chart (Acme Plus) -->
            {{-- <x-dashboard.dashboard-card-01 :dataFeed="$dataFeed" /> --}}

            <!-- Line chart (Acme Advanced) -->
            {{-- <x-dashboard.dashboard-card-02 :dataFeed="$dataFeed" /> --}}

            <!-- Line chart (Acme Professional) -->
            {{-- <x-dashboard.dashboard-card-03 :dataFeed="$dataFeed" /> --}}

            <!-- Bar chart (Direct vs Indirect) -->
            {{-- <x-dashboard.dashboard-card-04 /> --}}

            <!-- Line chart (Real Time Value) -->
            {{-- <x-dashboard.dashboard-card-05 /> --}}

            <!-- Doughnut chart (Top Countries) -->
            {{-- <x-dashboard.dashboard-card-06 /> --}}

            <!-- Table (Top Channels) -->
            {{-- <x-dashboard.dashboard-card-07 /> --}}

            <!-- Line chart (Sales Over Time)  -->
            {{-- <x-dashboard.dashboard-card-08 /> --}}

            <!-- Stacked bar chart (Sales VS Refunds) -->
            {{-- <x-dashboard.dashboard-card-09 /> --}}

            <!-- Card (Customers)  -->
            {{-- <x-dashboard.dashboard-card-10 /> --}}

            <!-- Card (Reasons for Refunds)   -->
            {{-- <x-dashboard.dashboard-card-11 /> --}}

            <!-- Card (Recent Activity) -->
            {{-- <x-dashboard.dashboard-card-12 /> --}}

            <!-- Card (Income/Expenses) -->
            {{-- <x-dashboard.dashboard-card-13 /> --}}

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //chart pelamar Tahun ini
        var ctx_pelamar_currentYear = document.getElementById('chartDataPelamarTahunIni').getContext('2d');

        var chartDataPelamarTahunIni = @json($chartDataPelamarTahunIni);

        var labels_pelamar_currentYear = chartDataPelamarTahunIni.map(item => item.bulan);
        var counts_pelamar_currentYear = chartDataPelamarTahunIni.map(item => item.count);

        new Chart(ctx_pelamar_currentYear, {
            type: 'bar',
            data: {
                labels: labels_pelamar_currentYear,
                datasets: [{
                    label: 'Jumlah Pelamar',
                    data: counts_pelamar_currentYear,
                    backgroundColor: 'rgba(255, 99, 71, 1)',
                    borderColor: 'rgba(255, 99, 71, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Pada Tahun {{ $currentYear }}',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

        // chart Jumlah Lamaran Pelamar di Setiap Posisi Jabatan
        var dataPelamarPekerjaan = @json($pelamarPekerjaan);
        var label_lamaran_pelamar = dataPelamarPekerjaan.map(item => item.jabatan);
        var dataPelamar = dataPelamarPekerjaan.map(item => item.total_pelamar);
        var idDataPelamarPekerjaan = document.getElementById('chartDataLamaranPelamarPerJabatan').getContext('2d');
        var myChart = new Chart(idDataPelamarPekerjaan, {
            type: 'line',
            data: {
                labels: label_lamaran_pelamar,
                datasets: [{
                    label: 'Jumlah Lamaran',
                    data: dataPelamar,
                    backgroundColor: 'rgba(244, 150, 15, 0.7)',
                    borderColor: 'rgba(244, 150, 15, 0.7)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Lamaran Pelamar Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

        // Chart Jumlah Pelamar Lolos Seleksi per posisi jabatan
        var dataPelamarLolosSeleksi = @json($pelamarLolosSeleksi);
        var label_pelamar_tes_potensi_akademik = dataPelamarLolosSeleksi.map(item => item.jabatan);
        var pelamarDataLolosSeleksi = dataPelamarLolosSeleksi.map(item => item.total_pelamar_lolos_seleksi);
        var idDataPelamarLolosSeleksi = document.getElementById('chartDataPelamarLolosSeleksi').getContext('2d');
        var myChart = new Chart(idDataPelamarLolosSeleksi, {
            type: 'line',
            data: {
                labels: label_pelamar_tes_potensi_akademik,
                datasets: [{
                    label: 'Jumlah Pelamar Lolos Seleksi',
                    data: pelamarDataLolosSeleksi,
                    backgroundColor: 'rgba(57, 116, 45, 0.8)',
                    borderColor: 'rgba(57, 116, 45, 0.8)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Lolos Tahap Seleksi Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

        // Chart Jumlah pelamar yang mengikuti tes potensi akademik per posisi jabatan
        var dataPelamarTesPotensiAkademik = @json($pelamarTesPotensiAkademik);
        var label_pelamar_tes_potensi_akademik = dataPelamarTesPotensiAkademik.map(item => item.jabatan);
        var pelamarDataTesPotensiAkademik = dataPelamarTesPotensiAkademik.map(item => item.total_pelamar_tes_potensi_akademik);
        var idDataPelamarTesPotensiAkademik = document.getElementById('chartDataPelamarTesPotensiAkademik').getContext('2d');
        var myChart = new Chart(idDataPelamarTesPotensiAkademik, {
            type: 'line',
            data: {
                labels: label_pelamar_tes_potensi_akademik,
                datasets: [{
                    label: 'Jumlah Pelamar Tes Potensi Akademik',
                    data: pelamarDataTesPotensiAkademik,
                    backgroundColor: 'rgba(16, 8, 133, 0.7)',
                    borderColor: 'rgba(16, 8, 133, 0.7)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Tes Potensi Akademik Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

        // Chart Jumlah Pelamar Lolos Tahap Tes Potensi Akademik
        var dataPelamarLolosTesPotensiAkademik = @json($pelamarLolosTesPotensiAkademik);
        var label_pelamar_tes_potensi_akademik = dataPelamarLolosTesPotensiAkademik.map(item => item.jabatan);
        var pelamarDataLolosSeleksi = dataPelamarLolosTesPotensiAkademik.map(item => item.total_pelamar_lolos_tes_potensi_akademik);
        var idDataPelamarLolosTesPotensiAkademik = document.getElementById('chartDataPelamarLolosTesPotensiAkademik').getContext('2d');
        var myChart = new Chart(idDataPelamarLolosTesPotensiAkademik, {
            type: 'line', // Mengubah jenis grafik menjadi garis
            data: {
                labels: label_pelamar_tes_potensi_akademik,
                datasets: [{
                    label: 'Jumlah Pelamar Lolos Tes Potensi Akademik',
                    data: pelamarDataLolosSeleksi,
                    backgroundColor: 'rgba(154, 82, 45, 0.8)',
                    borderColor: 'rgba(154, 82, 45, 0.8)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Lolos Tahap Tes Potensi Akademik Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

        // Chart Jumlah Pelamar yang mengikuti tes wawancara
        var dataPelamarTesWawancara = @json($pelamarTesWawancara);
        var label_pelamar_tes_wawancara = dataPelamarTesWawancara.map(item => item.jabatan);
        var pelamarDataTesWawancara = dataPelamarTesWawancara.map(item => item.total_pelamar_tes_wawancara);
        var idDataPelamarTesWawancara = document.getElementById('chartDataPelamarTesWawancara').getContext('2d');
        var myChart = new Chart(idDataPelamarTesWawancara, {
            type: 'line', // Mengubah jenis grafik menjadi garis
            data: {
                labels: label_pelamar_tes_wawancara,
                datasets: [{
                    label: 'Jumlah Pelamar Tes Wawancara',
                    data: pelamarDataTesWawancara,
                    backgroundColor: 'rgba(45, 112, 182, 1)',
                    borderColor: 'rgba(45, 112, 182, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Tes Wawancara Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

         // Chart Jumlah Pelamar yang lolos tes wawancara
         var dataPelamarLolosTesWawancara = @json($pelamarLolosTesWawancara);
        var label_pelamar_tes_wawancara = dataPelamarLolosTesWawancara.map(item => item.jabatan);
        var pelamarDataLolosTesWawancara = dataPelamarLolosTesWawancara.map(item => item.total_pelamar_lolos_tes_wawancara);
        var idDataPelamarLolosTesWawancara = document.getElementById('chartDataPelamarLolosTesWawancara').getContext('2d');
        var myChart = new Chart(idDataPelamarLolosTesWawancara, {
            type: 'line', // Mengubah jenis grafik menjadi garis
            data: {
                labels: label_pelamar_tes_wawancara,
                datasets: [{
                    label: 'Jumlah Pelamar Lolos Tes Wawancara',
                    data: pelamarDataLolosTesWawancara,
                    backgroundColor: 'rgba(97, 0, 133, 1)',
                    borderColor: 'rgba(97, 0, 133, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 25,
                            callback: function(value) {
                                return value % 25 === 0 || value === 100 ? value : '';
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Pelamar Lolos Tahap Tes Wawancara Per Posisi Jabatan',
                        font: {
                            size: 20
                        },
                        fontColor: '#000',
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    }
                }
            }
        });

    </script>
    <?php $showSidebar = true; ?>
@endsection
