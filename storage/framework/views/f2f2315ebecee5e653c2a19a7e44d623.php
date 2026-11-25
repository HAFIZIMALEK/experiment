<?php $__env->startSection('title', 'Your Bag — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-heading compact-heading"><p class="eyebrow">YOUR SELECTION</p><h1>Your bag</h1></section>
<section class="cart-layout section-wrap">
    <div class="cart-items">
        <?php $__empty_1 = true; $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($item->product): ?>
            <article class="cart-row">
                <img src="<?php echo e($item->product->image_url ?: 'https://placehold.co/300x360'); ?>" alt="">
                <div class="cart-row-info"><a href="<?php echo e(route('products.show', $item->product)); ?>"><strong><?php echo e($item->product->name); ?></strong></a><p class="muted">RM <?php echo e(number_format($item->product->price, 2)); ?></p>
                    <div class="cart-actions"><form method="POST" action="<?php echo e(route('cart.update', $item)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" max="20"><button class="text-button">Update</button></form>
                    <form method="POST" action="<?php echo e(route('cart.remove', $item)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-button remove-link">Remove</button></form></div>
                </div>
                <strong>RM <?php echo e(number_format($item->product->price * $item->quantity, 2)); ?></strong>
            </article>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state"><h2>Your bag is waiting.</h2><p class="muted">Explore the collection and find something you love.</p><a class="button button-dark" href="<?php echo e(route('shop')); ?>">Continue shopping</a></div>
        <?php endif; ?>
    </div>
    <?php if($cart->items->isNotEmpty()): ?>
    <aside class="summary-card"><h2>Order summary</h2><div class="summary-line"><span>Subtotal</span><strong>RM <?php echo e(number_format($subtotal, 2)); ?></strong></div><div class="summary-line"><span>Shipping</span><span><?php echo e($subtotal >= 150 ? 'Complimentary' : 'RM 8.00'); ?></span></div><div class="summary-line total-line"><span>Total</span><strong>RM <?php echo e(number_format($subtotal + ($subtotal >= 150 ? 0 : 8), 2)); ?></strong></div><a class="button button-dark button-full" href="<?php echo e(route('checkout')); ?>">Continue to checkout</a><p class="tiny muted">Shipping is complimentary on orders over RM150.</p></aside>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/store/cart.blade.php ENDPATH**/ ?>