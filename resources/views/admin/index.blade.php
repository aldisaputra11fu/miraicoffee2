<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Admin - Pesanan Masuk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Transaksi Masuk</h3>
                    <a href="{{ route('admin.barang.create') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow">
                        + Tambah Menu Baru
                    </a>
                </div>
                <table class="w-full text-left text-gray-900 dark:text-gray-200">
                    <thead class="border-b dark:border-gray-700">
                        <tr>
                            <th class="py-3">Nama Pembeli</th>
                            <th class="py-3">Tanggal</th>
                            <th class="py-3">Total Harga</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $pesanan)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-4">{{ $pesanan->user->name }}</td>
                            <td class="py-4">{{ $pesanan->tanggal }}</td>
                            <td class="py-4">Rp. {{ number_format($pesanan->jumlah_harga + $pesanan->kode, 0, ',', '.') }}</td>
                            <td class="py-4">
                                <a href="#" class="text-blue-500 hover:underline">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>