<?php $__env->startSection('title', 'Sign in — Atelier'); ?>
<?php $__env->startSection('content'); ?>
<section class="auth-wrap"><p class="eyebrow">WELCOME BACK</p><h1>Sign in</h1><p class="muted">Good to have you here.</p>
<form method="POST" action="<?php echo e(route('login.store')); ?>" class="auth-form"><?php echo csrf_field(); ?>
<label>Email address<input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus></label>
<label>Password<input type="password" name="password" required></label>
<label class="check-label"><input type="checkbox" name="remember"> Remember me</label>
<button class="button button-dark button-full">Sign in</button>
</form><p class="auth-switch">New to Atelier? <a href="<?php echo e(route('register')); ?>">Create an account</a></p></section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.store', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\experiment\resources\views/auth/login.blade.php ENDPATH**/ ?>