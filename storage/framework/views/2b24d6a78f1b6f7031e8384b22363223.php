<?php $__env->startSection('title', 'Checkout — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-heading compact-heading"><p class="eyebrow">ALMOST YOURS</p><h1>Checkout</h1></section>
<section class="checkout-layout section-wrap">
    <form class="checkout-form" method="POST" action="<?php echo e(route('checkout.place')); ?>"><?php echo csrf_field(); ?>
        <h2>Delivery details</h2>
        <label>Full name<input name="customer_name" value="<?php echo e(old('customer_name', auth()->user()->name)); ?>" required></label>
        <div class="form-two"><label>Email address<input type="email" name="email" value="<?php echo e(old('email', auth()->user()->email)); ?>" required></label><label>Phone number<input name="phone" value="<?php echo e(old('phone')); ?>" required></label></div>
        <label>Shipping address<textarea name="shipping_address" rows="4" required><?php echo e(old('shipping_address')); ?></textarea></label>
        <h2>Payment</h2>
        <label class="payment-choice"><input type="radio" name="payment_method" value="cod" checked> Cash on Delivery (COD)</label>
        <label>Order notes <textarea name="notes" rows="2" placeholder="Optional delivery instructions"><?php echo e(old('notes')); ?></textarea></label>
        <button class="button button-dark button-full">Place order</button>
    </form>
    <aside class="summary-card"><h2>Your order</h2>
        <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="summary-line"><span><?php echo e($item->product->name); ?> × <?php echo e($item->quantity); ?></span><strong>RM <?php echo e(number_format($item->product->price * $item->quantity, 2)); ?></strong></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="summary-line"><span>Subtotal</span><strong>RM <?php echo e(number_format($subtotal, 2)); ?></strong></div><div class="summary-line"><span>Shipping</span><span><?php echo e($subtotal >= 150 ? 'Free' : 'RM 8.00'); ?></span></div>
        <div class="summary-line total-line"><span>Total</span><strong>RM <?php echo e(number_format($subtotal + ($subtotal >= 150 ? 0 : 8), 2)); ?></strong></div>
    </aside>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/store/checkout.blade.php ENDPATH**/ ?>