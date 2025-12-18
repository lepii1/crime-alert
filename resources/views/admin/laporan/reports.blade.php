<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Analisis Laporan - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* CSS Tema Dashboard */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
        }
        .flex-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR RESPONSIVE */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 50;
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        .sidebar-open {
            transform: translateX(0) !important;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        .sidebar-header h2 {
            font-size: 1.2rem;
            font-weight: 600;
            padding-left: 10px;
        }
        .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active, .sidebar-nav form button:hover {
            background-color: #34495e;
            border-left: 3px solid #e74c3c;
        }
        .sidebar-nav a i, .sidebar-nav form button i {
            margin-right: 10px;
            font-size: 18px;
        }
        .sidebar-nav form button {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }
        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
        }

        /* KONTEN UTAMA RESPONSIVE */
        .main-content {
            padding: 30px;
            flex-grow: 1;
            margin-left: 0;
        }
        @media (min-width: 1024px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .charts-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }
        .chart-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 25px;
            /* Hapus min-height agar chart.js yang mengontrol */
        }
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 20px;
        }
        @media (min-width: 768px) {
            .chart-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        /* Kontainer Chart agar Chart.js bisa mengatur tinggi */
        .chart-container {
            position: relative;
            height: 384px; /* Default height (h-96) */
            max-height: 384px; /* Max height */
        }
        @media (min-width: 1024px) {
            .chart-line-container {
                height: 450px; /* Line chart lebih tinggi di desktop */
                max-height: 450px;
            }
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- TOMBOL HAMBURGER --}}
<div @click="open = true"
     class="lg:hidden fixed top-0 right-0 m-4 p-2 bg-indigo-600 text-white rounded-lg shadow-lg cursor-pointer z-[60]">
    <i class="fas fa-bars"></i>
</div>

<div class="flex-container">

    {{-- SIDEBAR --}}
    <div class="sidebar" :class="{'sidebar-open': open}">
        <div class="sidebar-content">
            <div>
                {{-- Tombol Tutup (Hanya di Mobile) --}}
                <div class="lg:hidden absolute top-0 right-0 m-4 p-2 text-white cursor-pointer" @click="open = false">
                    <i class="fas fa-times text-xl"></i>
                </div>

                <div class="sidebar-header">
                    <ul>
                        <li><a href="{{ url('/') }}"><i class="fas fa-exclamation-circle" style="color: #e74c3c; font-size: 24px;"></i> <span class="text-white text-xl font-semibold p-2"> CRIME ALERT</span></a></li>
                    </ul>
                </div>

                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}" @click="open = false"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('admin.laporan.index') }}" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="{{ route('admin.laporan.reports') }}" class="active" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        <li><a href="{{ route('profile.edit') }}" @click="open = false"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </nav>
            </div>

            {{-- LOGOUT --}}
            <div class="p-4 pt-0">
                <form method="POST" action="{{ route('logout') }}" @click="open = false">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY --}}
    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden"
         style="display: none;">
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="main-content">
        <h1 class="charts-header">Analisis Visual Laporan Kejahatan</h1>

        <div class="chart-grid">

            {{-- CHART 1: TREND BULANAN --}}
            <div class="chart-card md:col-span-2">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tren Laporan 12 Bulan Terakhir</h3>
                <div class="chart-container chart-line-container">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>

            {{-- CHART 2: DISTRIBUSI KATEGORI (PIE) --}}
            <div class="chart-card">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Distribusi Berdasarkan Kategori</h3>
                <div class="chart-container">
                    <canvas id="categoryDistributionChart"></canvas>
                </div>
            </div>

            {{-- CHART 3: STATUS PENANGANAN (DOUGHNUT) --}}
            <div class="chart-card">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Status Penanganan Laporan</h3>
                <div class="chart-container">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Data dari Controller (disediakan oleh AdminLaporanController@reports)
    const monthlyData = @json($monthlyChartData);
    const categoryData = @json($categoryChartData);
    const statusData = @json($statusChartData);

    // Warna Primer
    const colorAccent = 'rgb(231, 76, 60)'; // #e74c3c

    // Fungsi untuk menghasilkan warna cerah unik
    const generateColor = (index) => {
        const colors = [
            '#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6', '#1abc9c', '#e67e22', '#34495e'
        ];
        return colors[index % colors.length];
    };

    // ===================================
    // 1. CHART TREND BULANAN (LINE CHART)
    // ===================================
    new Chart(document.getElementById('monthlyTrendChart'), {
        type: 'line',
        data: {
            labels: monthlyData.labels,
            datasets: [{
                label: 'Jumlah Laporan',
                data: monthlyData.data,
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                borderColor: colorAccent,
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                }
            }
        }
    });

    // ===================================
    // 2. CHART DISTRIBUSI KATEGORI (PIE CHART)
    // ===================================
    new Chart(document.getElementById('categoryDistributionChart'), {
        type: 'pie',
        data: {
            labels: categoryData.labels,
            datasets: [{
                data: categoryData.data,
                backgroundColor: categoryData.labels.map((_, i) => generateColor(i)),
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Laporan Berdasarkan Jenis Kejahatan'
                }
            }
        }
    });

    // ===================================
    // 3. CHART STATUS PENANGANAN (DOUGHNUT)
    // ===================================
    new Chart(document.getElementById('statusDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.data,
                backgroundColor: [
                    '#f39c12', // Pending (Kuning)
                    '#3498db', // Proses (Biru)
                    '#27ae60'  // Selesai (Hijau)
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Rasio Status Laporan'
                }
            }
        }
    });
</script>
</body>
</html>
