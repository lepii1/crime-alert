{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>Dashboard Saya - Crime Alert</title>--}}

{{--    <!-- Tailwind CSS -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--    <style>--}}
{{--        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');--}}
{{--        body {--}}
{{--            font-family: 'Poppins', sans-serif;--}}
{{--            background-color: #f0f2f5;--}}
{{--            margin: 0;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}
{{--        /* Menggunakan warna tema admin di header */--}}
{{--        .header {--}}
{{--            background-color: #2c3e50;--}}
{{--            color: #ecf0f1;--}}
{{--        }--}}
{{--        .header-logo {--}}
{{--            color: #e74c3c; /* Aksen merah */--}}
{{--        }--}}
{{--        .status-badge {--}}
{{--            padding: 4px 10px;--}}
{{--            border-radius: 9999px;--}}
{{--            font-size: 0.75rem;--}}
{{--            font-weight: 600;--}}
{{--        }--}}
{{--        /* Warna Badge Status */--}}
{{--        .status-pending { background-color: #fde68a; color: #b45309; }--}}
{{--        .status-proses { background-color: #bfdbfe; color: #1e40af; }--}}
{{--        .status-selesai { background-color: #d1fae5; color: #065f46; }--}}

{{--        /* Warna Card Summary (Menggunakan aksen tema) */--}}
{{--        .card-total { border-left: 5px solid #2c3e50; }--}}
{{--        .card-pending { border-left: 5px solid #f39c12; }--}}
{{--        .card-proses { border-left: 5px solid #3498db; }--}}
{{--        .card-selesai { border-left: 5px solid #27ae60; }--}}

{{--        .main-content-wrapper {--}}
{{--            max-width: 7xl;--}}
{{--            margin-left: auto;--}}
{{--            margin-right: auto;--}}
{{--            padding-left: 1rem;--}}
{{--            padding-right: 1rem;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--</head>--}}
{{--<body>--}}

{{-- HEADER/NAVIGASI ATAS --}}
{{--<header class="header shadow-lg">--}}
{{--    <div class="main-content-wrapper py-4 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <ul>--}}
{{--                <li><a href="{{ url('/') }}"><i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i> <span class="text-white text-xl font-semibold"> CRIME ALERT - DASHBOARD SAYA</span></a></li>--}}
{{--            </ul>--}}
{{--            <h1 class="text-xl font-semibold sm:hidden">DASHBOARD</h1>--}}
{{--        </div>--}}

{{--        <div class="flex items-center space-x-4">--}}
{{--            <a href="{{route('user.home') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm">--}}
{{--                Beranda--}}
{{--            </a>--}}

{{--            <a href="{{ route('laporan.create') }}" class="px-3 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition text-sm whitespace-nowrap">--}}
{{--                <i class="fas fa-plus  mr-1"></i> Buat Laporan--}}
{{--            </a>--}}

{{--            --}}{{-- LOGOUT --}}
{{--            <form method="POST" action="{{ route('logout') }}">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="text-sm hover:text-gray-300 transition whitespace-nowrap">--}}
{{--                    <i class="fas fa-sign-out-alt mr-1"></i> Logout--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{-- KONTEN UTAMA --}}
{{--<main class="py-10">--}}
{{--    <div class="main-content-wrapper">--}}
{{--        <h2 class="text-2xl font-bold text-gray-800 mb-6">Ringkasan Laporan Anda</h2>--}}

{{--        --}}{{-- Pesan sukses --}}
{{--        @if (session('success'))--}}
{{--            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm">--}}
{{--                {{ session('success') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        --}}{{-- SUMMARY CARDS (RESPONSIVE) --}}
{{--        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">--}}

{{--            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-total">--}}
{{--                <p class="text-sm font-medium text-gray-500">Total Laporan</p>--}}
{{--                --}}{{-- Asumsi variabel $summary tersedia dari controller --}}
{{--                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['total'] ?? 0 }}</p>--}}
{{--            </div>--}}

{{--            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-pending">--}}
{{--                <p class="text-sm font-medium text-gray-500">Menunggu (Pending)</p>--}}
{{--                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['pending'] ?? 0 }}</p>--}}
{{--            </div>--}}

{{--            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-proses">--}}
{{--                <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>--}}
{{--                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['proses'] ?? 0 }}</p>--}}
{{--            </div>--}}

{{--            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-selesai">--}}
{{--                <p class="text-sm font-medium text-gray-500">Selesai</p>--}}
{{--                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['selesai'] ?? 0 }}</p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- DAFTAR LAPORAN --}}
{{--        <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Laporan Saya</h3>--}}
{{--        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--            <div class="overflow-x-auto">--}}
{{--                <table class="min-w-full divide-y divide-gray-200">--}}
{{--                    <thead class="bg-gray-50">--}}
{{--                    <tr>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Laporan</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>--}}
{{--                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="bg-white divide-y divide-gray-200">--}}
{{--                    --}}{{-- Asumsi variabel $laporans tersedia dari controller --}}
{{--                    @forelse ($laporans as $laporan)--}}
{{--                        <tr class="hover:bg-gray-100 transition duration-150">--}}
{{--                            <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $laporan->id }}</td>--}}
{{--                            <td class="px-6 py-4 text-sm text-gray-900">{{ $laporan->judul_laporan }}</td>--}}
{{--                            <td class="px-6 py-4 text-sm text-gray-500">{{ $laporan->kategori }}</td>--}}
{{--                            <td class="px-6 py-4 text-sm">--}}
{{--                                    <span class="status-badge status-{{ strtolower($laporan->status) }}">--}}
{{--                                        {{ ucfirst($laporan->status) }}--}}
{{--                                    </span>--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d M Y') }}</td>--}}
{{--                            <td class="px-6 py-4 text-sm text-center">--}}
{{--                                <a href="{{ route('laporan.show', $laporan->id) }}" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Detail</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">--}}
{{--                                <p class="font-medium">Anda belum membuat laporan apa pun.</p>--}}
{{--                                <a href="{{ route('laporan.create') }}" class="mt-2 text-indigo-600 hover:underline">Buat Laporan Pertama Anda</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</main>--}}
{{--</body>--}}
{{--</html>--}}

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
        /* Header Styling */
        .header {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        .header-logo {
            color: #e74c3c;
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

        .card-summary {
            @apply bg-white p-6 rounded-2xl shadow-sm border-l-8 transition-all duration-300 hover:shadow-md hover:-translate-y-1;
        }
        .summary-icon {
            @apply w-12 h-12 rounded-xl flex items-center justify-center text-xl mb-4 shadow-inner;
        }

        .main-content-wrapper {
            max-width: 7xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .table-container {
            @apply bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mt-6;
        }

        .nav-item {
            @apply flex items-center px-4 py-2 rounded-xl transition-all duration-200 text-sm font-medium hover:bg-white/10;
        }
        .nav-item.active {
            @apply bg-white/20 text-white font-bold;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ mobileMenu: false }">

{{-- HEADER --}}
<header class="header shadow-lg sticky top-0 z-50">
    <div class="main-content-wrapper py-4 flex justify-between items-center">
        <div class="flex items-center group">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 header-logo text-3xl group-hover:scale-110 transition-transform"></i>
                <span class="text-white text-xl font-extrabold tracking-tight hidden sm:block">CRIME ALERT</span>
            </a>
        </div>

        <nav class="hidden lg:flex items-center space-x-2">
            <a href="{{ route('user.home') }}" class="nav-item">
                <i class="fas fa-rss mr-2 text-xs"></i> Beranda
            </a>
            <a href="{{ route('user.dashboard') }}" class="nav-item active">
                <i class="fas fa-th-large mr-2 text-xs"></i> Dashboard
            </a>

        </nav>

        <div class="flex items-center space-x-3">
            <a href="{{ route('laporan.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg active:scale-95 hidden sm:flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Buat Laporan
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="p-2.5 text-gray-400 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </button>
            </form>

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-white">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu" x-cloak class="lg:hidden bg-[#34495e] border-t border-white/10 p-4 space-y-2">
        <a href="{{ route('user.home') }}" class="block p-3 text-white font-medium hover:bg-white/10 rounded-lg">Beranda</a>
        <a href="{{ route('user.dashboard') }}" class="block p-3 text-white font-bold bg-white/10 rounded-lg">Dashboard Saya</a>
    </div>
</header>

<main class="py-12">
    <div class="main-content-wrapper">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Ringkasan Laporan</h2>
                <p class="text-gray-500 font-medium">Selamat datang kembali! Berikut pantauan laporan Anda.</p>
            </div>
            <span class="text-xs font-bold text-gray-400 uppercase bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                <i class="far fa-calendar-alt mr-2 text-indigo-500"></i> {{ date('d F Y') }}
            </span>
        </div>

        {{-- Aler Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-8 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-total">
                <div class="summary-icon text-[#2c3e50]">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Total Laporan</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['total'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-pending">
                <div class="summary-icon text-yellow-600">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Menunggu (Pending)</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['pending'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-proses">
                <div class="summary-icon text-blue-600">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['proses'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-5 rounded-xl shadow-lg border-l-4 card-selesai">
                <div class="summary-icon text-green-600">
                    <i class="fas fa-check-double"></i>
                </div>
                <p class="text-sm font-medium text-gray-500">Selesai</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $summary['selesai'] ?? 0 }}</p>
            </div>
        </div>

        {{-- RIWAYAT TABEL --}}
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-history mr-3 text-indigo-500"></i> Riwayat Laporan Saya
            </h3>
        </div>

        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">ID Laporan</th>
                        <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Judul & Kategori</th>
                        <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Lokasi Kejadian</th>
                        <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tgl Lapor</th>
                        <th class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($laporans as $laporan)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-5 text-sm font-bold text-indigo-600">#{{ $laporan->id }}</td>
                            <td class="px-6 py-5">
                                <p class="text-sm font-bold text-gray-800">{{ $laporan->judul_laporan }}</p>
                                <span class="text-[10px] font-medium text-gray-400 uppercase">{{ $laporan->kategori }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm font-bold text-gray-800">{{ $laporan->lokasi_kejadian }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-xs text-gray-500 font-medium">
                                <i class="far fa-clock mr-1 opacity-60"></i> {{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                <a href="{{ route('laporan.show', $laporan->id) }}" class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-600 text-xs font-bold rounded-lg hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                    Detail <i class="fas fa-chevron-right ml-2 text-[8px]"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-gray-200 text-6xl mb-4"></i>
                                    <p class="font-bold text-gray-400 uppercase tracking-widest text-sm">Belum ada laporan</p>
                                    <a href="{{ route('laporan.create') }}" class="mt-4 text-indigo-600 font-bold hover:underline">Buat Laporan Pertama Anda</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<footer class="mt-auto py-8 text-center text-gray-400 text-xs font-medium">
    &copy; {{ date('Y') }} Crime Alert Report System. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
