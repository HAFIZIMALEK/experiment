<article class="product-card">
    <a class="product-image" href="<?php echo e(route('products.show', $product)); ?>">
        <img src="<?php echo e($product->image_url ?: 'https://placehold.co/700x900/f1eee8/222?text=ATELIER'); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
        <?php if($product->is_featured): ?><span class="image-tag">FEATURED</span><?php endif; ?>
    </a>
    <div class="product-meta">
        <div><a class="product-name" href="<?php echo e(route('products.show', $product)); ?>"><?php echo e($product->name); ?></a>
            <?php if($product->category): ?><p class="muted"><?php echo e($product->category->name); ?></p><?php endif; ?></div>
        <strong>RM <?php echo e(number_format($product->price, 2)); ?></strong>
    </div>
</article>
<?php /**PATH C:\laragon\www\experiment\resources\views/partials/product-card.blade.php ENDPATH**/ ?>