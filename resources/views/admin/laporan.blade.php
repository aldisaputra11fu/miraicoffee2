<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Laporan Penjualan - Mirai Coffee
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-[#E31E24]">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider mb-2">Total Pendapatan</h3>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        Rp {{ number_format($total_pendapatan, 0, ',', '.') }}
                    </p>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border-l-4 border-yellow-400">
                    <h3 class="text-gray-500 dark:text-gray-400 text-sm font-bold uppercase tracking-wider mb-2">Total Transaksi Selesai</h3>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">
                        {{ $total_transaksi }} <span class="text-lg text-gray-500 font-normal">Pesanan</span>
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-700 pb-2">
                    Rincian Transaksi Masuk
                </h3>

                @if($pesanans->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-gray-500 dark:text-gray-400">Belum ada data transaksi penjualan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-900 dark:text-gray-300">
                            
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                <tr>
                                    <th class="py-3 px-4 rounded-tl-lg">Tanggal</th>
                                    <th class="py-3 px-4">Nama Pelanggan</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4">Total Masuk</th>
                                    <th class="py-3 px-4 rounded-tr-lg">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($pesanans as $pesanan)
                                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="py-4 px-4">{{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d/m/Y H:i') }}</td>
                                    
                                    <td class="py-4 px-4 font-semibold">{{ $pesanan->user->name }}</td>
                                    
                                    <td class="py-4 px-4">
                                        @if($pesanan->status == 1)
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Diproses</span>
                                        @elseif($pesanan->status == 2)
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Selesai</span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-4 px-4 font-bold text-[#E31E24]">
                                        Rp {{ number_format($pesanan->jumlah_harga + $pesanan->kode, 0, ',', '.') }}
                                    </td>

                                    <td class="py-4 px-4">
                                        @if($pesanan->status == 1)
                                            <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-3 rounded text-sm transition shadow-sm" onclick="return confirm('Apakah pesanan ini sudah selesai disiapkan?')">
                                                    ✔ Tandai Selesai
                                                </button>
                                            </form>
                                        @elseif($pesanan->status == 2)
                                            <span class="text-gray-400 dark:text-gray-500 italic text-sm">✔ Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>