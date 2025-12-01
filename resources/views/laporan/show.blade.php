<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laporan #{{ $laporan->id }} - Crime Alert</title>

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
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fde68a; color: #b45309; }
        .status-proses { background-color: #bfdbfe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .card-detail {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 24px;
        }
        .main-content-wrapper {
            max-width: 4xl;
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i>
            <h1 class="text-xl font-semibold">CRIME ALERT - LAPORAN #{{ $laporan->id }}</h1>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('user.dashboard') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i> Dashboard
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

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Laporan</h1>

        <div class="card-detail space-y-6">

            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-start border-b pb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $laporan->judul_laporan }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Dibuat pada {{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d F Y') }}</p>
                </div>
                <span class="status-badge status-{{ strtolower($laporan->status ?? 'pending') }}">
                        {{ ucfirst($laporan->status ?? 'pending') }}
                    </span>
            </div>

            {{-- DETAIL UTAMA --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">Kategori</h3>
                    <p class="text-gray-800 font-medium">{{ $laporan->kategori ?? '-' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">ID Laporan</h3>
                    <p class="text-gray-800 font-medium">#{{ $laporan->id }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">IP Terlapor</h3>
                    <p class="text-gray-800 font-medium">{{ $laporan->ip_terlapor ?? '-' }}</p>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="pt-4 border-t border-gray-100">
                <h3 class="text-sm font-semibold text-gray-500 mb-2">Deskripsi Lengkap</h3>
                <div class="p-3 bg-gray-50 rounded-lg text-gray-700 text-base">
                    {{ $laporan->deskripsi ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>

            {{-- STATUS PETUGAS PENANGANAN --}}
            <div class="pt-4 border-t border-gray-100">
                <h3 class="text-lg font-bold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-clipboard-list mr-2 text-indigo-600"></i> Status Penanganan
                </h3>

                @if ($laporan->polisi)
                    {{-- Polisi sudah ditugaskan --}}
                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-lg">
                        <p class="font-medium text-indigo-800 mb-1">
                            <i class="fas fa-user-shield mr-1"></i> Ditangani oleh: {{ $laporan->polisi->nama ?? 'Petugas Khusus' }}
                        </p>
                        <p class="text-indigo-600 text-sm">Jabatan: {{ $laporan->polisi->jabatan ?? 'Petugas Penanganan' }}</p>
                        <p class="text-sm text-indigo-600 mt-2 italic">Laporan ini sedang dalam proses penyelidikan.</p>
                    </div>
                @else
                    {{-- Belum ditugaskan --}}
                    <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 rounded-lg">
                        <p class="font-medium text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Laporan Anda masih menunggu penugasan petugas.
                        </p>
                        <p class="text-sm text-yellow-700 mt-1">Kami akan memberitahu Anda ketika laporan mulai diproses.</p>
                    </div>
                @endif
            </div>

            {{-- TOMBOL KEMBALI --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <a href="{{ route('user.dashboard') }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</main>
</body>
</html>
