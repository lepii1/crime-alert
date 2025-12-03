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
        /* FORM INPUT STYLING - Desain yang lebih menonjol */
        .form-input-style {
            /* Border lebih tebal, rounded lebih besar, focus ring menonjol */
            @apply w-full border border-gray-300 p-2.5 rounded-lg shadow-sm
            transition duration-200
            focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75;
        }
        .main-content-wrapper {
            max-width: 4xl;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .card-content {
            background-color: #ffffff;
            border-radius: 12px; /* Border radius lebih besar */
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); /* Shadow lebih kuat */
            padding: 30px;
        }
        /* Error text styling */
        .error-text {
            color: #e74c3c; /* Warna error merah aksen */
            font-size: 0.875rem; /* text-sm */
            margin-top: 0.25rem;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

{{-- HEADER/NAVIGASI ATAS --}}
<header class="header shadow-lg">
    <div class="main-content-wrapper py-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3 header-logo text-2xl"></i>
            <h1 class="text-xl font-semibold">CRIME ALERT - BUAT LAPORAN</h1>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('user.dashboard') }}" class="px-3 py-2 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition text-sm whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i> Dashboard
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
                               class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">
                        @error('judul_laporan') <p class="error-text">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Deskripsi Kejadian</label>
                        <textarea name="deskripsi"
                                  class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75"
                                  rows="4">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="error-text">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Kategori Kejahatan</label>
                            <select name="kategori"
                                    class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Pencurian" {{ old('kategori') == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                                <option value="Tawuran" {{ old('kategori') == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>
                                <option value="Kekerasan" {{ old('kategori') == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                                <option value="Penipuan" {{ old('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                                <option value="Pelecehan" {{ old('kategori') == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                                <option value="Lain-lain" {{ old('kategori') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            @error('kategori') <p class="error-text">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Tanggal Kejadian</label>
                            <input type="date" name="tgl_lapor" value="{{ old('tgl_lapor') }}"
                                   class="w-full border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75">
                            @error('tgl_lapor') <p class="error-text">{{ $message }}</p> @enderror
                        </div>
                    </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">IP Terlapor</label>
                            <input type="text" id="ip_terlapor" name="ip_terlapor" readonly
                                   class="text-center border border-gray-300 p-2.5 rounded-lg shadow-sm transition duration-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-200 focus:ring-opacity-75 bg-gray-100 cursor-not-allowed">
                        </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                        <div class="flex items-center">
                            <input type="checkbox" id="confirm" name="confirm" required
                                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <label for="confirm" class="ml-2 text-gray-700 text-sm">
                                Saya konfirmasi semua informasi di atas sudah benar dan valid.
                            </label>
                            @error('confirm') <p class="error-text">Anda harus mengkonfirmasi kebenaran laporan.</p> @enderror
                        </div>

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
