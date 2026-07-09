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
            Manajemen Stok Menu
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-700 pb-2">
                    Daftar Ketersediaan Menu (Restock)
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-900 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="py-3 px-4 rounded-tl-lg">Nama Menu</th>
                                <th class="py-3 px-4">Kategori</th>
                                <th class="py-3 px-4">Sisa Stok Saat Ini</th>
                                <th class="py-3 px-4 rounded-tr-lg">Aksi Tambah Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="py-4 px-4 font-semibold text-[#E31E24]"><?php echo e($barang->nama_barang); ?></td>
                                <td class="py-4 px-4 uppercase text-xs font-bold text-gray-500"><?php echo e($barang->kategori); ?></td>
                                
                                <td class="py-4 px-4">
                                    <?php if($barang->stok < 10): ?>
                                        <span class="bg-red-100 text-red-800 text-sm font-bold px-3 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                            <?php echo e($barang->stok); ?> Tersisa!
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-green-100 text-green-800 text-sm font-bold px-3 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                            <?php echo e($barang->stok); ?> Aman
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-4 px-4">
                                    <form action="<?php echo e(route('admin.stok.tambah', $barang->id)); ?>" method="POST" class="flex gap-2">
                                        <?php echo csrf_field(); ?>
                                        <input type="number" name="tambahan_stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-24 p-2" placeholder="+ Jumlah" required min="1">
                                        
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition shadow-sm">
                                            Tambah
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\miraicoffee\resources\views/admin/stok.blade.php ENDPATH**/ ?>