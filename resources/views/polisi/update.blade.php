<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4">{{ $laporan->judul_laporan }}</h2>

    <p class="mb-2"><strong>Pelapor:</strong> {{ $laporan->user->name ?? '-' }}</p>
    <p class="mb-2"><strong>Kategori:</strong> {{ $laporan->kategori }}</p>
    <p class="mb-2"><strong>Tanggal Lapor:</strong> {{ $laporan->tgl_lapor }}</p>

    <p class="mb-2"><strong>Status Saat Ini:</strong>
        <span class="px-3 py-1 rounded bg-gray-200">{{ ucfirst($laporan->status) }}</span>
    </p>

    <p class="mt-4 text-gray-700">{{ $laporan->deskripsi }}</p>

    <hr class="my-4">

    <!-- FORM UBAH STATUS -->
    <form action="{{ route('polisi.laporan.status', $laporan->id) }}" method="POST">
        @csrf

        <label for="status" class="font-semibold">Update Status:</label>
        <select name="status" class="border p-2 rounded w-full mt-2">
            <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
            <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Simpan Perubahan
        </button>
        <a href="{{ route('polisi.dashboard') }}"
           class="mt-4 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
            Kembali ke Dashboard
        </a>
    </form>


</div>

</body>
</html>
