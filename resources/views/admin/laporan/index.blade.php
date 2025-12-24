<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laporan Masuk - Admin Crime Alert</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 260px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s ease-in-out; transform: translateX(-100%); }
        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        .sidebar-open { transform: translateX(0) !important; }

        .sidebar-nav a { display: flex; align-items: center; padding: 14px 24px; color: #ecf0f1; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; font-size: 0.9rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; color: #fff; font-weight: 600; }

        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 260px; } }

        .content-card { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 30px; border: 1px solid #edf2f7; }

        .status-badge { padding: 5px 12px; border-radius: 12px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .filter-btn { @apply px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest transition-all border; }
        .filter-btn-active { @apply bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-200; }
        .filter-btn-inactive { @apply bg-white text-gray-400 border-gray-100 hover:border-indigo-200 hover:text-indigo-500; }

        .select-custom { @apply bg-gray-50 border border-gray-100 text-gray-700 text-xs rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 outline-none font-bold uppercase tracking-tighter; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false, modalOpen: false, deleteUrl: '' }">

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
                <a href="#" class="active"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
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
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Manajemen Laporan</h1>
                <p class="text-gray-500 font-medium">Daftar semua insiden yang dilaporkan oleh warga.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-2.5 rounded-2xl shadow-sm border text-xs font-bold text-gray-400 uppercase tracking-widest">
                <i class="fas fa-filter text-indigo-500"></i> Penelusuran Data
            </div>
        </div>

        <div class="content-card">
            {{-- MESSAGES --}}
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl mb-8 flex items-center shadow-sm">
                    <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                    <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @php
                $baseQuery = [
                    'status' => $selectedStatus,
                    'year' => $selectedYear,
                    'month' => $selectedMonth
                ];
            @endphp

            {{-- CATEGORY FILTER --}}
            <div class="flex flex-wrap items-center gap-4 mb-6 pb-4 border-b">
                <div class="flex flex-col w-full">
                    <label class="text-xs font-medium text-gray-500 mb-1">Kategori Kejahatan</label>
                    <div class="flex flex-wrap gap-2">

                        <a href="{{ route('admin.laporan.index', array_merge($baseQuery, ['kategori' => 'semua'])) }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap
                                       {{ $selectedKategori == 'semua' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            Semua
                        </a>

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

            {{-- DROPDOWN FILTERS --}}
            <form method="GET" action="{{ route('admin.laporan.index') }}" class="w-full">

                <input type="hidden" name="kategori" value="{{ $selectedKategori }}">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

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

            {{-- DATA TABLE --}}
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

{{-- MODAL KONFIRMASI HAPUS (Refined) --}}
<div x-show="modalOpen" x-cloak class="fixed inset-0 flex items-center justify-center z-[100] px-4">
    <div @click="modalOpen = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <div class="bg-white p-8 rounded-[32px] max-w-sm w-full relative shadow-2xl transform transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0">

        <div class="text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6 text-3xl">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-800 mb-3 tracking-tight">Hapus Laporan?</h3>
            <p class="text-sm text-gray-500 leading-relaxed mb-8">Tindakan ini akan menghapus laporan secara permanen dari database dan tidak dapat dibatalkan.</p>
        </div>

        <div class="flex flex-col gap-3">
            <form :action="deleteUrl" method="POST" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-black rounded-2xl shadow-xl shadow-red-200 transition-all active:scale-95 uppercase tracking-widest text-xs">
                    Ya, Hapus Sekarang
                </button>
            </form>
            <button @click="modalOpen = false"
                    class="w-full py-4 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-2xl transition-all uppercase tracking-widest text-xs">
                Batalkan
            </button>
        </div>
    </div>
</div>

</body>
</html>
