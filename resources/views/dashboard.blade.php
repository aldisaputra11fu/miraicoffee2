<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menu Mirai Coffee & Snack') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
                        ☕ Menu Kopi & Minuman
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($kopis as $barang)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                                <img src="{{ url('uploads/' . $barang->gambar) }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $barang->nama_barang }}</h3>
                                    <p class="text-amber-500 font-semibold mt-2">Rp. {{ number_format($barang->harga) }}</p>
                                    <a href="{{ url('pesan', $barang->id) }}" class="mt-4 block text-center w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Pesan Sekarang</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
                        🍔 Menu Snack & Makanan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($makanans as $barang)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                                <img src="{{ url('uploads/' . $barang->gambar) }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $barang->nama_barang }}</h3>
                                    <p class="text-amber-500 font-semibold mt-2">Rp. {{ number_format($barang->harga) }}</p>
                                    <a href="{{ url('pesan', $barang->id) }}" class="mt-4 block text-center w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Pesan Sekarang</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div> </div>
    </div>
</x-app-layout>
