<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Atelier — Modern Essentials'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/store.css')); ?>">
</head>
<body>
    <div class="announcement">Complimentary shipping on orders over RM150</div>
    <header class="site-header">
        <a class="brand" href="<?php echo e(route('home')); ?>">ATELIER<span>.</span></a>
        <nav class="main-nav">
            <a href="<?php echo e(route('home')); ?>">Home</a>
            <a href="<?php echo e(route('shop')); ?>">Shop</a>
            <?php if(auth()->guard()->check()): ?> <a href="<?php echo e(route('account.orders')); ?>">My orders</a> <?php endif; ?>
        </nav>
        <div class="header-actions">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('cart')); ?>">Bag</a>
                <?php if(auth()->user()->role === 'admin'): ?> <a href="<?php echo e(route('admin.dashboard')); ?>">Admin</a> <?php endif; ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="text-button">Logout</button></form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">Sign in</a>
                <a class="bag-link" href="<?php echo e(route('login')); ?>">Bag</a>
            <?php endif; ?>
        </div>
    </header>

    <?php if(session('success')): ?> <div class="flash success"><?php echo e(session('success')); ?></div> <?php endif; ?>
    <?php if(session('error')): ?> <div class="flash error"><?php echo e(session('error')); ?></div> <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="flash error"><strong>Please check the form:</strong><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
    <?php endif; ?>

    <main><?php echo $__env->yieldContent('content'); ?></main>

    <footer class="footer">
        <div><a class="brand brand-light" href="<?php echo e(route('home')); ?>">ATELIER<span>.</span></a><p>Considered pieces. Everyday confidence.</p></div>
        <div class="footer-links"><a href="<?php echo e(route('shop')); ?>">Shop all</a><a href="<?php echo e(route('account.orders')); ?>">Orders</a><a href="mailto:hello@example.com">Contact</a></div>
        <small>© <?php echo e(date('Y')); ?> Atelier. Demo storefront.</small>
    </footer>
</body>
</html>
<?php /**PATH C:\laragon\www\experiment\resources\views/layouts/store.blade.php ENDPATH**/ ?>