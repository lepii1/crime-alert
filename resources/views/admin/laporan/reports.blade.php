<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Analisis Laporan - Admin Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 260px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s ease-in-out; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }

        .sidebar-nav a { display: flex; align-items: center; padding: 14px 24px; color: #ecf0f1; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; font-size: 0.9rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; color: #fff; font-weight: 600; }

        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 260px; } }

        .chart-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 30px; border: 1px solid #edf2f7; transition: 0.3s; }
        .chart-card:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }

        .select-custom { @apply bg-gray-50 border border-gray-100 text-gray-700 text-xs rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 outline-none font-bold uppercase tracking-tighter; }

        /* Tombol PDF Modern */
        .btn-pdf { @apply bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-red-100 transition-all active:scale-95 flex items-center; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- HAMBURGER --}}
<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-indigo-600 p-3 rounded-full text-white shadow-xl cursor-pointer active:scale-95 transition">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
    {{-- SIDEBAR --}}
    <div class="sidebar shadow-2xl" :class="{'sidebar-open': open}">
        <div class="flex flex-col h-full">
            <div class="p-8 border-b border-gray-700">
                <a href="{{ url('/') }}" class="flex items-center group">
                    <i class="fas fa-exclamation-circle text-red-500 text-3xl mr-3 group-hover:rotate-12 transition-transform"></i>
                    <span class="font-black text-xl tracking-tighter uppercase text-white">Crime Alert</span>
                </a>
            </div>

            <nav class="sidebar-nav mt-6 flex-grow">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i> Dashboard</a>
                <a href="{{ route('admin.laporan.index') }}"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
                <a href="#" class="active"><i class="fas fa-chart-bar mr-3 w-5 text-center"></i> Analisis Visual</a>
                <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-3 w-5 text-center"></i> Pengaturan</a>
            </nav>

            <div class="p-6 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 hover:bg-red-500/10 rounded-xl text-red-400 font-bold uppercase text-[10px] tracking-widest transition">
                        <i class="fas fa-power-off mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="open" @click="open = false" x-cloak class="fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm transition-opacity"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Analisis Visual</h1>
                <p class="text-gray-500 font-medium">Monitoring statistik dan tren laporan kejahatan.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4">
                <form method="GET" action="{{ route('admin.laporan.reports') }}" class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-4">Filter Tahun:</span>
                    <div class="min-w-[120px]">
                        <select name="year" onchange="this.form.submit()" class="select-custom border-none">
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ request('year', date('Y')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                {{-- TOMBOL CETAK PDF --}}
                <a href="{{ route('admin.laporan.exportPdf', ['year' => request('year', date('Y'))]) }}" class="btn-pdf">
                    <i class="fas fa-file-pdf mr-3 text-sm"></i> Cetak Laporan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="chart-card xl:col-span-2">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Tren Laporan Bulanan ({{ request('year', date('Y')) }})</h3>
                    <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                </div>
                <div class="relative h-[350px]">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-8">Perbandingan Antar Tahun</h3>
                <div class="relative h-[350px]">
                    <canvas id="yearlyComparisonChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-8">Distribusi Kategori</h3>
                <div class="relative h-[300px]">
                    <canvas id="categoryDistributionChart"></canvas>
                </div>
            </div>

            <div class="chart-card xl:col-span-2">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-8">Rasio Status Penanganan</h3>
                <div class="relative h-[300px]">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const monthlyData = @json($monthlyChartData);
    const yearlyData = @json($yearlyChartData);
    const categoryData = @json($categoryChartData);
    const statusData = @json($statusChartData);

    Chart.defaults.font.family = 'Poppins';
    Chart.defaults.color = '#94a3b8';

    new Chart(document.getElementById('monthlyTrendChart'), {
        type: 'line',
        data: {
            labels: monthlyData.labels,
            datasets: [{
                label: 'Laporan',
                data: monthlyData.data,
                borderColor: '#e74c3c',
                backgroundColor: 'rgba(231, 76, 60, 0.05)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#e74c3c',
                pointBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('yearlyComparisonChart'), {
        type: 'bar',
        data: {
            labels: yearlyData.labels,
            datasets: [{
                data: yearlyData.data,
                backgroundColor: '#2c3e50',
                borderRadius: 12,
                hoverBackgroundColor: '#e74c3c'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });

    new Chart(document.getElementById('categoryDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: categoryData.labels,
            datasets: [{
                data: categoryData.data,
                backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, padding: 20, font: { size: 10, weight: 'bold' } }
                }
            }
        }
    });

    new Chart(document.getElementById('statusDistributionChart'), {
        type: 'doughnut',
        data: {
            labels: statusData.labels,
            datasets: [{
                data: statusData.data,
                backgroundColor: ['#f1c40f', '#3498db', '#2ecc71'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        usePointStyle: true,
                        padding: 25,
                        font: { size: 12, weight: 'bold' }
                    }
                }
            }
        }
    });
</script>

<footer class="mt-auto py-8 text-center text-gray-400 text-xs font-medium">
    &copy; {{ date('Y') }} Crime Alert Report System. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
