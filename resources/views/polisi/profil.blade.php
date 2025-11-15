<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

    <h1 class="text-2xl font-extrabold text-center mb-6 text-gray-800">
        👮 Profile Polisi
    </h1>

    <!-- FOTO PROFIL -->
    <div class="flex justify-center mb-6">
        @if($polisi->avatar)
            <img src="{{ asset('storage/' . $polisi->avatar) }}"
                 class="w-28 h-28 rounded-full object-cover border shadow">
        @else
            <div class="w-28 h-28 rounded-full bg-gray-200 border flex items-center justify-center text-4xl">
                {{ strtoupper(substr($polisi->nama, 0, 1)) }}
            </div>
        @endif
    </div>

    <!-- INFORMASI -->
    <div class="space-y-4">

        <div>
            <p class="text-sm font-semibold text-gray-500">Nama Lengkap</p>
            <p class="text-lg font-semibold">{{ $polisi->nama }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-500">Email</p>
            <p class="text-lg font-semibold">{{ $polisi->email }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-500">No. Telepon</p>
            <p class="text-lg font-semibold">
                {{ $polisi->no_hp ?? 'Belum diisi' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-500">Jabatan</p>
            <p class="text-lg font-semibold">
                {{ $polisi->jabatan ?? 'Belum diisi' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-500">Akun Dibuat</p>
            <p class="text-lg font-semibold">
                {{ $polisi->created_at->format('d M Y') }}
            </p>
        </div>

    </div>

    <!-- BUTTON -->
    <div class="mt-8">
        <a href="{{ route('polisi.dashboard') }}"
           class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Kembali ke Dashboard
        </a>
        <a href="{{ route('polisi.edit') }}"
           class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2">
            Edit Profil
        </a>
    </div>

</div>

</body>
</html>
