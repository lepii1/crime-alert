<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Laporan #{{ $laporan->id }} - Polisi Keamanan</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Leaflet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        /* Sidebar Styling (Tema Gelap Polisi) */
        .sidebar { width: 250px; background-color: #1a202c; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }
        .sidebar-nav a { display: flex; align-items: center; padding: 12px 20px; color: #cbd5e0; text-decoration: none; border-left: 4px solid transparent; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #2d3748; color: #fff; border-left: 4px solid #3182ce; }

        /* Layout */
        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 250px; } }

        /* Badges */
        .status-badge { padding: 5px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .card-detail { background: #fff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 25px; }
        .img-preview { width: 100%; max-height: 350px; object-fit: contain; border-radius: 8px; background: #f8fafc; border: 1px solid #e2e8f0; }
        #map { height: 300px; border-radius: 8px; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

{{-- MOBILE MENU --}}
<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-blue-600 p-3 rounded-full text-white shadow-xl cursor-pointer">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
    {{-- SIDEBAR POLISI --}}
    <div class="sidebar shadow-2xl" :class="{'sidebar-open': open}">
        <div class="flex flex-col h-full">
            <div class="p-6 flex items-center border-b border-gray-800">
                <i class="fas fa-user-shield text-blue-500 text-2xl mr-3"></i>
                <span class="font-bold text-lg tracking-wider uppercase">Panel POLISI</span>
            </div>
            <nav class="sidebar-nav mt-4 flex-grow">
                <a href="{{ route('polisi.dashboard') }}"><i class="fas fa-th-large mr-3"></i> Dashboard</a>
                <a href="{{ route('polisi.profil') }}"><i class="fas fa-user-circle mr-3"></i> Profil Saya</a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('polisi.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left p-3 hover:bg-gray-800 rounded-lg text-red-400 font-medium">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden" style="display: none;"></div>

    {{-- MAIN CONTENT --}}
    <div class="main-content w-full">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Detail Laporan #{{ $laporan->id }}</h1>
                <p class="text-gray-500 text-sm mt-1 italic">Diakses oleh Polisi: {{ Auth::guard('polisi')->user()->nama }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                    {{ $laporan->status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: DATA KEJADIAN & VISUAL --}}
            <div class="xl:col-span-2 space-y-8">
                <div class="card-detail">
                    <h2 class="text-xl font-bold mb-6 border-b pb-3 flex items-center text-gray-700">
                        <i class="fas fa-exclamation-circle mr-2 text-blue-500"></i> Informasi Kejadian
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Judul Laporan</p>
                            <p class="text-lg font-bold text-gray-900 leading-tight">{{ $laporan->judul_laporan }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori Kejahatan</p>
                            <p class="text-blue-700 font-bold bg-blue-50 inline-block px-3 py-1 rounded-full text-xs uppercase">{{ $laporan->kategori }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kronologi Kejadian</p>
                            <div class="text-gray-700 mt-2 bg-gray-50 p-5 rounded-xl border border-gray-100 leading-relaxed italic">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Lokasi Kejadian</p>
                            <div class="text-gray-700 mt-2 bg-gray-50 p-5 rounded-xl border border-gray-100 leading-relaxed italic">
                                {{ $laporan->lokasi_kejadian }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BUKTI FOTO & LOKASI PETA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card-detail">
                        <h3 class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-widest flex items-center">
                            <i class="fas fa-camera mr-2"></i> Foto Bukti TKP
                        </h3>
                        @if($laporan->bukti_kejadian)
                            <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" class="img-preview shadow-sm cursor-zoom-in" alt="Bukti Kejadian" onclick="window.open(this.src)">
                        @else
                            <div class="bg-gray-100 h-48 rounded-xl flex flex-col items-center justify-center text-gray-400 border-2 border-dashed">
                                <i class="fas fa-image text-3xl mb-2"></i>
                                <span class="text-xs font-medium uppercase">Tidak ada foto bukti</span>
                            </div>
                        @endif
                    </div>
                    <div class="card-detail">
                        <h3 class="text-xs font-bold text-gray-400 mb-4 uppercase tracking-widest flex items-center">
                            <i class="fas fa-map-marked-alt mr-2"></i> Titik Lokasi Kejadian
                        </h3>
                        @if($laporan->latitude && $laporan->longitude)
                            <div id="map" class="shadow-inner border border-gray-100"></div>
                            <div class="mt-3 flex justify-between items-center text-[10px] font-mono text-gray-500">
                                <span>坐标: {{ $laporan->latitude }}, {{ $laporan->longitude }}</span>
                                <a href="https://www.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank" class="text-blue-600 font-bold hover:underline italic">BUKA GOOGLE MAPS</a>
                            </div>
                        @else
                            <div class="bg-gray-100 h-48 rounded-xl flex flex-col items-center justify-center text-gray-400 border-2 border-dashed">
                                <i class="fas fa-map-marker-slash text-3xl mb-2"></i>
                                <span class="text-xs font-medium uppercase">Koordinat tidak tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: IDENTITAS PELAPOR & AKSI --}}
            <div class="space-y-8">
                {{-- IDENTITAS PELAPOR --}}
                <div class="card-detail border-t-4 border-green-500">
                    <h2 class="text-lg font-bold mb-5 flex items-center text-gray-800">
                        <i class="fas fa-id-card mr-2 text-green-500"></i> Verifikasi Pelapor
                    </h2>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-xl font-bold mr-4">
                            {{ substr($laporan->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 leading-none">{{ $laporan->user->name ?? 'User Tidak Diketahui' }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $laporan->user->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-50">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Foto KTP / Identitas Resmi</p>
                        @if($laporan->foto_identitas)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $laporan->foto_identitas) }}" class="img-preview shadow-md hover:brightness-75 transition cursor-pointer rounded-xl border border-gray-200" alt="KTP Pelapor" onclick="window.open(this.src)">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 pointer-events-none transition">
                                    <span class="bg-black/60 text-white text-[10px] px-2 py-1 rounded-full">Klik untuk memperbesar</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-red-50 text-red-500 p-4 rounded-xl border border-red-100 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-3"></i>
                                <span class="text-xs font-bold uppercase tracking-tighter">Foto Identitas Tidak Tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- STATUS PENANGANAN --}}
                <div class="card-detail">
                    <h2 class="text-lg font-bold mb-4 flex items-center text-gray-800">
                        <i class="fas fa-tasks mr-2 text-blue-600"></i> Tindakan Polisi
                    </h2>

                    @if ($bolehEdit)
                        <p class="text-xs text-gray-600 mb-4 leading-relaxed font-medium">Anda bertanggung jawab penuh atas investigasi laporan ini. Silakan perbarui status jika ada perkembangan di lapangan.</p>
                        <a href="{{ route('polisi.laporan.edit', $laporan->id) }}" class="w-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all active:scale-95 mb-3">
                            <i class="fas fa-edit mr-2"></i> UPDATE STATUS
                        </a>
                    @else
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                            @if ($laporan->polisi)
                                <p class="text-xs text-gray-500 font-bold uppercase mb-1">Polisi Bertanggung Jawab:</p>
                                <p class="text-sm font-bold text-gray-800">{{ $laporan->polisi->nama }}</p>
                                <p class="text-[10px] text-blue-600 italic mt-2">Laporan ini telah dikunci untuk Polisi lain.</p>
                            @else
                                <div class="text-center py-2">
                                    <i class="fas fa-lock text-gray-300 text-2xl mb-2"></i>
                                    <p class="text-xs text-gray-500 italic uppercase font-bold tracking-tighter">Laporan ini belum memiliki Polisi tetap.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <a href="{{ route('polisi.dashboard') }}" class="w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl transition mt-3">
                        <i class="fas fa-arrow-left mr-2"></i> KEMBALI KE BERANDA
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
            const map = L.map('map', {
                center: [lat, lng],
                zoom: 15,
                scrollWheelZoom: false // Hindari scroll yang tidak sengaja
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup('<b>Lokasi Kejadian</b><br>Laporan #{{ $laporan->id }}')
                .openPopup();
        }
    });
</script>

</body>
</html>
