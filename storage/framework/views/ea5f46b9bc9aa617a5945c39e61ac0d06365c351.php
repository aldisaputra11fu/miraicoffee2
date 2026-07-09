<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mirai Coffee & Snack</title>
    <link rel="icon" href="<?php echo e(asset('logo.png')); ?>" type="image/png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased bg-gray-900 text-white selection:bg-red-600 selection:text-white flex flex-col min-h-screen">

    <header class="w-full p-6 flex justify-between items-center z-10 border-b border-gray-800 bg-gray-900/80 backdrop-blur-md fixed top-0">
        <div class="flex items-center gap-3">
            <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo Mirai Coffee" class="h-12 w-auto rounded-lg shadow-md border border-gray-700">
            <h1 class="text-xl font-extrabold tracking-widest text-white hidden sm:block">
                MIRAI <span class="text-yellow-400">COFFEE</span>
            </h1>
        </div>

        <?php if(Route::has('login')): ?>
            <div class="hidden sm:flex gap-4 items-center">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/home')); ?>" class="font-semibold text-gray-300 hover:text-red-500 transition px-4 py-2">Beranda Toko</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="font-semibold text-gray-300 hover:text-red-500 transition px-4 py-2">Log in</a>

                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="font-semibold bg-[#E31E24] hover:bg-red-700 text-white px-5 py-2 rounded-lg transition shadow-lg border border-red-600">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </header>

    <main class="flex-grow flex flex-col justify-center items-center text-center px-6 mt-20 relative">
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-red-600/20 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

        <h2 class="text-5xl sm:text-7xl font-extrabold mb-6 leading-tight mt-10">
            Mulai Harimu dengan <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-yellow-400">
                Secangkir Inspirasi
            </span>
        </h2>
        
        <p class="text-lg sm:text-xl text-gray-400 max-w-2xl mb-10">
            Nikmati racikan kopi terbaik dan camilan lezat yang dibuat sepenuh hati. Tempat ternyaman untuk bersantai, ngobrol, atau mencari ide baru.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 z-10">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/home')); ?>" class="px-8 py-4 bg-[#E31E24] hover:bg-red-700 text-white font-bold rounded-full text-lg transition-transform hover:scale-105 shadow-[0_0_20px_rgba(227,30,36,0.4)]">
                    Lihat Menu Kami
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="px-8 py-4 bg-[#E31E24] hover:bg-red-700 text-white font-bold rounded-full text-lg transition-transform hover:scale-105 shadow-[0_0_20px_rgba(227,30,36,0.4)]">
                    Pesan Sekarang
                </a>
                <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-transparent hover:bg-yellow-400/10 border-2 border-yellow-400 text-yellow-400 font-bold rounded-full text-lg transition">
                    Daftar Member
                </a>
            <?php endif; ?>
        </div>

    </main>

    <footer class="w-full text-center py-6 text-sm text-gray-500 border-t border-gray-800 mt-auto z-10">
        &copy; <?php echo e(date('Y')); ?> Mirai Coffee & Snack. All rights reserved.
    </footer>

</body>
</html><?php /**PATH C:\xampp\htdocs\miraicoffee\resources\views/welcome.blade.php ENDPATH**/ ?>