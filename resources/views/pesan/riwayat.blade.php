<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Riwayat Pesanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left text-gray-900 dark:text-gray-200">
                    <thead>
                        <tr class="border-b dark:border-gray-700">
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Total Harga</th>
                            <th class="py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $pesanan)
                        <tr class="border-b dark:border-gray-700">
                            <td class="py-3">{{ $pesanan->tanggal }}</td>
                            <td class="py-3">Rp. {{ number_format($pesanan->jumlah_harga, 0, ',', '.') }}</td>
                            <td class="py-3">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    Sudah Dipesan
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">Belum ada riwayat pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>