<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manajemen Kustomisasi Topping
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 border-t-4 border-[#E31E24]">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b border-gray-700 pb-2">Tambah Topping Baru</h3>
                    
                    <form action="{{ route('admin.topping.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Topping</label>
                            <input type="text" name="nama_topping" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5" placeholder="Cth: Keju Mozarella" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tambahan Harga (Rp)</label>
                            <input type="number" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5" placeholder="Cth: 5000" required>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Untuk Menu Apa?</label>
                            <select name="kategori_makanan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5" required>
                                <option value="Croffle">Hanya Croffle</option>
                                <option value="Pancake">Hanya Pancake / Waffle</option>
                                <option value="Toast">Hanya Toast / Roti</option>
                                <option value="Pudding">Hanya Pudding</option>
                                <option value="Tiramisu">Hanya Tiramisu</option>
                                <option value="Umum">Makanan Umum Lainnya</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-[#E31E24] hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-md">
                            + Simpan Topping
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b border-gray-700 pb-2">Daftar Kustomisasi Harga</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-900 dark:text-gray-300">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="py-3 px-4">Nama Topping</th>
                                    <th class="py-3 px-4">Kategori Menu</th>
                                    <th class="py-3 px-4">Harga Tambahan</th>
                                    <th class="py-3 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($toppings as $topping)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="py-3 px-4 font-semibold">{{ $topping->nama_topping }}</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-gray-200 text-gray-800 text-xs font-bold px-2.5 py-0.5 rounded">{{ $topping->kategori_makanan }}</span>
                                    </td>
                                    <td class="py-3 px-4 text-[#E31E24] font-bold">+ Rp {{ number_format($topping->harga, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">
                                        <form action="{{ route('admin.topping.destroy', $topping->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-sm" onclick="return confirm('Hapus topping ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-gray-500">Belum ada data topping. Silakan tambahkan di form kiri.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>