<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Laporan - Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk interaksi sidebar di mobile -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
            padding-top: 4px;
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
            margin-left: 0;
        }
        @media (min-width: 1024px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .detail-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
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
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- TOMBOL HAMBURGER --}}
<div @click="open = true"
     class="lg:hidden fixed top-3 right-1 m-4 p-2 bg-indigo-600 text-white rounded-lg shadow-lg cursor-pointer z-[60]">
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
                        <li><a href="{{ route('admin.dashboard') }}" @click="open = false"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="{{ route('admin.laporan.index') }}" class="active" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="#" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
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
        <h1 class="detail-header">
            {{ __('Detail Laporan') }}
        </h1>

        <div class="max-w-4xl mx-auto">
            <div class="card-detail space-y-6">

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- DETAIL LAPORAN UTAMA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 pb-6 border-b border-gray-100">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-1">Judul Laporan</h3>
                        <p class="text-gray-900 font-medium">{{ $laporan->judul_laporan ?? '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-1">Kategori</h3>
                        <p class="text-gray-900 font-medium">{{ $laporan->kategori ?? '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-1">Tanggal Lapor</h3>
                        <p class="text-gray-900">{{ $laporan->tgl_lapor ? \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d F Y') : '-' }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-1">Pelapor</h3>
                        <p class="text-gray-900">{{ $laporan->user->name ?? 'User Dihapus' }}</p>
                        <p class="text-gray-500 text-sm">{{ $laporan->user->email ?? '' }}</p>
                    </div>
                </div>

                {{-- DESKRIPSI DAN STATUS --}}
                <div class="space-y-4 pt-4 border-b border-gray-100 pb-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">Deskripsi Laporan</h3>
                        <div class="p-3 bg-gray-50 rounded-lg text-gray-700 text-sm">
                            {{ $laporan->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-1">Status Laporan</h3>
                        <span class="status-badge status-{{ strtolower($laporan->status ?? 'pending') }}">
                                {{ ucfirst($laporan->status ?? 'pending') }}
                            </span>
                    </div>
                </div>


                {{-- 🟢 KONDISI PENUGASAN POLISI --}}
                <div class="pt-4">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-user-shield mr-2 text-indigo-600"></i> Penugasan Petugas
                    </h3>

                    @if ($laporan->polisi)
                        {{-- KONDISI 1: SUDAH DITUGASKAN --}}
                        <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-lg shadow-sm">
                            <p class="font-medium text-indigo-800 mb-2">
                                <i class="fas fa-check-circle mr-1"></i> Laporan ini ditugaskan kepada:
                            </p>
                            <p class="text-lg font-bold text-indigo-900">{{ $laporan->polisi->nama ?? 'Petugas Tidak Diketahui' }}</p>
                            <p class="text-indigo-600 text-sm">Jabatan: {{ $laporan->polisi->jabatan ?? '-' }}</p>
                        </div>
                    @else
                        {{-- KONDISI 2: BELUM DITUGASKAN (Tampilkan Formulir) --}}
                        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-lg shadow-sm">
                            <p class="font-medium text-red-800 mb-3">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Laporan ini belum ditugaskan.
                            </p>

                            <form action="{{ route('admin.laporan.assign.store', $laporan->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <label for="polisi_id" class="block text-sm font-medium text-gray-700">Tugaskan ke Polisi:</label>
                                <select name="polisi_id" id="polisi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Pilih Polisi --</option>
                                    @foreach($polisis as $p)
                                        <option value="{{ $p->id }}" {{ old('polisi_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama }} ({{ $p->jabatan ?? 'Tidak Diketahui' }})
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="w-full mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                                    Tugaskan Sekarang
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="pt-6 border-t border-gray-100 flex justify-end space-x-3">
                    <a href="{{ route('admin.laporan.index') }}"
                       class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        ← Kembali
                    </a>
                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}"
                       class="inline-block px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-600 transition">
                        Edit Status Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
