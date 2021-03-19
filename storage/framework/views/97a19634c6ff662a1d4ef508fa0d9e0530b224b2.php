<?php $__env->startSection('page-title'); ?> <?php echo e(__('Projects')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(auth()->guard('web')->check()): ?>
        <?php if(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id()): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Project')); ?>" data-url="<?php echo e(route('projects.create',$currentWorkspace->slug)); ?>">
                <i class="fas fa-plus mr-1"></i> <?php echo e(__('Create')); ?>

            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <?php if($projects && $currentWorkspace): ?>
            <div class="row mb-2">
                <div class="col-xl-12 col-lg-12 col-md-12 d-flex align-items-center justify-content-end">
                    <div class="text-sm-right status-filter">
                        <div class="btn-group mb-3">
                            <button type="button" class="btn btn-light active" data-filter="*" data-status="All"><?php echo e(__('All')); ?></button>
                            <button type="button" class="btn btn-light" data-filter=".Ongoing"><?php echo e(__('Ongoing')); ?></button>
                            <button type="button" class="btn btn-light" data-filter=".Finished"><?php echo e(__('Finished')); ?></button>
                            <button type="button" class="btn btn-light" data-filter=".OnHold"><?php echo e(__('OnHold')); ?></button>
                        </div>
                    </div>
                </div><!-- end col-->
            </div>

            <div class="filters-content">
                <div class="row grid">
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-lg-4 col-sm-6 All <?php echo e($project->status); ?>">
                            <div class="card hover-shadow-lg">
                                <div class="card-header border-0 pb-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">
                                            <?php if($project->status == 'Finished'): ?>
                                                <div class="badge badge-pill badge-success"><?php echo e(__('Finished')); ?></div>
                                            <?php elseif($project->status == 'Ongoing'): ?>
                                                <div class="badge badge-pill badge-secondary"><?php echo e(__('Ongoing')); ?></div>
                                            <?php else: ?>
                                                <div class="badge badge-pill badge-warning"><?php echo e(__('OnHold')); ?></div>
                                            <?php endif; ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                                        <img alt="<?php echo e($project->name); ?>" avatar="<?php echo e($project->name); ?>">
                                    </a>
                                    <h5 class="h6 my-4">
                                        <?php if($project->is_active): ?>
                                            <a href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.show',[$currentWorkspace->slug,$project->id])); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.show',[$currentWorkspace->slug,$project->id])); ?><?php endif; ?>" title="<?php echo e($project->name); ?>" class="text-title"><?php echo e($project->name); ?></a>
                                        <?php else: ?>
                                            <a href="#" title="<?php echo e(__('Locked')); ?>" class="text-title"><?php echo e($project->name); ?></a>
                                        <?php endif; ?>
                                    </h5>
                                    <div class="avatar-group hover-avatar-ungroup mb-3">
                                        <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($user->pivot->is_active): ?>
                                                <a href="#" class="avatar rounded-circle avatar-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e($user->name); ?>">
                                                    <img alt="<?php echo e($user->name); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>" <?php endif; ?>>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <p class="mb-1">
                                    <span class="pr-2 text-nowrap mb-2 d-inline-block small">
                                        <b><?php echo e($project->countTask()); ?></b> <?php echo e(__('Tasks')); ?>

                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block small">
                                        <b><?php echo e($project->countTaskComments()); ?></b> <?php echo e(__('Comments')); ?>

                                    </span>
                                    </p>
                                </div>
                                <div class="card-footer p-0 py-3">
                                    <div class="actions d-flex justify-content-between px-4">

                                        <?php if($project->is_active): ?>
                                            <?php if(auth()->guard('web')->check()): ?>
                                                <?php if($currentWorkspace->permission == 'Owner'): ?>
                                                    <a href="#" class="action-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Invite Users')); ?>" data-url="<?php echo e(route('projects.invite.popup',[$currentWorkspace->slug,$project->id])); ?>">
                                                        <i class="fas fa-user-plus"></i>
                                                    </a>
                                                    <a href="#" class="action-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Project')); ?>" data-url="<?php echo e(route('projects.edit',[$currentWorkspace->slug,$project->id])); ?>">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="#" class="action-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Share to Clients')); ?>" data-url="<?php echo e(route('projects.share.popup',[$currentWorkspace->slug,$project->id])); ?>">
                                                        <i class="fas fa-share-alt"></i>
                                                    </a>
                                                    <a href="#" class="action-item text-danger" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($project->id); ?>').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <form id="delete-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.destroy',[$currentWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                <?php else: ?>
                                                    <a href="#" class="action-item text-danger" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('leave-form-<?php echo e($project->id); ?>').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <form id="leave-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.leave',[$currentWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="#" class="action-item" title="<?php echo e(__('Locked')); ?>">
                                                <i class="fa fa-lock"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/isotope.pkgd.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {

            $('.status-filter button').click(function () {
                $('.status-filter button').removeClass('active');
                $(this).addClass('active');

                var data = $(this).attr('data-filter');
                $grid.isotope({
                    filter: data
                })
            });

            var $grid = $(".grid").isotope({
                itemSelector: ".All",
                percentPosition: true,
                masonry: {
                    columnWidth: ".All"
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/projects/index.blade.php ENDPATH**/ ?>