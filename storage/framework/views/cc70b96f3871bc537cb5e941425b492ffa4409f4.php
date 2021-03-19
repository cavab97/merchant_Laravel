<?php $__env->startSection('page-title'); ?> <?php echo e(__('Users')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(auth()->guard('web')->check()): ?>
        <?php if(Auth::user()->type == 'admin'): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Add User')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                <i class="fa fa-plus"></i> <?php echo e(__('Add User')); ?>

            </a>
        <?php elseif(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id()): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Invite New User')); ?>" data-url="<?php echo e(route('users.invite',$currentWorkspace->slug)); ?>">
                <i class="fa fa-plus"></i> <?php echo e(__('Invite User')); ?>

            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start Content-->
    <section class="section">
        <?php if($currentWorkspace || Auth::user()->type == 'admin'): ?>
            <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($workspace_id = (isset($currentWorkspace) && $currentWorkspace) ? $currentWorkspace->id : ''); ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <?php if(Auth::user()->type == 'admin' && isset($user->getPlan)): ?>
                                            <div class="badge badge-pill badge-info"><?php echo e($user->getPlan->name); ?></div>
                                        <?php else: ?>
                                            <?php if($user->permission == 'Owner'): ?>
                                                <div class="badge badge-pill badge-success"><?php echo e(__('Owner')); ?></div>
                                            <?php else: ?>
                                                <div class="badge badge-pill badge-warning"><?php echo e(__('Member')); ?></div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </h6>
                                </div>
                            </div>
                            <?php if((Auth::user()->type == 'admin' && isset($user->getPlan)) || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner' && Auth::user()->id != $user->id)): ?>
                                <div class="dropdown action-item edit-profile user-text">
                                    <a href="#" class="action-item p-2" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <?php if(Auth::user()->type == 'admin' && isset($user->getPlan)): ?>
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Change Plan')); ?>" data-url="<?php echo e(route('users.change.plan',$user->id)); ?>"><?php echo e(__('Change Plan')); ?></a>
                                            <a href="#" class="dropdown-item text-danger" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete_user_<?php echo e($user->id); ?>').submit();"><?php echo e(__('Delete')); ?></a>
                                            <form action="<?php echo e(route('users.delete',$user->id)); ?>" method="post" id="delete_user_<?php echo e($user->id); ?>" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        <?php elseif(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner' && Auth::user()->id != $user->id): ?>
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="<?php echo e(__('Edit User')); ?>" data-url="<?php echo e(route('users.edit',[$currentWorkspace->slug,$user->id])); ?>"><?php echo e(__('Edit')); ?></a>
                                            <a href="#" class="dropdown-item text-danger" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('remove_user_<?php echo e($user->id); ?>').submit();"><?php echo e(__('Remove User From Workspace')); ?></a>
                                            <form action="<?php echo e(route('users.remove',[$currentWorkspace->slug,$user->id])); ?>" method="post" id="remove_user_<?php echo e($user->id); ?>" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="card-body text-center pb-3">
                                <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                                    <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>" <?php endif; ?>>
                                </a>
                                <h5 class="h6 mt-4 mb-0">
                                    <a href="#" class="text-title"><?php echo e($user->name); ?></a>
                                </h5>
                                <span><?php echo e($user->email); ?></span>
                                <hr class="my-3">
                                <div class="row align-items-center">
                                    <?php if(Auth::user()->type == 'admin'): ?>
                                        <div class="col-6">
                                            <div class="h6 mb-0"><?php echo e($user->countWorkspace()); ?></div>
                                            <span class="text-sm text-muted"><?php echo e(__('Workspaces')); ?></span>
                                        </div>
                                        <div class="col-6">
                                            <div class="h6 mb-0"><?php echo e($user->countUsers($workspace_id)); ?></div>
                                            <span class="text-sm text-muted"><?php echo e(__('Users')); ?></span>
                                        </div>
                                        <div class="col-6">
                                            <div class="h6 mb-0"><?php echo e($user->countClients($workspace_id)); ?></div>
                                            <span class="text-sm text-muted"><?php echo e(__('Clients')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-6">
                                        <div class="h6 mb-0"><?php echo e($user->countProject($workspace_id)); ?></div>
                                        <span class="text-sm text-muted"><?php echo e(__('Projects')); ?></span>
                                    </div>
                                    <?php if(Auth::user()->type != 'admin'): ?>
                                        <div class="col-6">
                                            <div class="h6 mb-0"><?php echo e($user->countTask($workspace_id)); ?></div>
                                            <span class="text-sm text-muted"><?php echo e(__('Tasks')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="mt-2 mb-0">
                                    <?php if(Auth::user()->type == 'admin' && isset($user->getPlan)): ?>
                                        <button class="btn btn-sm btn-neutral mt-3 font-weight-500">
                                            <a><?php echo e($user->is_trial_done == 1 ? __('Plan Trial') : __('Plan')); ?> <?php echo e($user->plan_expire_date < date('Y-m-d') ? __('Expired') : __('Expires')); ?> <?php echo e(__(' on ')); ?> <?php echo e((date('d M Y',strtotime($user->plan_expire_date)))); ?></a>
                                        </button>
                                    <?php endif; ?>
                                </p>
                            </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/users/index.blade.php ENDPATH**/ ?>