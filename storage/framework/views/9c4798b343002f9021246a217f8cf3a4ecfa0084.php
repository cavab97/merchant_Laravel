<?php $__env->startSection('page-title'); ?> <?php echo e(__('Login')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="login-form">
        <ul class="login-menu">
            <li class="blue-login"><a href="#"><?php echo e(__('User Login')); ?></a></li>
            <li class="gray-login"><a href="<?php echo e(route('client.login', $lang)); ?>"><?php echo e(__('Client Login')); ?></a></li>
        </ul>
        <div class="page-title"><h5><?php echo e(__('Login')); ?></h5></div>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="text-danger"><?php echo e($error); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email" class="form-control-label"><?php echo e(__('Email')); ?></label>
                <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" name="email" id="emailaddress" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="<?php echo e(__('Enter Your Email')); ?>">
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label"><?php echo e(__('Password')); ?></label>
                <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" name="password" required autocomplete="current-password" id="password" placeholder="<?php echo e(__('Enter Your Password')); ?>">
            </div>
            <div class="custom-control custom-checkbox remember-me-text">
                <input type="checkbox" class="custom-control-input" id="remember-me" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <label class="custom-control-label" for="remember-me"><?php echo e(__('Remember Me')); ?></label>
            </div>

            <button type="submit" class="btn-login"><?php echo e(__('Login')); ?></button>
            <a href="<?php echo e(route('password.request', $lang)); ?>" class="text-muted"><small><?php echo e(__('Forgot your password?')); ?></small></a>
            <div class="or-text"><?php echo e(__('OR')); ?></div>
            <a href="<?php echo e(route('register', $lang)); ?>" class="btn-login login-gray-btn"><?php echo e(__('Sign Up')); ?></a>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/auth/login.blade.php ENDPATH**/ ?>