<?php $__env->startSection('title', $product->name . ' — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb"><a href="<?php echo e(route('home')); ?>">Home</a> / <a href="<?php echo e(route('shop')); ?>">Shop</a> / <?php echo e($product->name); ?></div>
<section class="product-detail">
    <div class="detail-image"><img src="<?php echo e($product->image_url ?: 'https://placehold.co/900x1100/f1eee8/222?text=ATELIER'); ?>" alt="<?php echo e($product->name); ?>"></div>
    <div class="detail-info">
        <p class="eyebrow"><?php echo e($product->category?->name ?? 'ATELIER COLLECTION'); ?></p>
        <h1><?php echo e($product->name); ?></h1>
        <p class="detail-price">RM <?php echo e(number_format($product->price, 2)); ?></p>
        <p class="detail-description"><?php echo e($product->description); ?></p>
        <p class="stock-note"><?php echo e($product->stock > 0 ? 'In stock · '.$product->stock.' available' : 'Currently out of stock'); ?></p>
        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="add-form"><?php echo csrf_field(); ?>
                <label>Quantity <input type="number" name="quantity" value="1" min="1" max="20"></label>
                <button class="button button-dark" <?php if($product->stock < 1): echo 'disabled'; endif; ?>>Add to bag — RM <?php echo e(number_format($product->price, 2)); ?></button>
            </form>
        <?php else: ?>
            <a class="button button-dark" href="<?php echo e(route('login')); ?>">Sign in to add to bag</a>
        <?php endif; ?>
        <div class="detail-note"><strong>THE ATELIER PROMISE</strong><p>Easy everyday styling · Secure checkout · Complimentary shipping over RM150</p></div>
    </div>
</section>
<?php if($related->isNotEmpty()): ?><section class="section-wrap"><div class="section-heading"><h2>You may also like</h2></div><div class="product-grid"><?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo $__env->make('partials.product-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></section><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/store/show.blade.php ENDPATH**/ ?>