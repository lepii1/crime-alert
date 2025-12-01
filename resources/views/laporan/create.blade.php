<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buat Laporan - Crime Alert</title>

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
            background-color: #2c3e50; /* Warna tema */
            color: #ecf0f1;
        }
        .header-logo {
            color: #e74c3c; /* Aksen merah */
        }
        .form-input-style {
            /* Styling konsisten dengan Admin Edit */
            @apply w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50;
        }
        .main-content-wrapper {
            max-width: 4xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        /* Style untuk Kartu Konten Utama */
        .card-content {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1); /* Shadow lebih menonjol */
            padding: 30px; /* Padding ditingkatkan */
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
            <h1 class="text-xl font-semibold">CRIME ALERT - BUAT LAPORAN</h1>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('user.dashboard') }}" class="text-sm hover:text-gray-300 transition whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
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
        {{-- KARTU UTAMA DENGAN SHADOW & ROUNDED CORNERS --}}
        <div class="card-content">
            <div class="p-0 text-gray-900">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Form Laporan Baru</h3>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('laporan.store') }}" method="POST" class="space-y-6 pt-4">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Judul Laporan</label>
                        <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}"
                               class="form-input-style">
                        @error('judul_laporan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Deskripsi Kejadian</label>
                        <textarea name="deskripsi"
                                  class="form-input-style"
                                  rows="4">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Kategori Kejahatan</label>
                        <select name="kategori"
                                class="form-input-style">
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Pencurian" {{ old('kategori') == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                            <option value="Tawuran" {{ old('kategori') == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>
                            <option value="Kekerasan" {{ old('kategori') == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                            <option value="Penipuan" {{ old('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                            <option value="Pelecehan" {{ old('kategori') == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                            <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                        </select>
                        @error('kategori') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Tanggal Kejadian</label>
                        <input type="date" name="tgl_lapor" value="{{ old('tgl_lapor') }}"
                               class="form-input-style">
                        @error('tgl_lapor') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">IP Terlapor</label>
                        <input type="text" id="ip_terlapor" name="ip_terlapor" readonly
                               class="form-input-style bg-gray-100 cursor-not-allowed">
                    </div>

                    <div class="flex items-center pt-4 border-t border-gray-100">
                        <input type="checkbox" id="confirm" name="confirm" required
                               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="confirm" class="ml-2 text-gray-700 text-sm">
                            Saya konfirmasi semua informasi di atas sudah benar dan valid.
                        </label>
                        @error('confirm') <p class="text-red-600 text-sm mt-1">Anda harus mengkonfirmasi kebenaran laporan.</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" id="submitBtn"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg disabled:opacity-50 transition"
                                disabled>
                            Kirim Laporan
                        </button>
                    </div>
                </form>

                <script>
                    // Enable tombol submit hanya jika checkbox dicentang
                    document.addEventListener('DOMContentLoaded', function() {
                        const confirmCheckbox = document.getElementById('confirm');
                        const submitBtn = document.getElementById('submitBtn');

                        confirmCheckbox.addEventListener('change', function() {
                            submitBtn.disabled = !this.checked;
                        });

                        // Ambil IP otomatis (menggunakan API ipify)
                        fetch('https://api.ipify.org?format=json')
                            .then(res => res.json())
                            .then(data => document.getElementById('ip_terlapor').value = data.ip)
                            .catch(err => {
                                document.getElementById('ip_terlapor').value = 'IP Gagal Diambil';
                                console.error('Gagal mengambil IP:', err);
                            });
                    });
                </script>
            </div>
        </div>
    </div>
</main>
</body>
</html>
