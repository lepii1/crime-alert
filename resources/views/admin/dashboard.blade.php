<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk interaksi sidebar di mobile -->
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

        /* 1. SIDEBAR RESPONSIVE */
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
            /* Default: Sembunyikan di luar viewport untuk mobile */
            transform: translateX(-100%);
        }
        /* Desktop/Layar Lebar: Selalu tampil */
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        /* Class Alpine untuk membuka sidebar di mobile */
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

        /* 2. KONTEN UTAMA RESPONSIVE */
        .main-content {
            padding: 30px;
            flex-grow: 1;
            /* Mobile: Tanpa margin kiri */
            margin-left: 0;
        }
        /* Desktop/Layar Lebar: Beri margin kiri */
        @media (min-width: 1024px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .dashboard-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }
        .card-grid {
            /* Mobile: 1 kolom, Desktop: 2 kolom */
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }

        .card {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            color: #555;
            margin-bottom: 15px;
        }
        /* Kontainer Chart agar Chart.js bisa mengatur tinggi */
        .chart-container {
            position: relative;
            height: 200px; /* Tinggi yang pas untuk dashboard card */
            max-height: 200px;
        }
        .alert-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .alert-item:last-child {
            border-bottom: none;
        }
        .alert-icon {
            color: #e74c3c; /* Warna merah untuk Alert */
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .alert-title {
            font-weight: 500;
            margin-right: auto;
            color: #333;
            font-size: 0.95rem;
            text-decoration: none;
        }
        .alert-time {
            color: #777;
            font-size: 0.8rem;
        }
        .recent-reports ul {
            list-style: none;
            padding: 0;
        }
        .report-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        .report-item:last-child {
            border-bottom: none;
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fde68a; color: #b45309; }
        .status-proses { background-color: #bfdbfe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }
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
                    <i class="fas fa-exclamation-circle" style="color: #e74c3c; font-size: 24px;"></i>
                    <h2>CRIME ALERT</h2>
                </div>

                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}" class="active" @click="open = false"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('admin.laporan.index') }}" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="{{ route('admin.laporan.reports') }}" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
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
        <h1 class="dashboard-header">Dashboard</h1>

        <div class="card-grid">
            {{-- KARTU 1: GRAFIK TREN (DINAMIS) --}}
            <div class="card">
                <h3 class="card-title">Tren Laporan (12 Bulan)</h3>
                <div class="chart-container">
                    <canvas id="monthlyTrendChartDashboard"></canvas>
                </div>
            </div>

            {{-- KARTU 2: CRIME ALERTS (LAPORAN PENDING) --}}
            <div class="card">
                <h3 class="card-title">Laporan PENTING (Pending)</h3>
                <div class="space-y-1">
                    @forelse($pendingReports as $report)
                        <a href="{{ route('admin.laporan.show', $report->id) }}" class="alert-item hover:bg-gray-50 transition">
                            <i class="fas fa-exclamation-triangle alert-icon"></i>
                            <span class="alert-title">{{ $report->judul_laporan }} ({{ $report->kategori }})</span>
                            <span class="alert-time">{{ \Carbon\Carbon::parse($report->tgl_lapor)->diffForHumans() }}</span>
                        </a>
                    @empty
                        <div class="alert-item text-gray-500 italic border-b-0">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Tidak ada laporan yang perlu ditugaskan.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- KARTU 3: RECENT REPORTS --}}
        <div class="card recent-reports">
            <h3 class="card-title">Recent Reports</h3>
            <ul>
                @forelse($laporan as $report)
                    <li class="report-item">
                        <span>{{ $report->judul_laporan }} ({{ $report->kategori }})</span>
                        <span class="status-badge status-{{ strtolower($report->status) }}">
                                {{ ucfirst($report->status) }}
                            </span>
                    </li>
                @empty
                    <li class="text-gray-500 italic p-3">
                        <i class="fas fa-database mr-2"></i>
                        Tidak ada laporan terbaru di database Anda.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<script>
    // Inisialisasi Chart.js untuk Dashboard Card
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($monthlyChartData);
        const colorAccent = 'rgb(231, 76, 60)'; // #e74c3c

        new Chart(document.getElementById('monthlyTrendChartDashboard'), {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Laporan',
                    data: chartData.data,
                    backgroundColor: 'rgba(231, 76, 60, 0.1)',
                    borderColor: colorAccent,
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3 // Membuat titik lebih kecil
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legenda
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            maxTicksLimit: 4, // Batasi jumlah label di sumbu Y
                            stepSize: 10
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>
