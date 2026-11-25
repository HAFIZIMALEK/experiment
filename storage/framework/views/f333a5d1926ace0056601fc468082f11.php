<?php $__env->startSection('title', 'Create account — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="auth-wrap"><p class="eyebrow">JOIN THE ATELIER COMMUNITY</p><h1>Create account</h1><p class="muted">A few details and you're in.</p>
<form method="POST" action="<?php echo e(route('register.store')); ?>" class="auth-form"><?php echo csrf_field(); ?>
<label>Full name<input name="name" value="<?php echo e(old('name')); ?>" required></label>
<label>Email address<input type="email" name="email" value="<?php echo e(old('email')); ?>" required></label>
<label>Password<input type="password" name="password" required></label>
<label>Confirm password<input type="password" name="password_confirmation" required></label>
<button class="button button-dark button-full">Create account</button>
</form><p class="auth-switch">Already registered? <a href="<?php echo e(route('login')); ?>">Sign in</a></p></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/auth/register.blade.php ENDPATH**/ ?>