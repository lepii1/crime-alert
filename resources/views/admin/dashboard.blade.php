<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Admin - Crime Alert</title>

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

        .stat-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 25px; border: 1px solid #edf2f7; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }

        .status-badge { padding: 5px 12px; border-radius: 12px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .alert-item { @apply flex items-center p-4 bg-gray-50 rounded-2xl border border-gray-100 transition hover:bg-red-50 hover:border-red-100 mb-3; }
        .recent-item { @apply flex items-center justify-between p-4 border-b border-gray-50 last:border-0 hover:bg-gray-50 transition; }
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
                <a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i> Dashboard</a>
                <a href="{{ route('admin.laporan.index') }}"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
                <a href="{{ route('admin.laporan.reports') }}"><i class="fas fa-chart-bar mr-3 w-5 text-center"></i> Analisis Visual</a>
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
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Pusat Kendali</h1>
                <p class="text-gray-500 font-medium">Ringkasan aktivitas laporan hari ini.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-2.5 rounded-2xl shadow-sm border text-xs font-bold text-gray-400 uppercase tracking-widest">
                <i class="fas fa-calendar-alt text-red-500"></i> {{ date('d M Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            {{-- GRAFIK TREN --}}
            <div class="stat-card lg:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Tren Laporan (12 Bulan)</h3>
                    <span class="text-[10px] font-bold text-indigo-500 bg-indigo-50 px-2 py-1 rounded">Real-time Data</span>
                </div>
                <div class="relative h-[250px]">
                    <canvas id="monthlyTrendChartDashboard"></canvas>
                </div>
            </div>

            {{-- CRIME ALERTS (PENDING) --}}
            <div class="stat-card">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6">Laporan Menunggu (Pending)</h3>
                <div class="overflow-y-auto max-h-[250px] pr-2">
                    @forelse($pendingReports as $report)
                        <a href="{{ route('admin.laporan.show', $report->id) }}" class="alert-item group">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-xs font-bold text-gray-800 line-clamp-1 capitalize">{{ $report->judul_laporan }}</p>
                                <p class="text-[10px] text-gray-400 font-medium uppercase mt-0.5">{{ $report->kategori }} &bull; {{ \Carbon\Carbon::parse($report->tgl_lapor)->diffForHumans() }}</p>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] text-gray-300 group-hover:translate-x-1 transition"></i>
                        </a>
                    @empty
                        <div class="text-center py-10 flex flex-col items-center">
                            <i class="fas fa-check-circle text-green-200 text-4xl mb-3"></i>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Semua Terkendali</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- RECENT REPORTS TABLE --}}
        <div class="stat-card">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Laporan Terbaru</h3>
                <a href="{{ route('admin.laporan.index') }}" class="text-[10px] font-bold text-indigo-500 hover:underline uppercase tracking-widest">Lihat Semua <i class="fas fa-arrow-right ml-1"></i></a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] border-b">
                        <th class="pb-4">Laporan</th>
                        <th class="pb-4">Kategori</th>
                        <th class="pb-4">Waktu Kejadian</th>
                        <th class="pb-4 text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                    @forelse($laporan as $report)
                        <tr class="group hover:bg-gray-50/50 transition">
                            <td class="py-5">
                                <p class="text-sm font-bold text-gray-800 capitalize">{{ $report->judul_laporan }}</p>
                                <p class="text-[10px] text-gray-400">ID #{{ $report->id }}</p>
                            </td>
                            <td class="py-5">
                                <span class="text-[11px] font-bold text-indigo-500 bg-indigo-50 px-2 py-1 rounded-md">{{ $report->kategori }}</span>
                            </td>
                            <td class="py-5 text-xs text-gray-500 font-medium italic">
                                {{ \Carbon\Carbon::parse($report->tgl_lapor)->format('d M Y') }}
                            </td>
                            <td class="py-5 text-center">
                                    <span class="status-badge status-{{ strtolower($report->status) }}">
                                        {{ $report->status }}
                                    </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center">
                                <p class="text-gray-400 italic text-sm">Belum ada data laporan masuk.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($monthlyChartData);
        const ctx = document.getElementById('monthlyTrendChartDashboard').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Laporan Masuk',
                    data: chartData.data,
                    backgroundColor: 'rgba(231, 76, 60, 0.05)',
                    borderColor: '#e74c3c',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#e74c3c',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10, weight: '600' } } },
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] }, ticks: { stepSize: 5, font: { size: 10 } } }
                }
            }
        });
    });
</script>

<footer class="mt-auto py-8 text-center text-gray-400 text-xs font-medium">
    &copy; {{ date('Y') }} Crime Alert Report System. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
