<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Saya - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            min-height: 100vh;
        }
        /* Menggunakan warna tema admin di header */
        .header {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        .header-logo {
            color: #e74c3c; /* Aksen merah */
        }
        .status-badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        /* Warna Badge Status */
        .status-pending { background-color: #fde68a; color: #b45309; }
        .status-proses { background-color: #bfdbfe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        /* Warna Card Summary (Menggunakan aksen tema) */
        .card-total { border-left: 5px solid #2c3e50; }
        .card-pending { border-left: 5px solid #f39c12; }
        .card-proses { border-left: 5px solid #3498db; }
        .card-selesai { border-left: 5px solid #27ae60; }

        .main-content-wrapper {
            max-width: 7xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

{{-- HEADER/NAVIGASI ATAS --}}
<header class="header shadow-lg">
    <div class="main-content-wrapper py-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i>
            <h1 class="text-xl font-semibold hidden sm:block">CRIME ALERT - DASHBOARD SAYA</h1>
            <h1 class="text-xl font-semibold sm:hidden">DASHBOARD</h1>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('laporan.create') }}" class="px-3 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition text-sm whitespace-nowrap">
                <i class="fas fa-plus mr-1"></i> Buat Laporan
            </a>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm hover:text-gray-300 transition whitespace-nowrap">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</header>

{{-- KONTEN UTAMA --}}
<main class="py-12">
    <div class="main-content-wrapper">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Ringkasan Laporan Anda</h2>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- SUMMARY CARDS (RESPONSIVE) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-total">
                <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                {{-- Asumsi variabel $summary tersedia dari controller --}}
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['total'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-pending">
                <p class="text-sm font-medium text-gray-500">Menunggu (Pending)</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['pending'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-proses">
                <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['proses'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-selesai">
                <p class="text-sm font-medium text-gray-500">Selesai</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['selesai'] ?? 0 }}</p>
            </div>
        </div>

        {{-- DAFTAR LAPORAN --}}
        <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Laporan Saya</h3>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Laporan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{-- Asumsi variabel $laporans tersedia dari controller --}}
                    @forelse ($laporans as $laporan)
                        <tr class="hover:bg-gray-100 transition duration-150">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $laporan->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->judul_laporan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $laporan->kategori }}</td>
                            <td class="px-6 py-4 text-sm">
                                    <span class="status-badge status-{{ strtolower($laporan->status) }}">
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-center">
                                <a href="{{ route('laporan.show', $laporan->id) }}" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                <p class="font-medium">Anda belum membuat laporan apa pun.</p>
                                <a href="{{ route('laporan.create') }}" class="mt-2 text-indigo-600 hover:underline">Buat Laporan Pertama Anda</a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
</html>
