{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>Buat Laporan - Crime Alert</title>--}}

{{--    <!-- Tailwind & App JS -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

{{--    <style>--}}
{{--        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');--}}

{{--        body {--}}
{{--            font-family: 'Poppins', sans-serif;--}}
{{--            background-color: #f0f2f5;--}}
{{--            margin: 0;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}
{{--        .header {--}}
{{--            background-color: #2c3e50;--}}
{{--            color: #ecf0f1;--}}
{{--        }--}}
{{--        .header-logo {--}}
{{--            color: #e74c3c;--}}
{{--        }--}}
{{--        .form-input-style {--}}
{{--            @apply w-full border border-gray-300 p-2.5 rounded-lg shadow-sm--}}
{{--            transition duration-200--}}
{{--            focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75;--}}
{{--        }--}}
{{--        .main-content-wrapper {--}}
{{--            max-width: 4xl;--}}
{{--            margin-left: auto;--}}
{{--            margin-right: auto;--}}
{{--            padding-left: 1rem;--}}
{{--            padding-right: 1rem;--}}
{{--        }--}}
{{--        .card-content {--}}
{{--            background-color: #ffffff;--}}
{{--            border-radius: 12px;--}}
{{--            box-shadow: 0 10px 30px rgba(0,0,0,0.15);--}}
{{--            padding: 30px;--}}
{{--        }--}}
{{--        .file-input-wrapper {--}}
{{--            @apply bg-gray-50 border border-gray-200 rounded-lg p-3 hover:border-indigo-400 transition;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">--}}
{{--</head>--}}
{{--<body>--}}

{{--<header class="header shadow-lg">--}}
{{--    <div class="main-content-wrapper py-4 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i>--}}
{{--            <h1 class="text-xl font-semibold uppercase">CRIME ALERT - BUAT LAPORAN</h1>--}}
{{--        </div>--}}
{{--        <div class="flex items-center space-x-4">--}}
{{--            <a href="{{ route('user.dashboard') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm">--}}
{{--                <i class="fas fa-arrow-left mr-1"></i> Dashboard--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<main class="py-12">--}}
{{--    <div class="main-content-wrapper">--}}
{{--        <div class="card-content shadow-2xl">--}}
{{--            <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Form Laporan Kejadian</h3>--}}

{{--            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="reportForm" class="space-y-6">--}}
{{--                @csrf--}}

{{--                <div>--}}
{{--                    <label class="block font-medium text-gray-700 mb-1">Judul Laporan</label>--}}
{{--                    <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}"--}}
{{--                           class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">--}}
{{--                    @error('judul_laporan') <p class="error-text">{{ $message }}</p> @enderror--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block font-medium text-gray-700 mb-1">Deskripsi Kejadian</label>--}}
{{--                    <textarea name="deskripsi"--}}
{{--                              class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75"--}}
{{--                              rows="4">{{ old('deskripsi') }}</textarea>--}}
{{--                    @error('deskripsi') <p class="error-text">{{ $message }}</p> @enderror--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block font-medium text-gray-700 mb-1">Lokasi Kejadian</label>--}}
{{--                    <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}"--}}
{{--                           class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">--}}
{{--                    @error('lokasi_kejadian') <p class="error-text">{{ $message }}</p> @enderror--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">--}}
{{--                    <div>--}}
{{--                        <label class="block font-medium text-gray-700 mb-1">Kategori Kejahatan</label>--}}
{{--                        <select name="kategori"--}}
{{--                                class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">--}}
{{--                            <option value="" disabled selected>Pilih Kategori</option>--}}
{{--                            <option value="Pencurian" {{ old('kategori') == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>--}}
{{--                            <option value="Tawuran" {{ old('kategori') == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>--}}
{{--                            <option value="Kekerasan" {{ old('kategori') == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>--}}
{{--                            <option value="Penipuan" {{ old('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>--}}
{{--                            <option value="Pelecehan" {{ old('kategori') == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>--}}
{{--                            <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>--}}
{{--                        </select>--}}
{{--                        @error('kategori') <p class="error-text">{{ $message }}</p> @enderror--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <label class="block font-medium text-gray-700 mb-1">Tanggal Kejadian</label>--}}
{{--                        <input type="date" name="tgl_lapor" value="{{ old('tgl_lapor') }}"--}}
{{--                               class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">--}}
{{--                        @error('tgl_lapor') <p class="error-text">{{ $message }}</p> @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-100">--}}
{{--                    <div>--}}
{{--                        <label class="block font-medium text-gray-700 mb-2">Foto Bukti Kejadian <span class="text-red-500">*</span></label>--}}
{{--                        <div class="file-input-wrapper">--}}
{{--                            <input type="file" name="bukti_kejadian" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" required>--}}
{{--                        </div>--}}
{{--                        <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-tight">Format: JPG, PNG (Maks 2MB)</p>--}}
{{--                        @error('bukti_kejadian') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                    </div>--}}

{{--                    --}}{{-- Foto Identitas --}}
{{--                    <div>--}}
{{--                        <label class="block font-medium text-gray-700 mb-2">Foto Identitas (KTP) <span class="text-red-500">*</span></label>--}}
{{--                        <div class="file-input-wrapper">--}}
{{--                            <input type="file" name="foto_identitas" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" required>--}}
{{--                        </div>--}}
{{--                        <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-tight">Format: JPG, PNG (Maks 2MB)</p>--}}
{{--                        @error('foto_identitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block font-medium text-gray-700 mb-1 text-xs uppercase tracking-wider">IP Alamat Anda (Otomatis)</label>--}}
{{--                    <input type="text" id="ip_terlapor" name="ip_terlapor" readonly--}}
{{--                           class="form-input-style bg-gray-50 cursor-not-allowed text-gray-500 font-mono text-sm border-none shadow-none">--}}
{{--                </div>--}}

{{--                <div class="pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">--}}
{{--                    <div class="flex items-center">--}}
{{--                        <input type="checkbox" id="confirm" name="confirm" required--}}
{{--                               class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">--}}
{{--                        <label for="confirm" class="ml-3 text-gray-700 text-sm font-medium">--}}
{{--                            Saya konfirmasi laporan ini benar dan asli.--}}
{{--                        </label>--}}
{{--                    </div>--}}

{{--                    <button type="submit" id="submitBtn"--}}
{{--                            class="bg-red-600 hover:bg-red-700 text-white font-bold px-12 py-3.5 rounded-xl shadow-xl transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"--}}
{{--                            disabled>--}}
{{--                        KIRIM LAPORAN--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</main>--}}

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        const form = document.getElementById('reportForm');--}}
{{--        const confirmCheckbox = document.getElementById('confirm');--}}
{{--        const submitBtn = document.getElementById('submitBtn');--}}
{{--        const ipInput = document.getElementById('ip_terlapor');--}}

{{--        // Logika tombo kirim (Ganti Alpine x-model)--}}
{{--        confirmCheckbox.addEventListener('change', function() {--}}
{{--            submitBtn.disabled = !this.checked;--}}
{{--        });--}}

{{--        // Ambil IP otomatis--}}
{{--        fetch('https://api.ipify.org?format=json')--}}
{{--            .then(res => res.json())--}}
{{--            .then(data => {--}}
{{--                if(ipInput) ipInput.value = data.ip;--}}
{{--            })--}}
{{--            .catch(() => {--}}
{{--                if(ipInput) ipInput.value = '127.0.0.1';--}}
{{--            });--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buat Laporan - Crime Alert</title>

    <!-- Tailwind & App JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

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
        .form-input-style {
            @apply w-full border border-gray-200 p-3 rounded-xl shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 outline-none text-sm font-medium;
        }
        .card-content {
            @apply bg-white rounded-3xl shadow-xl p-8 max-w-4xl mx-auto;
        }
        .file-input-wrapper {
            @apply bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-6 transition hover:border-indigo-400 hover:bg-indigo-50/50 cursor-pointer text-center;
        }
        .label-text {
            @apply block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2;
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

<header class="header shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto py-4 px-6 flex justify-between items-center">
        <div class="flex items-center group">
            <a href="{{ url('/') }}" class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 header-logo text-3xl group-hover:rotate-12 transition-transform"></i>
                <span class="text-white text-xl font-extrabold tracking-tight hidden sm:block uppercase">Crime Alert</span>
            </a>
        </div>

        <nav class="hidden lg:flex items-center space-x-2">
            <a href="{{ route('user.home') }}" class="nav-item">
                <i class="fas fa-rss mr-2 text-xs"></i> Feed Beranda
            </a>
            <a href="{{ route('user.dashboard') }}" class="nav-item">
                <i class="fas fa-th-large mr-2 text-xs"></i> Dashboard
            </a>
        </nav>

        <div class="flex items-center space-x-3">
            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 bg-gray-600 text-white rounded-xl font-bold text-xs hover:bg-gray-700 transition uppercase tracking-wider hidden sm:flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
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
        <a href="{{ route('user.home') }}" class="block p-3 text-white font-medium hover:bg-white/10 rounded-lg">Feed Beranda</a>
        <a href="{{ route('user.dashboard') }}" class="block p-3 text-white font-medium hover:bg-white/10 rounded-lg">Dashboard Saya</a>
    </div>
</header>

<main class="py-12 px-6">
    <div class="card-content">
        <div class="mb-10 border-b pb-6">
            <h3 class="text-3xl font-black text-gray-800 tracking-tight">Buat Laporan Baru</h3>
            <p class="text-gray-500 font-medium mt-1 text-sm">Laporkan insiden dengan detail yang jelas untuk membantu proses investigasi.</p>
        </div>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="reportForm" class="space-y-8">
            @csrf

            {{-- Informasi Dasar --}}
            <div class="space-y-6">
                <div>
                    <label class="label-text">Judul Laporan</label>
                    <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}" required
                           class="form-input-style" placeholder="Contoh: Pencurian motor di area parkir">
                    @error('judul_laporan') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label-text">Kronologi / Deskripsi Kejadian</label>
                    <textarea name="deskripsi" class="form-input-style" rows="5" required placeholder="Ceritakan detail kronologi kejadian secara lengkap...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label-text">Lokasi Kejadian</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-4 top-4 text-gray-300"></i>
                        <input type="text" name="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}" required
                               class="form-input-style pl-10" placeholder="Alamat lengkap, nama tempat, atau patokan lokasi">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="label-text">Kategori Kejahatan</label>
                        <div class="relative">
                            <select name="kategori" required class="form-input-style appearance-none bg-transparent">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Pencurian" {{ old('kategori') == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                                <option value="Tawuran" {{ old('kategori') == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>
                                <option value="Kekerasan" {{ old('kategori') == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                                <option value="Penipuan" {{ old('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                                <option value="Pelecehan" {{ old('kategori') == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                                <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-4 text-gray-300 pointer-events-none text-xs"></i>
                        </div>
                        @error('kategori') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="label-text">Tanggal Kejadian</label>
                        <input type="date" name="tgl_lapor" value="{{ old('tgl_lapor') }}" required class="form-input-style">
                        @error('tgl_lapor') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Lampiran Foto --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t">
                <div>
                    <label class="label-text flex items-center">
                        <i class="fas fa-camera mr-2 text-indigo-500"></i> Foto Bukti Kejadian <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="file-input-wrapper">
                        <i class="fas fa-cloud-upload-alt text-gray-300 text-3xl mb-3"></i>
                        <input type="file" name="bukti_kejadian" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" accept="image/*" required>
                        <p class="text-[9px] text-gray-400 mt-4 font-bold uppercase tracking-tight">Format: JPG, PNG (Maks 2MB)</p>
                    </div>
                    @error('bukti_kejadian') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label-text flex items-center">
                        <i class="fas fa-id-card mr-2 text-indigo-500"></i> Foto Identitas (KTP) <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="file-input-wrapper">
                        <i class="fas fa-user-shield text-gray-300 text-3xl mb-3"></i>
                        <input type="file" name="foto_identitas" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" accept="image/*" required>
                        <p class="text-[9px] text-gray-400 mt-4 font-bold uppercase tracking-tight">Wajib untuk validasi pelapor</p>
                    </div>
                    @error('foto_identitas') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Metadata Otomatis --}}
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 flex items-center">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-gray-400 mr-4 shadow-sm">
                    <i class="fas fa-fingerprint"></i>
                </div>
                <div>
                    <label class="label-text mb-0">Audit Sistem (IP Address)</label>
                    <input type="text" id="ip_terlapor" name="ip_terlapor" readonly class="bg-transparent border-none p-0 focus:ring-0 cursor-default text-xs font-mono text-gray-400 font-bold w-full">
                </div>
            </div>

            {{-- Konfirmasi & Submit --}}
            <div class="pt-8 border-t flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-start bg-yellow-50 p-4 rounded-2xl border border-yellow-100">
                    <input type="checkbox" id="confirm" required class="mt-1 h-5 w-5 text-indigo-600 border-gray-300 rounded-lg focus:ring-indigo-500 cursor-pointer">
                    <label for="confirm" class="ml-4 text-[11px] text-yellow-800 leading-relaxed font-semibold uppercase tracking-tight">
                        Saya menjamin bahwa laporan ini adalah benar dan asli. Memberikan laporan palsu dapat dikenakan sanksi sesuai hukum yang berlaku.
                    </label>
                </div>

                <button type="submit" id="submitBtn" disabled class="w-full md:w-auto bg-red-600 hover:bg-red-700 text-white font-black px-12 py-5 rounded-2xl shadow-xl transition-all active:scale-95 disabled:opacity-30 disabled:cursor-not-allowed uppercase tracking-widest text-xs">
                    Kirim Laporan Resmi
                </button>
            </div>
        </form>
    </div>
</main>

<footer class="py-12 text-center text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em]">
    Crime Alert Security Protocol &bull; {{ date('Y') }}
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmCheckbox = document.getElementById('confirm');
        const submitBtn = document.getElementById('submitBtn');
        const ipInput = document.getElementById('ip_terlapor');

        confirmCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });

        fetch('https://api.ipify.org?format=json')
            .then(res => res.json())
            .then(data => { if(ipInput) ipInput.value = data.ip; })
            .catch(() => { if(ipInput) ipInput.value = '127.0.0.1'; });
    });
</script>
</body>
</html>
