<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Laporan ke Polisi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <h3 class="text-lg font-medium mb-4">Laporan: {{ $laporan->judul_laporan }}</h3>
                <form action="{{ route('admin.laporan.assign.store', $laporan->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="polisi_id" class="block text-sm font-medium text-gray-700">Pilih Polisi</label>
                        <select name="polisi_id" id="polisi_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Polisi --</option>
                            @foreach ($polisis as $polisi)
                                <option value="{{ $polisi->id }}" {{ $laporan->polisi_id == $polisi->id ? 'selected' : '' }}>
                                    {{ $polisi->nama }} ({{ $polisi->jabatan ?? 'Tidak diketahui' }})
                                </option>
                            @endforeach
                        </select>
                        @error('polisi_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan Penugasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
