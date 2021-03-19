<?php $__env->startSection('page-title'); ?> <?php echo e(__('Plans')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(Auth::user()->type == 'admin' && ((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET')))
        || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
        <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Add Plan')); ?>" data-url="<?php echo e(route('plans.create')); ?>">
            <i class="fa fa-plus"></i> <?php echo e(__('Add Plan')); ?>

        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">

        <div class="row">
            <div class="col-md-12">
                <?php if(empty(env('STRIPE_KEY')) || empty(env('STRIPE_SECRET'))): ?>
                    <div class="alert alert-warning"><i class="fas fa-exclamation mr-1"></i> <?php echo e(__('Please set stripe api key & secret key for add new plan')); ?></div>
                <?php endif; ?>
                <?php if(empty(env('PAYPAL_CLIENT_ID')) || empty(env('PAYPAL_SECRET_KEY'))): ?>
                    <div class="alert alert-warning"><i class="fas fa-exclamation mr-1"></i> <?php echo e(__('Please set paypal client id & secret key for add new plan')); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="plan-3">
                        <h6><?php echo e($plan->name); ?>

                            <?php if(Auth::user()->type == 'admin' &&
                                ((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET')))
                                || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
                                <a href="#" class="edit-icon d-flex align-items-center float-right" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            <?php endif; ?>
                        </h6>

                        <p class="price">
                            <small><h6><?php echo e((env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->monthly_price); ?> <?php echo e(__('Monthly Price')); ?></h6></small>
                            <small><h6><?php echo e((env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e($plan->annual_price); ?> <?php echo e(__('Annual Price')); ?></h6></small>
                        </p>
                        <ul class="plan-detail">
                            <li><?php echo e(($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days); ?> <?php echo e(__('Trial Days')); ?></li>
                            <li><?php echo e(($plan->max_workspaces < 0)?__('Unlimited'):$plan->max_workspaces); ?> <?php echo e(__('Workspaces')); ?></li>
                            <li><?php echo e(($plan->max_users < 0)?__('Unlimited'):$plan->max_users); ?> <?php echo e(__('Users Per Workspace')); ?></li>
                            <li><?php echo e(($plan->max_clients < 0)?__('Unlimited'):$plan->max_clients); ?> <?php echo e(__('Clients Per Workspace')); ?></li>
                            <li><?php echo e(($plan->max_projects < 0)?__('Unlimited'):$plan->max_projects); ?> <?php echo e(__('Projects Per Workspace')); ?></li>
                        </ul>
                        <p class="price-text">
                            <?php echo e($plan->description); ?>

                        </p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/plans/admin.blade.php ENDPATH**/ ?>