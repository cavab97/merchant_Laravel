<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo $__env->yieldContent('page-title'); ?> - <?php echo e(config('app.name', 'Taskly')); ?>

    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fontawesome/fontawesome-free/css/all.min.css')); ?>"><!-- Page CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/site.css')); ?>" id="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/ac.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/stylesheet.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
</head>
<body>

<?php
    $dir = base_path() . '/resources/lang/';
    $glob =  glob($dir."*",GLOB_ONLYDIR);
    $arrLang =  array_map(function($value) use ($dir) { return str_replace($dir, '', $value); }, $glob);
    $arrLang =  array_map(function($value) use ($dir) { return preg_replace('/[0-9]+/', '', $value); }, $arrLang);
    $arrLang = array_filter($arrLang);
    $currantLang = basename(App::getLocale());
    $client_keyword = Request::route()->getName() == 'client.login' ? 'client.' : ''
?>
<div class="login-contain">
    <div class="login-inner-contain">
        <a class="navbar-brand" href="#">
            <img src="<?php echo e(asset(Storage::url('logo/logo-blue.png'))); ?>" class="navbar-brand-img" alt="logo">
        </a>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php if(session()->has('info')): ?>
                    <div class="alert alert-primary">
                        <?php echo e(session()->get('info')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session()->has('status')): ?>
                    <div class="alert alert-info">
                        <?php echo e(session()->get('status')); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
        <h5 class="copyright-text"> <?php echo e(env('FOOTER_TEXT')); ?> </h5>
        <div class="all-select">
            <a href="#" class="monthly-btn">
                <span class="monthly-text"><?php echo e(__('Language')); ?></span>
                <select name="language" id="language" class="populate select-box" tabindex="-1" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <?php $__currentLoopData = $arrLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(route($client_keyword.'login', $lang)); ?>" <?php if($currantLang == $lang): ?> selected <?php endif; ?>><?php echo e(Str::upper($lang)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </a>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/layouts/auth.blade.php ENDPATH**/ ?>