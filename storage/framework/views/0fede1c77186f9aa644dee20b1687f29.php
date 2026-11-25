<?php $__env->startSection('title', 'My orders — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-heading compact-heading"><p class="eyebrow">YOUR ATELIER ACCOUNT</p><h1>My orders</h1></section>
<section class="section-wrap">
<?php if($orders->isEmpty()): ?><div class="empty-state"><h2>No orders yet.</h2><a class="button button-dark" href="<?php echo e(route('shop')); ?>">Explore the shop</a></div>
<?php else: ?>
<div class="table-wrap"><table class="data-table"><thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th></tr></thead><tbody>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr><td><strong><?php echo e($order->order_number); ?></strong><br><small><?php echo e($order->items->count()); ?> line items</small></td><td><?php echo e($order->created_at->format('d M Y')); ?></td><td>RM <?php echo e(number_format($order->total, 2)); ?></td><td><?php echo e(strtoupper($order->payment_status)); ?></td><td><span class="status"><?php echo e(ucfirst($order->status)); ?></span></td></tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody></table></div><div class="pagination"><?php echo e($orders->links()); ?></div>
<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/account/orders.blade.php ENDPATH**/ ?>