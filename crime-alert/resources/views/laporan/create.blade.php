<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Form Laporan Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Buat Laporan Baru</h3>

                    {{-- Pesan sukses --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('laporan.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block font-semibold">Judul Laporan</label>
                            <input type="text" name="judul_laporan" value="{{ old('judul_laporan') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('judul_laporan') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block font-semibold">Deskripsi</label>
                            <textarea name="deskripsi"
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                      rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block font-semibold">Tanggal Lapor</label>
                            <input type="date" name="tgl_lapor" value="{{ old('tgl_lapor') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('tgl_lapor') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block font-semibold">IP Terlapor (otomatis diisi)</label>
                            <input type="text" id="ip_terlapor" name="ip_terlapor" readonly
                                   class="w-full border-gray-300 bg-gray-100 rounded-md shadow-sm">
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="confirm" name="confirm"
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="confirm" class="ml-2 text-gray-700 text-sm">
                                Saya konfirmasi informasi sudah benar
                            </label>
                        </div>

                        <button type="submit" id="submitBtn"
                                class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded disabled:opacity-50"
                                disabled>
                            Kirim Laporan
                        </button>
                    </form>

                    <script>
                        // Enable tombol submit hanya jika checkbox dicentang
                        document.getElementById('confirm').addEventListener('change', function() {
                            document.getElementById('submitBtn').disabled = !this.checked;
                        });

                        // Ambil IP otomatis (contoh API ipify)
                        fetch('https://api.ipify.org?format=json')
                            .then(res => res.json())
                            .then(data => document.getElementById('ip_terlapor').value = data.ip)
                            .catch(err => console.log(err));
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
