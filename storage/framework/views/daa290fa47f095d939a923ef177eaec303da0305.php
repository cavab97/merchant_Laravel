<?php $__env->startSection('page-title'); ?> <?php echo e(__('Clients')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(auth()->guard('web')->check()): ?>
        <?php if(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id()): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Client')); ?>" data-url="<?php echo e(route('clients.create',$currentWorkspace->slug)); ?>">
                <i class="fa fa-plus"></i> <?php echo e(__('Add Client')); ?>

            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">

        <?php if($currentWorkspace): ?>

            <div class="row">
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="card profile-card">
                            <div class="edit-profile user-text">
                                <?php if($client->is_active): ?>
                                    <a href="#" class="edit-icon" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Client')); ?>" data-url="<?php echo e(route('clients.edit',[$currentWorkspace->slug,$client->id])); ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($client->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['clients.destroy',[$currentWorkspace->slug,$client->id]],'id'=>'delete-form-'.$client->id]); ?>

                                    <?php echo Form::close(); ?>

                                <?php else: ?>
                                    <a href="#" class="lock-icon" title="<?php echo e(__('Locked')); ?>">
                                        <i class="fas fa-lock"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <img avatar="<?php echo e($client->name); ?>" alt="" class="rounded-circle img-thumbnail">
                            <h4 class="h4 mb-0 mt-2"><?php echo e($client->name); ?></h4>
                            <h6 class="office-time mb-0 mt-4"><?php echo e($client->email); ?></h6>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="page-error">
                            <div class="page-inner">
                                <h1>404</h1>
                                <div class="page-description">
                                    <?php echo e(__('Page Not Found')); ?>

                                </div>
                                <div class="page-search">
                                    <p class="text-muted mt-3"><?php echo e(__("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")); ?></p>
                                    <div class="mt-3">
                                        <a class="btn-return-home badge-blue" href="<?php echo e(route('home')); ?>"><i class="fas fa-reply"></i> <?php echo e(__('Return Home')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <!-- container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/clients/index.blade.php ENDPATH**/ ?>