<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">

<div class="bg-white/80 backdrop-blur-md p-10 rounded-2xl shadow-xl w-full max-w-md border border-white/50">

    <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">
        👮 Register Polisi
    </h2>

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('polisi.register.submit') }}"
          enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Avatar Upload --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Avatar (Opsional)</label>
            <div class="relative">
                <input type="file" name="avatar" accept="image/*"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm bg-white focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <span class="absolute left-3 top-3 text-gray-400">📷</span>
            </div>
        </div>

        {{-- Nama --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nama</label>
            <div class="relative">
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                       required>
                <span class="absolute left-3 top-3 text-gray-400">👤</span>
            </div>
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <div class="relative">
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                       required>
                <span class="absolute left-3 top-3 text-gray-400">📧</span>
            </div>
        </div>

        {{-- No HP --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nomor HP</label>
            <div class="relative">
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <span class="absolute left-3 top-3 text-gray-400">📞</span>
            </div>
        </div>

        {{-- Jabatan --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Jabatan</label>
            <div class="relative">
                <input type="text" name="jabatan" value="{{ old('jabatan') }}"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500">
                <span class="absolute left-3 top-3 text-gray-400">🎖️</span>
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                       required>
                <span class="absolute left-3 top-3 text-gray-400">🔒</span>
            </div>
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="block mb-1 font-semibold text-gray-700">Konfirmasi Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation"
                       class="w-full pl-10 pr-4 py-3 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                       required>
                <span class="absolute left-3 top-3 text-gray-400">✔️</span>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold text-lg shadow-md hover:bg-blue-700 transition">
            Daftar
        </button>

        <p class="text-center text-sm text-gray-600 mt-3">
            Sudah punya akun?
            <a href="{{ route('polisi.login') }}" class="text-blue-600 font-semibold hover:underline">
                Login di sini
            </a>
        </p>

    </form>

</div>

</body>
</html>
