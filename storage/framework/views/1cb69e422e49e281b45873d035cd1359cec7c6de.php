<?php $__env->startSection('page-title'); ?> <?php echo e(__('Plans')); ?> <?php $__env->stopSection(); ?>

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
            <div class="col-md-12">
                <div class="pricing-plan">
                    <ul class="nav nav-tabs">
                        <li>
                            <a data-toggle="tab" href="#monthly-biling" class="active"><?php echo e(__('Monthly Biling')); ?></a>
                        </li>
                        <li class="annual-billing">
                            <a data-toggle="tab" href="#annual-billing"><?php echo e(__('Annual Billing')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div id="monthly-biling" class="tab-pane in active">
                            <div class="row">
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                                        <div class="plan-3">
                                            <h6><?php echo e($plan->name); ?></h6>
                                            <p class="price">
                                                <sup><?php echo e((env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')); ?></sup>
                                                <?php echo e($plan->monthly_price); ?>

                                                <sub><?php echo e(__('Per month')); ?></sub>
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

                                            <div class="row">
                                                <?php if(Auth::user()->type != 'admin'): ?>
                                                    <?php if(\Auth::user()->plan == $plan->id && Auth::user()->is_trial_done == 1): ?>
                                                        <p class="server-plan mb-3">
                                                            <?php echo e(__('Trial Expires on ')); ?> <b><?php echo e((date('d M Y',strtotime(\Auth::user()->plan_expire_date)))); ?></b>
                                                        </p>
                                                        <?php if(((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
                                                            <div class="text-center">
                                                                <a href="<?php echo e(route('payment',['monthly', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" id="interested_plan_<?php echo e($plan->id); ?>" class="button btn btn-xs rounded-pill">
                                                                    <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Subscribe')); ?>

                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif(\Auth::user()->plan == $plan->id && date('Y-m-d') < \Auth::user()->plan_expire_date): ?>
                                                        <p class="server-plan">
                                                            <?php echo e(__('Plan Expires on ')); ?> <b><?php echo e((date('d M Y',strtotime(\Auth::user()->plan_expire_date)))); ?></b>
                                                        </p>
                                                    <?php elseif(((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
                                                        <?php if(Auth::user()->is_trial_done == 0): ?>
                                                            <div class="col">
                                                                <a href="<?php echo e(route('take.a.plan.trial',$plan->id)); ?>" class="button btn btn-xs rounded-pill">
                                                                    <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Active Free Trial')); ?>

                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="col-auto">
                                                            <a href="<?php echo e(route('payment',['monthly', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" id="interested_plan_<?php echo e($plan->id); ?>" class="button btn btn-xs rounded-pill">
                                                                <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Subscribe')); ?>

                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div id="annual-billing" class="tab-pane">
                            <div class="row">
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                                        <div class="plan-3">
                                            <h6><?php echo e($plan->name); ?></h6>
                                            <p class="price">
                                                <sup><?php echo e((env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')); ?></sup>
                                                <?php echo e($plan->annual_price); ?>

                                                <sub><?php echo e(__('Per Year')); ?></sub>
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
                                            <div class="row">
                                                <?php if(Auth::user()->type != 'admin'): ?>
                                                    <?php if(\Auth::user()->plan == $plan->id && Auth::user()->is_trial_done == 1): ?>
                                                        <p class="server-plan mb-3">
                                                            <?php echo e(__('Trial Expires on ')); ?> <b><?php echo e((date('d M Y',strtotime(\Auth::user()->plan_expire_date)))); ?></b>
                                                        </p>
                                                        <?php if(((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
                                                            <div class="text-center">
                                                                <a href="<?php echo e(route('payment',['annual', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" id="interested_plan_<?php echo e($plan->id); ?>" class="button btn btn-xs rounded-pill">
                                                                    <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Subscribe')); ?>

                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif(\Auth::user()->plan == $plan->id && date('Y-m-d') < \Auth::user()->plan_expire_date): ?>
                                                        <p class="server-plan">
                                                            <?php echo e(__('Plan Expires on ')); ?> <b><?php echo e((date('d M Y',strtotime(\Auth::user()->plan_expire_date)))); ?></b>
                                                        </p>
                                                    <?php elseif(((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))) || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))): ?>
                                                        <?php if(Auth::user()->is_trial_done == 0): ?>
                                                            <div class="col">
                                                                <a href="<?php echo e(route('take.a.plan.trial',$plan->id)); ?>" class="button btn btn-xs rounded-pill">
                                                                    <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Active Free Trial')); ?>

                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="col-auto">
                                                            <a href="<?php echo e(route('payment',['annual', \Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" id="interested_plan_<?php echo e($plan->id); ?>" class="button btn btn-xs rounded-pill">
                                                                <i class="fas fa-cart-plus mr-2"></i><?php echo e(__('Subscribe')); ?>

                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            var tohref = '';
            <?php if(Auth::user()->is_register_trial == 1): ?>
                tohref = $('#trial_<?php echo e(Auth::user()->interested_plan_id); ?>').attr("href");
            <?php elseif(Auth::user()->interested_plan_id != 0): ?>
                tohref = $('#interested_plan_<?php echo e(Auth::user()->interested_plan_id); ?>').attr("href");
            <?php endif; ?>

            if (tohref != '') {
                window.location = tohref;
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/plans/company.blade.php ENDPATH**/ ?>