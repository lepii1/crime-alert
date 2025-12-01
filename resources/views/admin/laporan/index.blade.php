<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laporan Masuk - Crime Alert</title>

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
        .sidebar-nav form {
            width: 100%;
        }
        .sidebar-nav form button {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s ease;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }

        /* PUSH LOGOUT KE BAWAH */
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

        /* CSS Badge Status */
        .status-badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-pending { background-color: #fde68a; color: #b45309; }
        .status-proses { background-color: #bfdbfe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        /* Styling untuk Select Box (Dropdown) */
        .select-filter {
            appearance: none;
            padding-right: 2.5rem;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='none'%3e%3cpath d='M7 7l3 3 3-3m0 6l-3-3-3 3' stroke='%236B7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em 1.5em;
        }
        .dashboard-header {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }
        .modal-bg {
            background-color: rgba(0, 0, 0, 0.75);
            transition: opacity 0.3s ease;
            z-index: 99;
        }
        .modal-content {
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
    </style>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false, modalOpen: false, deleteUrl: '' }">

{{-- TOMBOL HAMBURGER --}}
<div @click="open = true"
     class="lg:hidden fixed top-3 right-1 m-4 p-2 bg-indigo-600 text-white rounded-lg shadow-lg cursor-pointer z-[60]">
    <i class="fas fa-bars"></i>
</div>

<div class="flex-container">

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
                        <li><a href="#" class="active" @click="open = false"><i class="fas fa-bell"></i> Laporan Masuk</a></li>
                        <li><a href="#" @click="open = false"><i class="fas fa-chart-bar"></i> Reports</a></li>
                        <li><a href="{{ route('profile.edit') }}" @click="open = false"><i class="fas fa-cog"></i> Settings</a></li>
                    </ul>
                </nav>
            </div>

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

    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden"
         style="display: none;">
    </div>

    {{-- KONTEN UTAMA --}}
    <div class="main-content">
        <h1 class="dashboard-header">Laporan Masuk</h1>

        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Pesan sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $baseQuery = [
                            'status' => $selectedStatus,
                            'year' => $selectedYear,
                            'month' => $selectedMonth
                        ];
                    @endphp

                    {{-- 🔹 Filter Kategori (RESPONSIVE) --}}
                    <div class="flex flex-wrap items-center gap-4 mb-6 pb-4 border-b">
                        <div class="flex flex-col w-full">
                            <label class="text-xs font-medium text-gray-500 mb-1">Kategori Kejahatan</label>
                            <div class="flex flex-wrap gap-2">

                                {{-- Link untuk Semua Kategori --}}
                                <a href="{{ route('admin.laporan.index', array_merge($baseQuery, ['kategori' => 'semua'])) }}"
                                   class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap
                                       {{ $selectedKategori == 'semua' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                    Semua
                                </a>

                                {{-- Link kategori dinamis --}}
                                @foreach($kategoriList as $kategori)
                                    <a href="{{ route('admin.laporan.index', array_merge($baseQuery, ['kategori' => $kategori])) }}"
                                       class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap
                                            {{ $selectedKategori == $kategori ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                        {{ $kategori }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    {{-- 🔹 Form Filter Waktu dan Status (Dropdowns - RESPONSIVE) --}}
                    <form method="GET" action="{{ route('admin.laporan.index') }}" class="w-full">

                        {{-- Hidden field untuk mempertahankan KATEGORI yang dipilih --}}
                        <input type="hidden" name="kategori" value="{{ $selectedKategori }}">

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

                            {{-- Filter Tahun --}}
                            <div class="flex flex-col">
                                <label for="filter-year" class="text-xs font-medium text-gray-500 mb-1">Filter Tahun</label>
                                <select id="filter-year" name="year" onchange="this.form.submit()"
                                        class="select-filter border-gray-300 rounded-lg text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                                    <option value="semua">Semua Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Bulan --}}
                            <div class="flex flex-col">
                                <label for="filter-month" class="text-xs font-medium text-gray-500 mb-1">Filter Bulan</label>
                                <select id="filter-month" name="month" onchange="this.form.submit()"
                                        class="select-filter border-gray-300 rounded-lg text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                                    <option value="semua">Semua Bulan</option>
                                    @php
                                        $months = [1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'];
                                    @endphp
                                    @foreach($months as $num => $name)
                                        <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Status (Dropdown) --}}
                            <div class="flex flex-col">
                                <label for="filter-status" class="text-xs font-medium text-gray-500 mb-1">Filter Status</label>
                                <select id="filter-status" name="status" onchange="this.form.submit()"
                                        class="select-filter border-gray-300 rounded-lg text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 w-full">
                                    <option value="semua">Semua Status</option>
                                    <option value="pending" {{ $selectedStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" {{ $selectedStatus == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $selectedStatus == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                        </div>
                    </form>

                    {{-- 🔹 Tabel Data (Responsive: Scrollable di Mobile) --}}
                    <div class="overflow-x-auto border rounded-lg shadow-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Pelapor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Tanggal Lapor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase whitespace-nowrap">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($laporan as $item)
                                <tr class="hover:bg-gray-100 transition duration-150">

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $item->judul_laporan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $item->user->name ?? 'User Dihapus' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tgl_lapor)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $item->kategori }}</td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                            <span class="status-badge status-{{ strtolower($item->status) }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                                        <div class="inline-flex space-x-2 justify-end w-full">
                                            <a href="{{ route('admin.laporan.show', $item->id) }}" class="px-2 py-1 text-xs bg-indigo-600 text-white rounded hover:bg-indigo-700">Detail</a>
                                            <a href="{{ route('admin.laporan.edit', $item->id) }}" class="px-2 py-1 text-xs bg-yellow-600 text-white rounded hover:bg-yellow-700">Edit</a>
                                            <button
                                                type="button"
                                                class="px-2 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700"
                                                @click="modalOpen = true; deleteUrl = '{{ route('admin.laporan.destroy', $item->id) }}'">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                        <p class="font-medium">🎉 Tidak ada laporan ditemukan untuk filter ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div x-show="modalOpen"
     class="fixed inset-0 flex items-center justify-center modal-bg z-[100]"
     style="display: none;">
    <div @click.away="modalOpen = false" class="bg-white modal-content p-6 rounded-lg mx-4"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="text-center">
            <i class="fas fa-trash-alt text-red-500 text-4xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Hapus</h3>
            <p class="text-gray-600 mb-6">Anda yakin ingin menghapus laporan ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
        </div>

        <div class="flex justify-end space-x-3">
            <button @click="modalOpen = false"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
                Batal
            </button>
            <form :action="deleteUrl" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition">
                    Ya, Hapus Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
