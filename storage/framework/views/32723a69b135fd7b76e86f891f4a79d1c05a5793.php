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
            <?php echo e($barang->nama_barang); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row gap-8">
                
                <div class="md:w-1/2">
                    <img src="<?php echo e(file_exists(public_path('uploads/' . $barang->gambar)) && !empty($barang->gambar) 
                                ? url('uploads/' . $barang->gambar) 
                                : url('uploads/default.png')); ?>" 
                         alt="<?php echo e($barang->nama_barang); ?>" 
                         class="w-full rounded-lg shadow-md object-cover">
                </div>

                <div class="md:w-1/2 flex flex-col justify-center">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2"><?php echo e($barang->nama_barang); ?></h3>
                    <p class="text-2xl font-extrabold text-[#E31E24] mb-4">Rp <?php echo e(number_format($barang->harga, 0, ',', '.')); ?></p>
                    
                    <div class="mb-4">
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Stok Tersedia: <?php echo e($barang->stok); ?></span>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 mb-6 border-b border-gray-200 pb-6">
                        <?php echo e($barang->keterangan); ?>

                    </p>

                    <form method="POST" action="<?php echo e(url('pesan')); ?>/<?php echo e($barang->id); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-4">
                            <label for="jumlah_pesan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Pesan</label>
                            <input type="number" id="jumlah_pesan" name="jumlah_pesan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required min="1" max="<?php echo e($barang->stok); ?>" placeholder="Masukkan jumlah pesanan...">
                        </div>

                        <?php if($barang->kategori == 'kopi'): ?>
                            <div class="mb-4">
                                <label for="suhu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyajian (Hot / Ice)</label>
                                <select id="suhu" name="suhu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="Ice">🧊 Ice (Dingin)</option>
                                    <option value="Hot">☕ Hot (Panas)</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="kemanisan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tingkat Kemanisan</label>
                                    <select id="kemanisan" name="kemanisan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="Level 1 (Sedikit)">Level 1 (Sedikit)</option>
                                        <option value="Level 2 (Normal)">Level 2 (Normal)</option>
                                        <option value="Level 3 (Extra)">Level 3 (Extra Manis)</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="kepahitan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tingkat Kepahitan</label>
                                    <select id="kepahitan" name="kepahitan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E31E24] focus:border-[#E31E24] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="Level 1 (Ringan)">Level 1 (Ringan)</option>
                                        <option value="Level 2 (Medium)">Level 2 (Medium)</option>
                                        <option value="Level 3 (Strong)">Level 3 (Strong)</option>
                                    </select>
                                </div>
                            </div>

                        <?php elseif($barang->kategori == 'makanan'): ?>
                            
                            <?php
                                // 1. Deteksi otomatis ini makanan jenis apa
                                $kategori_saat_ini = 'Umum';
                                if(stripos($barang->nama_barang, 'Croffle') !== false) $kategori_saat_ini = 'Croffle';
                                elseif(stripos($barang->nama_barang, 'Pancake') !== false || stripos($barang->nama_barang, 'Waffle') !== false) $kategori_saat_ini = 'Pancake';
                                elseif(stripos($barang->nama_barang, 'Toast') !== false || stripos($barang->nama_barang, 'Roti') !== false) $kategori_saat_ini = 'Toast';
                                elseif(stripos($barang->nama_barang, 'Pudding') !== false || stripos($barang->nama_barang, 'Panna Cotta') !== false) $kategori_saat_ini = 'Pudding';
                                elseif(stripos($barang->nama_barang, 'Tiramisu') !== false) $kategori_saat_ini = 'Tiramisu';

                                // 2. Tarik hanya topping yang sesuai dengan kategori makanan ini dari Database
                                // Pastikan $toppings sudah dikirim dari PesanController
                                $topping_dinamis = $toppings->where('kategori_makanan', $kategori_saat_ini);
                            ?>

                            <div class="mb-4 space-y-4">
                                <?php if($kategori_saat_ini == 'Croffle'): ?>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white border-b border-gray-500 pb-1">Kustomisasi Base</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Base Normal" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]" checked> Normal</label>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Base Extra Crispy" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]"> Extra Crispy</label>
                                        </div>
                                    </div>
                                <?php elseif($kategori_saat_ini == 'Pancake'): ?>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white border-b border-gray-500 pb-1">Tingkat Kemanisan</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Adonan Normal" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]" checked> Normal</label>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Adonan Less Sugar" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]"> Less Sugar</label>
                                        </div>
                                    </div>
                                <?php elseif($kategori_saat_ini == 'Toast'): ?>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white border-b border-gray-500 pb-1">Isian Utama</label>
                                        <div class="flex flex-col gap-2">
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Isian Cokelat Nutella" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]" checked> Cokelat Nutella</label>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Isian Selai Srikaya" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]"> Selai Srikaya</label>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Isian Cream Cheese" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]"> Cream Cheese</label>
                                        </div>
                                    </div>
                                <?php elseif($kategori_saat_ini == 'Pudding'): ?>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white border-b border-gray-500 pb-1">Rasa Dasar</label>
                                        <div class="flex gap-4">
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Rasa Vanilla" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]" checked> Vanilla</label>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer"><input type="radio" name="topping[]" value="Rasa Cokelat" class="mr-2 text-[#E31E24] focus:ring-[#E31E24]"> Cokelat</label>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($topping_dinamis->isNotEmpty()): ?>
                                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white border-b border-gray-500 pb-1">Tambahan Topping Khusus <?php echo e($kategori_saat_ini); ?></label>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            
                                            <?php $__currentLoopData = $topping_dinamis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $top_db): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
                                                <input type="checkbox" name="topping[]" value="<?php echo e($top_db->nama_topping); ?>" class="mr-2 rounded text-[#E31E24] focus:ring-[#E31E24]"> 
                                                <?php echo e($top_db->nama_topping); ?> (+ Rp <?php echo e(number_format($top_db->harga, 0, ',', '.')); ?>)
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?> 
                        <button type="submit" class="w-full text-white bg-[#E31E24] hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-3 text-center flex items-center justify-center gap-2 mt-4 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            Masukkan Keranjang
                        </button>
                    </form>
                    <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Ulasan Pelanggan</h3>

                        <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-lg mb-8 border border-gray-200 dark:border-gray-600">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Bagaimana rasa menu ini? Berikan ulasan Anda!</h4>
                            <form action="<?php echo e(route('ulasan.store', $barang->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beri Rating</label>
                                    <select name="bintang" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                                        <option value="5">⭐⭐⭐⭐⭐ (5/5) - Sangat Enak!</option>
                                        <option value="4">⭐⭐⭐⭐ (4/5) - Enak</option>
                                        <option value="3">⭐⭐⭐ (3/5) - Lumayan</option>
                                        <option value="2">⭐⭐ (2/5) - Kurang Cocok</option>
                                        <option value="1">⭐ (1/5) - Tidak Enak</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Komentar</label>
                                    <textarea name="komentar" rows="3" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" placeholder="Tulis pendapat Anda tentang menu ini..." required></textarea>
                                </div>
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-6 rounded-lg text-sm transition shadow-sm">
                                    Kirim Ulasan
                                </button>
                            </form>
                        </div>

                        <div class="space-y-6">
                            <?php $__empty_1 = true; $__currentLoopData = $ulasans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600 uppercase">
                                            <?php echo e(substr($ulasan->user->name, 0, 1)); ?>

                                        </div>
                                        <div>
                                            <p class="font-bold text-sm text-gray-900 dark:text-white"><?php echo e($ulasan->user->name); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($ulasan->created_at)->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm mb-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <?php if($i <= $ulasan->bintang): ?>
                                                ★
                                            <?php else: ?>
                                                <span class="text-gray-300">★</span>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 italic">
                                        "<?php echo e($ulasan->komentar); ?>"
                                    </p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-gray-500 text-sm italic text-center py-4">Belum ada ulasan untuk menu ini. Jadilah yang pertama memberikan ulasan!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\miraicoffee\resources\views/pesan/index.blade.php ENDPATH**/ ?>