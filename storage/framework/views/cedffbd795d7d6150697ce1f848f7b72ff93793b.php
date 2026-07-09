<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Keranjang Belanja <i class="fa fa-shopping-cart"></i>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                
                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 border border-green-200 shadow-sm">
                        <span class="font-medium">Berhasil!</span> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Check Out Pesanan</h3>

                <?php if(!empty($pesanan)): ?>
                    <p class="text-right text-sm text-gray-600 dark:text-gray-400 mb-2">
                        Tanggal Pesan : <?php echo e($pesanan->tanggal); ?>

                    </p>
                    
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-gray-200">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">No</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Menu</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Kustomisasi Rasa</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Jumlah</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Harga</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Total Harga</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $__currentLoopData = $pesanan_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center"><?php echo e($no++); ?></td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-semibold">
                                        <?php echo e($pesanan_detail->barang->nama_barang); ?>

                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm">
                                        <?php if($pesanan_detail->kemanisan): ?> <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded">Manis Lv <?php echo e($pesanan_detail->kemanisan); ?></span> <br> <?php endif; ?>
                                        <?php if($pesanan_detail->kepahitan): ?> <span class="bg-stone-200 text-stone-800 px-2 py-1 rounded mt-1 inline-block">Pahit Lv <?php echo e($pesanan_detail->kepahitan); ?></span> <?php endif; ?>
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center"><?php echo e($pesanan_detail->jumlah); ?></td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp. <?php echo e(number_format($pesanan_detail->barang->harga, 0, ',', '.')); ?></td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-bold">Rp. <?php echo e(number_format($pesanan_detail->jumlah_harga, 0, ',', '.')); ?></td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                        
                                        <form action="<?php echo e(url('checkout')); ?>/<?php echo e($pesanan_detail->id); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo e(method_field('DELETE')); ?>

                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded shadow" onclick="return confirm('Anda yakin akan menghapus kopi ini dari keranjang?')">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                <tr class="bg-gray-50 dark:bg-gray-800">
                                    <td colspan="5" class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-right font-extrabold text-lg">Total Pembayaran :</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 font-extrabold text-amber-600 dark:text-amber-400 text-lg">
                                        Rp. <?php echo e(number_format($pesanan->jumlah_harga, 0, ',', '.')); ?>

                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3">
                                        <a href="<?php echo e(url('konfirmasi-checkout')); ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full block text-center shadow" onclick="return confirm('Apakah pesanan sudah benar? Proses Check Out sekarang?')">
                                            Check Out
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <p class="text-lg text-gray-500 dark:text-gray-400">Keranjang belanja anda masih kosong.</p>
                        <a href="<?php echo e(url('home')); ?>" class="inline-block mt-4 text-amber-600 hover:text-amber-800 font-semibold underline">Mulai Pesan Kopi</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\miraicoffee\resources\views/pesan/checkout.blade.php ENDPATH**/ ?>