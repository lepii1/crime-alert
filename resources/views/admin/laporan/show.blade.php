<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Laporan #{{ $laporan->id }} - Admin Panel</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Leaflet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        /* Sidebar Styling */
        .sidebar { width: 250px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }
        .sidebar-nav a { display: flex; align-items: center; padding: 12px 20px; color: #ecf0f1; text-decoration: none; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; }

        /* Layout */
        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 250px; } }

        /* Badges */
        .status-badge { padding: 5px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .card-detail { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 25px; }
        .img-preview { width: 100%; max-height: 300px; object-fit: contain; border-radius: 8px; background: #f8fafc; border: 1px solid #e2e8f0; }
        #map { height: 300px; border-radius: 8px; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- MOBILE MENU --}}
<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-indigo-600 p-3 rounded-full text-white shadow-xl cursor-pointer">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
    {{-- SIDEBAR --}}
    <div class="sidebar shadow-2xl" :class="{'sidebar-open': open}">
        <div class="flex flex-col h-full">
            <div class="p-6 flex items-center border-b border-gray-700">
                <i class="fas fa-shield-alt text-red-500 text-2xl mr-3"></i>
                <span class="font-bold text-lg tracking-wider uppercase">Crime Alert</span>
            </div>
            <nav class="sidebar-nav mt-4 flex-grow">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line mr-3"></i> Dashboard</a>
                <a href="{{ route('admin.laporan.index') }}" class="active"><i class="fas fa-list-ul mr-3"></i> Semua Laporan</a>
                <a href="#"><i class="fas fa-users-cog mr-3"></i> Data Petugas</a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 hover:bg-gray-700 rounded-lg text-red-400">
                        <i class="fas fa-power-off mr-3"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800">Detail Laporan</h1>
            <div class="mt-4 md:mt-0">
                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                    Status : {{ $laporan->status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: DATA LAPORAN & BUKTI --}}
            <div class="xl:col-span-2 space-y-8">
                <div class="card-detail">
                    <h2 class="text-xl font-bold mb-6 border-b pb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-indigo-500"></i> Informasi Laporan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Judul Kejadian</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $laporan->judul_laporan }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Kategori</p>
                            <p class="text-gray-900 font-medium bg-gray-100 inline-block px-3 py-1 rounded">{{ $laporan->kategori }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs font-bold text-gray-400 uppercase">Kronologi / Deskripsi</p>
                            <p class="text-gray-700 mt-2 bg-gray-50 p-4 rounded-lg border border-gray-100 whitespace-pre-line">{{ $laporan->deskripsi }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-xs font-bold text-gray-400 uppercase">Lokasi Kejadian</p>
                            <p class="text-gray-700 mt-2 bg-gray-50 p-4 rounded-lg border border-gray-100 whitespace-pre-line">{{ $laporan->lokasi_kejadian }}</p>
                        </div>
                    </div>
                </div>

                {{-- BUKTI FOTO & MAP --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card-detail">
                        <h3 class="text-sm font-bold text-gray-500 mb-4 uppercase tracking-wider">Foto Bukti Kejadian</h3>
                        @if($laporan->bukti_kejadian)
                            <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" class="img-preview shadow-sm" alt="Bukti">
                        @else
                            <div class="bg-gray-100 h-48 rounded flex items-center justify-center text-gray-400 italic text-sm">Tidak ada foto bukti</div>
                        @endif
                    </div>
                    <div class="card-detail">
                        <h3 class="text-sm font-bold text-gray-500 mb-4 uppercase tracking-wider">Lokasi di Peta</h3>
                        @if($laporan->latitude && $laporan->longitude)
                            <div id="map"></div>
                        @else
                            <div class="bg-gray-100 h-48 rounded flex items-center justify-center text-gray-400 italic text-sm">Koordinat tidak tersedia</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: PELAPOR & PETUGAS --}}
            <div class="space-y-8">
                {{-- VERIFIKASI PELAPOR --}}
                <div class="card-detail">
                    <h2 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-user-check mr-2 text-green-500"></i> Identitas Pelapor
                    </h2>
                    <div class="mb-4">
                        <p class="text-sm font-bold text-gray-800">{{ $laporan->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $laporan->user->email }}</p>
                        <p class="text-xs text-gray-400 mt-1">IP: {{ $laporan->ip_terlapor ?? 'N/A' }}</p>
                    </div>

                    <div class="mt-4 border-t pt-4">
                        <p class="text-xs font-bold text-gray-400 uppercase mb-2">Foto KTP / Identitas</p>
                        @if($laporan->foto_identitas)
                            <img src="{{ asset('storage/' . $laporan->foto_identitas) }}" class="img-preview cursor-pointer hover:opacity-90 transition" alt="KTP" onclick="window.open(this.src)">
                        @else
                            <div class="bg-red-50 text-red-500 p-3 rounded text-xs">Foto Identitas Belum Diunggah</div>
                        @endif
                    </div>
                </div>

                {{-- PENUGASAN POLISI --}}
                <div class="card-detail">
                    <h2 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-user-shield mr-2 text-indigo-600"></i> Penugasan Petugas
                    </h2>

                    @if ($laporan->polisi)
                        <div class="p-4 bg-indigo-50 rounded-xl border-l-4 border-indigo-600 shadow-inner">
                            <p class="text-xs text-indigo-400 font-bold uppercase">Petugas Terpilih:</p>
                            <p class="text-lg font-bold text-indigo-900">{{ $laporan->polisi->nama }}</p>
                            <p class="text-indigo-600 text-sm italic">{{ $laporan->polisi->jabatan ?? 'Petugas Penanganan' }}</p>
                        </div>
                    @else
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                            <form action="{{ route('admin.laporan.assign.store', $laporan->id) }}" method="POST">
                                @csrf
                                <label class="block text-xs font-bold text-red-600 uppercase mb-2">Belum Ada Petugas</label>
                                <select name="polisi_id" class="w-full border-gray-300 rounded-lg text-sm mb-3">
                                    <option value="">-- Pilih Petugas --</option>
                                    @foreach($polisis as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->jabatan }})</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition">
                                    Konfirmasi Penugasan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="w-full text-center bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 rounded-xl transition">
                        <i class="fas fa-edit mr-2"></i> Update Status Laporan
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Leaflet Map Script --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lat = {{ $laporan->latitude ?? 0 }};
        const lng = {{ $laporan->longitude ?? 0 }};

        if (lat !== 0 && lng !== 0) {
            const map = L.map('map').setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('Titik Kejadian').openPopup();
        }
    });
</script>

</body>
</html>
