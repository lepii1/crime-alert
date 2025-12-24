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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 260px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s ease-in-out; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }

        .sidebar-nav a { display: flex; align-items: center; padding: 14px 24px; color: #ecf0f1; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; font-size: 0.9rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; color: #fff; font-weight: 600; }

        .main-content { padding: 30px; margin-left: 0; transition: 0.3s; }
        @media (min-width: 1024px) { .main-content { margin-left: 260px; } }

        .card-detail { background: #fff; border-radius: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 30px; border: 1px solid #edf2f7; }

        .status-badge { padding: 5px 12px; border-radius: 12px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-proses { background-color: #dbeafe; color: #1e40af; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }

        .label-text { @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1; }
        .value-text { @apply text-sm font-bold text-gray-800; }

        .img-preview { @apply w-full rounded-2xl border border-gray-100 shadow-sm transition-all hover:shadow-md cursor-zoom-in object-contain bg-gray-50; max-height: 350px; }
        #map { height: 300px; border-radius: 20px; border: 1px solid #edf2f7; }

        .select-custom { @apply bg-gray-50 border border-gray-100 text-gray-700 text-xs rounded-xl focus:ring-indigo-500 focus:border-indigo-500 block w-full p-3 outline-none font-bold uppercase tracking-tighter; }
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
                <a href="{{ route('admin.laporan.index') }}" class="active"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
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
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('admin.laporan.index') }}" class="text-gray-400 hover:text-indigo-600 transition"><i class="fas fa-arrow-left"></i></a>
                    <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">Audit Laporan Kejahatan</span>
                </div>
                <h1 class="text-3xl font-black text-gray-800 tracking-tight">Detail Laporan #{{ $laporan->id }}</h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status Investigasi:</span>
                <span class="status-badge status-{{ strtolower($laporan->status) }}">
                    {{ $laporan->status }}
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-xl mb-8 flex items-center shadow-sm">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: INFORMASI UTAMA & VISUAL --}}
            <div class="xl:col-span-2 space-y-8">
                {{-- Data Kejadian --}}
                <div class="card-detail">
                    <div class="flex items-center gap-3 mb-8 border-b pb-4">
                        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight">Informasi Insiden</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <span class="label-text">Judul Laporan</span>
                            <p class="text-xl font-black text-gray-900 leading-tight">{{ $laporan->judul_laporan }}</p>
                        </div>
                        <div>
                            <span class="label-text">Kategori Kejahatan</span>
                            <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg uppercase tracking-wider">{{ $laporan->kategori }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="label-text">Kronologi / Deskripsi Lengkap</span>
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 text-sm text-gray-600 leading-relaxed italic">
                                "{{ $laporan->deskripsi }}"
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <span class="label-text">Keterangan Lokasi</span>
                            <div class="flex items-start gap-3 text-sm text-gray-700 font-medium">
                                <i class="fas fa-map-marker-alt text-red-500 mt-1"></i>
                                <span>{{ $laporan->lokasi_kejadian ?? 'Lokasi tidak dispesifikasikan secara detail.' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bukti Visual & Map --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="card-detail">
                        <span class="label-text mb-4">Foto Bukti Kejadian</span>
                        @if($laporan->bukti_kejadian)
                            <img src="{{ asset('storage/' . $laporan->bukti_kejadian) }}" class="img-preview" alt="Bukti" onclick="window.open(this.src)">
                        @else
                            <div class="bg-gray-50 h-48 rounded-2xl flex flex-col items-center justify-center text-gray-300 border-2 border-dashed">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <span class="text-[10px] font-bold uppercase">Tanpa Lampiran Foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="card-detail">
                        <span class="label-text mb-4">Titik Koordinat (Peta)</span>
                        @if($laporan->latitude && $laporan->longitude)
                            <div id="map"></div>
                            <div class="mt-3 flex justify-between items-center text-[10px] font-mono text-gray-400 uppercase font-bold">
                                <span>GPS: {{ $laporan->latitude }}, {{ $laporan->longitude }}</span>
                                <a href="https://www.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank" class="text-indigo-500 hover:underline">Buka di Maps <i class="fas fa-external-link-alt ml-1"></i></a>
                            </div>
                        @else
                            <div class="bg-gray-50 h-48 rounded-2xl flex flex-col items-center justify-center text-gray-300 border-2 border-dashed">
                                <i class="fas fa-map-marked-alt text-4xl mb-2"></i>
                                <span class="text-[10px] font-bold uppercase">Koordinat Tidak Tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: PELAPOR & MANAJEMEN PETUGAS --}}
            <div class="space-y-8">
                {{-- Identitas Pelapor --}}
                <div class="card-detail">
                    <div class="flex items-center gap-3 mb-6 border-b pb-4">
                        <div class="w-8 h-8 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h2 class="text-xs font-black text-gray-800 uppercase tracking-widest">Identitas Pelapor</h2>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-black text-xl shadow-lg">
                            {{ substr($laporan->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-800">{{ $laporan->user->name }}</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ $laporan->user->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="label-text">IP Pelapor</span>
                            <p class="font-mono text-xs text-gray-500 font-bold">{{ $laporan->ip_terlapor ?? 'Hidden / VPN' }}</p>
                        </div>
                        <div>
                            <span class="label-text mb-2">Foto KTP / Identitas Resmi</span>
                            @if($laporan->foto_identitas)
                                <img src="{{ asset('storage/' . $laporan->foto_identitas) }}" class="img-preview cursor-pointer hover:scale-[1.02] transition-transform" alt="KTP" onclick="window.open(this.src)">
                            @else
                                <div class="bg-red-50 text-red-500 p-4 rounded-xl text-[10px] font-bold uppercase tracking-widest text-center border border-red-100">
                                    <i class="fas fa-exclamation-triangle mb-1 block text-lg"></i>
                                    Identitas Belum Terunggah
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Penugasan Petugas --}}
                <div class="card-detail">
                    <div class="flex items-center gap-3 mb-6 border-b pb-4">
                        <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-sm">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h2 class="text-xs font-black text-gray-800 uppercase tracking-widest">Manajemen Petugas</h2>
                    </div>

                    @if ($laporan->polisi)
                        <div class="p-5 bg-indigo-600 rounded-2xl text-white shadow-xl shadow-indigo-100 flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center text-xl">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold uppercase text-indigo-200 tracking-widest">Ditugaskan Kepada:</p>
                                <p class="text-lg font-black leading-none">{{ $laporan->polisi->nama }}</p>
                                <p class="text-[10px] font-bold text-indigo-100 mt-1 opacity-80">{{ $laporan->polisi->jabatan ?? 'Petugas Penanganan' }}</p>
                            </div>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-100 p-6 rounded-2xl">
                            <form action="{{ route('admin.laporan.assign.store', $laporan->id) }}" method="POST">
                                @csrf
                                <label class="label-text mb-3 text-red-600">Belum Ada Petugas Ditugaskan</label>
                                <div class="space-y-4">
                                    <select name="polisi_id" required class="select-custom">
                                        <option value="" disabled selected>-- Pilih Petugas --</option>
                                        @foreach($polisis as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }} ({{ $p->jabatan }})</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg active:scale-95 transition-all">
                                        Konfirmasi Penugasan
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.laporan.edit', $laporan->id) }}" class="w-full text-center bg-yellow-500 hover:bg-yellow-600 text-black font-black py-4 rounded-2xl transition shadow-lg active:scale-95 text-[10px] uppercase tracking-widest">
                        <i class="fas fa-edit mr-2"></i> Update Status Laporan
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
                scrollWheelZoom: false
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map).bindPopup('Lokasi Kejadian').openPopup();
        }
    });
</script>

<footer class="mt-auto py-8 text-center text-gray-400 text-xs font-medium">
    &copy; {{ date('Y') }} Crime Alert Report System. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
