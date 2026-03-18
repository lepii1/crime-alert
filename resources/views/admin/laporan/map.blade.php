<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Sebaran - Crime Alert Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Leaflet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; margin: 0; }

        .sidebar { width: 260px; background-color: #2c3e50; color: #ecf0f1; height: 100vh; position: fixed; left: 0; top: 0; z-index: 50; transition: 0.3s ease-in-out; transform: translateX(-100%); }
        @media (min-width: 1024px) { .sidebar { transform: translateX(0); } }
        .sidebar-open { transform: translateX(0) !important; }

        .sidebar-nav a { display: flex; align-items: center; padding: 14px 24px; color: #ecf0f1; text-decoration: none; border-left: 4px solid transparent; transition: 0.2s; font-size: 0.9rem; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: #34495e; border-left: 4px solid #e74c3c; color: #fff; font-weight: 600; }

        .main-content { margin-left: 0; transition: 0.3s; height: 100vh; display: flex; flex-direction: column; }
        @media (min-width: 1024px) { .main-content { margin-left: 260px; } }

        #full-map { flex-grow: 1; width: 100%; z-index: 1; }

        .map-overlay-info { position: absolute; top: 20px; left: 280px; z-index: 10; pointer-events: none; }
        @media (max-width: 1024px) { .map-overlay-info { left: 20px; top: 80px; } }

        .legend { background: white; padding: 15px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); pointer-events: auto; }
        .legend-item { display: flex; align-items: center; gap: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; margin-bottom: 5px; }
        .dot { width: 12px; height: 12px; rounded-full; border-radius: 50%; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body x-data="{ open: false }">

<div @click="open = true" class="lg:hidden fixed top-4 right-4 z-[60] bg-indigo-600 p-3 rounded-full text-white shadow-xl cursor-pointer">
    <i class="fas fa-bars"></i>
</div>

<div class="flex">
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
                <a href="{{ route('admin.laporan.index') }}"><i class="fas fa-bell mr-3 w-5 text-center"></i> Laporan Masuk</a>
                <a href="#" class="active"><i class="fas fa-map-marked-alt mr-3 w-5 text-center"></i> Peta Kejahatan</a>
                <a href="{{ route('admin.laporan.reports') }}"><i class="fas fa-chart-bar mr-3 w-5 text-center"></i> Analisis Visual</a>
                <a href="{{ route('profile.edit') }}"><i class="fas fa-cog mr-3 w-5 text-center"></i> Pengaturan</a>
            </nav>
        </div>
    </div>

    <div class="main-content w-full relative">
        <div class="map-overlay-info">
            <div class="legend">
                <h4 class="text-xs font-black text-gray-800 uppercase tracking-widest mb-3 border-b pb-2">Status Penanganan</h4>
                <div class="legend-item"><div class="dot bg-yellow-400"></div> Pending (Baru)</div>
                <div class="legend-item"><div class="dot bg-blue-500"></div> Sedang Proses</div>
                <div class="legend-item"><div class="dot bg-green-500"></div> Selesai ditangani</div>
            </div>
        </div>

        <div id="full-map"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const laporans = @json($laporans);

        // Inisialisasi Peta (Default ke koordinat tengah Indonesia atau laporan pertama)
        const map = L.map('full-map').setView([-2.5489, 118.0149], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; Crime Alert System'
        }).addTo(map);

        // Marker Cluster atau Loop sederhana
        const bounds = [];

        laporans.forEach(report => {
            let color = '#f1c40f'; // Default Pending (Kuning)
            if(report.status === 'proses') color = '#3498db'; // Biru
            if(report.status === 'selesai') color = '#2ecc71'; // Hijau

            const markerHtml = `
                <div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);"></div>
            `;

            const customIcon = L.divIcon({
                className: 'custom-div-icon',
                html: markerHtml,
                iconSize: [20, 20],
                iconAnchor: [10, 20]
            });

            const marker = L.marker([report.latitude, report.longitude], { icon: customIcon }).addTo(map);

            const popupContent = `
                <div style="font-family: 'Poppins', sans-serif; padding: 5px;">
                    <p style="margin: 0; font-size: 9px; font-weight: 800; color: #94a3b8; text-transform: uppercase;">Laporan #${report.id}</p>
                    <h4 style="margin: 5px 0; font-size: 14px; font-weight: 800; color: #2c3e50;">${report.judul_laporan}</h4>
                    <p style="margin: 0 0 10px; font-size: 11px; color: #64748b;">Pelapor: <b>${report.user.name}</b></p>
                    <a href="/admin/laporan/${report.id}" style="display: block; background: #2c3e50; color: white; text-align: center; padding: 8px; border-radius: 8px; text-decoration: none; font-size: 10px; font-weight: 800; text-transform: uppercase;">Buka Detail Laporan</a>
                </div>
            `;

            marker.bindPopup(popupContent);
            bounds.push([report.latitude, report.longitude]);
        });

        // Fit map ke semua marker jika ada data
        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    });
</script>
</body>
</html>
