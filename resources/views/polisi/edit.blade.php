<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Polisi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

    <!-- JUDUL -->
    <h1 class="text-2xl font-extrabold text-center mb-6 text-gray-800">
        ✏️ Edit Profil Polisi
    </h1>

    <!-- FOTO PROFIL -->
    <div class="flex justify-center mb-6">
        @if($polisi->avatar)
            <img src="{{ asset('storage/'.$polisi->avatar) }}"
                 class="w-28 h-28 rounded-full object-cover border shadow">
        @else
            <div class="w-28 h-28 rounded-full bg-gray-200 border flex items-center justify-center text-4xl">
                {{ strtoupper(substr($polisi->nama, 0, 1)) }}
            </div>
        @endif
    </div>

    <!-- FORM -->
    <form action="{{ route('polisi.update', $polisi->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- NAMA -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $polisi->nama }}"
                   class="w-full mt-1 p-3 border rounded-xl focus:ring focus:ring-blue-200">
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">Email</label>
            <input type="email" name="email" value="{{ $polisi->email }}"
                   class="w-full mt-1 p-3 border rounded-xl focus:ring focus:ring-blue-200">
        </div>

        <!-- NOMOR TELEPON -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">No. Telepon</label>
            <input type="text" name="telepon" value="{{ $polisi->no_hp }}"
                   class="w-full mt-1 p-3 border rounded-xl focus:ring focus:ring-blue-200">
        </div>

        <!-- JABATAN -->
        <div class="mb-4">
            <label class="text-sm font-semibold text-gray-600">Jabatan</label>
            <input type="text" name="jabatan" value="{{ $polisi->jabatan }}"
                   class="w-full mt-1 p-3 border rounded-xl focus:ring focus:ring-blue-200">
        </div>

        <!-- FOTO -->
        <div class="mb-6">
            <label class="text-sm font-semibold text-gray-600">Foto Profil (Opsional)</label>
            <input type="file" name="foto"
                   class="w-full mt-1 p-3 border rounded-xl bg-gray-50">
        </div>

        <!-- BUTTON -->
        <button
            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow transition">
            Simpan Perubahan
        </button>
    </form>

    <!-- KEMBALI -->
    <div class="mt-4">
        <a href="{{ route('polisi.profil') }}"
           class="w-full block text-center py-3 bg-gray-200 hover:bg-gray-300 rounded-xl font-semibold transition">
            Kembali
        </a>
    </div>

</div>

</body>
</html>
