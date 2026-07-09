<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Menu Kopi Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Menu Kopi / Snack')" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    <div>
                        <x-input-label for="harga" :value="__('Harga (Rupiah)')" />
                        <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                    </div>

                    <div>
                        <x-input-label for="stok" :value="__('Jumlah Stok')" />
                        <x-text-input id="stok" name="stok" type="number" class="mt-1 block w-full" :value="old('stok')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                    </div>

                    <div>
                        <x-input-label for="keterangan" :value="__('Deskripsi Singkat')" />
                        <textarea id="keterangan" name="keterangan" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full rows=3" required>{{ old('keterangan') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('keterangan')" />
                    </div>

                    <div>
                        <x-input-label for="gambar" :value="__('Foto Produk (Format: JPG/PNG)')" />
                        <input id="gambar" name="gambar" type="file" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Simpan Menu') }}</x-primary-button>
                        <a href="{{ route('admin') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                    </div>
                    <div>
                        <x-input-label for="nama_barang" :value="__('Nama Menu Kopi / Snack')" />
                        <x-text-input id="nama_barang" name="nama_barang" type="text" class="mt-1 block w-full" :value="old('nama_barang')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="kategori" :value="__('Kategori Menu')" />
                        <select id="kategori" name="kategori" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="kopi" {{ old('kategori') == 'kopi' ? 'selected' : '' }}>☕ Kopi & Minuman</option>
                            <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>🍔 Snack & Makanan</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>