# 🚨 Crime Alert: Platform Pelaporan & Analisis Kejahatan Komunitas
Crime Alert adalah solusi web modern yang dibangun menggunakan Laravel 12, dirancang untuk menghubungkan masyarakat dan 
penegak hukum. Platform ini memungkinkan pengguna (warga) untuk melaporkan insiden kejahatan secara real-time dan rahasia, 
sementara administrator (kepolisian) mendapatkan alat analitik dan manajemen penugasan yang canggih.

<p align="center">
<img src="" width="400" alt="Crime Alert">
</p>

## Fitur Utama
Proyek ini terbagi menjadi dua pengalaman pengguna (User dan Admin) dengan fitur inti sebagai berikut:

### 👤 Untuk Pengguna (User)
- **Akses Publik (Welcome Page):** Landing page yang informatif, menarik, dan kondisional (menampilkan link Dashboard jika sudah login, atau Register jika belum).
- **Pelaporan Cepat:** Formulir laporan yang sederhana, fokus, dan dioptimalkan secara visual dengan input styling Tailwind yang rapi.
- **Pelacakan Status:** Dashboard pribadi yang menampilkan ringkasan laporan (Total, Pending, Proses, Selesai) dan riwayat laporan pribadi.
- **Detail Laporan:** Pengguna dapat melihat detail laporan mereka, termasuk status penanganan dan informasi petugas yang ditugaskan (jika ada).

### 🛡️ Untuk Administrator (Admin / Kepolisian)
- **Dashboard Operasional:** Tampilan ringkasan yang menampilkan Line Chart tren kejahatan 12 bulan terakhir secara dinamis dan daftar Laporan PENTING (Pending) yang siap ditugaskan.
- **Manajemen Laporan:** Halaman index laporan dengan filter server-side yang komprehensif berdasarkan Kategori, Status, Bulan, dan Tahun Kejadian (tgl_lapor).
- **Sistem Penugasan Dinamis:** Admin dapat menugaskan laporan yang masuk kepada petugas (Model Polisi), yang secara otomatis mengubah status laporan menjadi Proses.
- **Halaman Analisis Visual(Reports):** Halaman khusus yang menampilkan tiga jenis Chart menggunakan Chart.js: Tren Bulanan, Distribusi Kategori, dan Rasio Status Penanganan.
- **Responsivitas Penuh:** Semua view Admin (Dashboard, Laporan Index, Profile) dioptimalkan untuk desktop dan mobile (dengan sidebar toggle dan modal kustom).

## Teknologi dan Filosofi Desain
- **Backend:** PHP (Laravel 12.x) & Eloquent ORM.
- **Frontend:** Tailwind CSS & Alpine.js (Digunakan untuk sidebar toggle dan modal custom).
- **Visualisasi:** Chart.js (Untuk data analisis yang interaktif).
- **Desain Tema UI:** Palet warna konsisten (#2c3e50 dan aksen merah #e74c3c), memastikan tampilan yang profesional dan mobile-first.

## Instalasi dan Kontribusi
Untuk menjalankan proyek ini, Anda memerlukan PHP, Composer, Node.js, dan NPM.
1. **Install Dependensi**:
   ```bash
   composer install
   npm install
   ```
2. **Konfigurasi Database dan Key**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Edit kredensial database pada file `.env` lalu jalankan:
   ```bash
   php artisan migrate --seed
   ```
3. **Kompilasi frontend (Wajib)**:
   ```bash
   npm run dev
   ```
   Biarkan terminal ini berjalan saat Anda mengembangkan, atau gunakan 'npm run build' untuk produksi.
4. **Akses aplikasi**:
   Buka: `http://127.0.0.1:8000/`

## Contributing
Terima kasih atas minat Anda pada proyek Crime Alert! Kami menerima kontribusi untuk perbaikan bug, peningkatan fitur, 
atau saran desain. Silakan lihat panduan kontribusi Laravel jika Anda ingin berkontribusi pada kerangka kerja utamanya.

## Security Vulnerabilities
Jika Anda menemukan kerentanan keamanan dalam aplikasi ini, harap segera beritahu tim developer.

## License
The Crime Alert platform is built on the Laravel framework, yang merupakan perangkat lunak open-source yang dilisensikan 
di bawah **MIT License**.
