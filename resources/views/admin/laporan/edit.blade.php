<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Status Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.laporan.update', $laporan->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Judul Laporan
                            </label>
                            <input type="text" value="{{ $laporan->judul_laporan }}"
                                   name="judul_laporan" class="w-full border-gray-300 rounded-md shadow-sm" >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" class="w-full border-gray-300 rounded-md shadow-sm" rows="4" >{{ $laporan->deskripsi }}</textarea>
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                Pilih Kategori
                            </label>
                            <select id="kategori" name="kategori" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Pencurian" {{ $laporan->kategori == 'Pencurian' ? 'selected' : '' }}>Pencurian</option>
                                <option value="Tawuran" {{ $laporan->kategori == 'Tawuran' ? 'selected' : '' }}>Tawuran</option>
                                <option value="Kekerasan" {{ $laporan->kategori == 'Kekerasan' ? 'selected' : '' }}>Kekerasan</option>
                                <option value="Penipuan" {{ $laporan->kategori == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                                <option value="Pelecehan" {{ $laporan->kategori == 'Pelecehan' ? 'selected' : '' }}>Pelecehan</option>
                                <option value="Lain-lain" {{ $laporan->kategori == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status Laporan
                            </label>
                            <select id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.laporan.index') }}"
                               class="px-4 py-2 bg-gray-400 text-black rounded hover:bg-gray-500">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
