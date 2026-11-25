<?php $__env->startSection('title', 'Shop — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="page-heading"><p class="eyebrow">THE ATELIER EDIT</p><h1>Shop all</h1><p>Everyday pieces, thoughtfully selected.</p></section>
<div class="shop-toolbar">
    <div class="category-pills"><a class="<?php echo e(!request('category') ? 'active' : ''); ?>" href="<?php echo e(route('shop')); ?>">All</a>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a class="<?php echo e(request('category') === $category->slug ? 'active' : ''); ?>" href="<?php echo e(route('shop', ['category' => $category->slug])); ?>"><?php echo e($category->name); ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <form class="shop-search" method="GET" action="<?php echo e(route('shop')); ?>">
        <?php if(request('category')): ?><input type="hidden" name="category" value="<?php echo e(request('category')); ?>"><?php endif; ?>
        <input name="search" value="<?php echo e(request('search')); ?>" placeholder="Search pieces...">
        <select name="sort" onchange="this.form.submit()"><option value="">Latest</option><option value="price_low" <?php if(request('sort')==='price_low'): echo 'selected'; endif; ?>>Price: low to high</option><option value="price_high" <?php if(request('sort')==='price_high'): echo 'selected'; endif; ?>>Price: high to low</option></select>
        <button class="button button-dark button-small">Search</button>
    </form>
</div>
<section class="section-wrap shop-results">
    <p class="muted"><?php echo e($products->total()); ?> pieces</p>
    <div class="product-grid"><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> <?php echo $__env->make('partials.product-card', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p>No products found. Try another search.</p> <?php endif; ?></div>
    <div class="pagination"><?php echo e($products->links()); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/store/shop.blade.php ENDPATH**/ ?>