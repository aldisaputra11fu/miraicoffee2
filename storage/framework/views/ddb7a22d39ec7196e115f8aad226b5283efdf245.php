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
            <?php echo e(__('Menu Mirai Coffee & Snack')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
                        ☕ Menu Kopi & Minuman
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $kopis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                                <img src="<?php echo e(url('uploads/' . $barang->gambar)); ?>" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e($barang->nama_barang); ?></h3>
                                    <p class="text-amber-500 font-semibold mt-2">Rp. <?php echo e(number_format($barang->harga)); ?></p>
                                    <a href="<?php echo e(url('pesan', $barang->id)); ?>" class="mt-4 block text-center w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Pesan Sekarang</a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-2 border-gray-300 dark:border-gray-700">
                        🍔 Menu Snack & Makanan
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $makanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                                <img src="<?php echo e(url('uploads/' . $barang->gambar)); ?>" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white"><?php echo e($barang->nama_barang); ?></h3>
                                    <p class="text-amber-500 font-semibold mt-2">Rp. <?php echo e(number_format($barang->harga)); ?></p>
                                    <a href="<?php echo e(url('pesan', $barang->id)); ?>" class="mt-4 block text-center w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700">Pesan Sekarang</a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div> </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\miraicoffee\resources\views/dashboard.blade.php ENDPATH**/ ?>