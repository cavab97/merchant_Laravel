<nav class="navbar navbar-main navbar-expand-lg navbar-border n-top-header" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand + Toggler (for mobile devices) -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- User's navbar -->
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                        <?php if(auth()->guard('web')->check()): ?>
                            <?php ($notifications = Auth::user()->notifications($currentWorkspace->id)); ?>

                            <a class="nav-link nav-link-icon <?php if(count($notifications)): ?>beep <?php endif; ?>" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0">Notifications</h5>
                                </div>
                                <div class="list-group list-group-flush">
                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $notification->toHtml(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="py-3 text-center">
                                    <a href="#" class="link link-sm link--style-3"><?php echo e(__('View all notifications')); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="avatar avatar-sm rounded-circle">
                        <img <?php if(Auth::user()->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?>" <?php else: ?> avatar="<?php echo e(Auth::user()->name); ?>" <?php endif; ?> alt="<?php echo e(Auth::user()->name); ?>">
                      </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0 text-center"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></h6>
                        <?php $__currentLoopData = Auth::user()->workspace; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($workspace->is_active): ?>
                                <a href="<?php if(isset($currentWorkspace) && $currentWorkspace->id == $workspace->id): ?>#<?php else: ?> <?php if(auth()->guard('web')->check()): ?><?php echo e(route('change-workspace',$workspace->id)); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.change-workspace',$workspace->id)); ?><?php endif; ?> <?php endif; ?>" title="<?php echo e($workspace->name); ?>" class="dropdown-item">
                                    <?php if($currentWorkspace->id == $workspace->id): ?>
                                        <i class="fa fa-check"></i>
                                    <?php endif; ?>
                                    <span><?php echo e($workspace->name); ?></span>
                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission =='Owner'): ?>
                                            <span class="badge badge-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                                <a href="#" class="dropdown-item " title="<?php echo e(__('Locked')); ?>">
                                    <i class="fa fa-lock"></i>
                                    <span><?php echo e($workspace->name); ?></span>
                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission =='Owner'): ?>
                                            <span class="badge badge-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <?php if(auth()->guard('web')->check()): ?>
                            <?php if(Auth::user()->type == 'user'): ?>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modelCreateWorkspace">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo e(__('Create New Workspace')); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                            <?php if(auth()->guard('web')->check()): ?>
                                <?php if(Auth::user()->id == $currentWorkspace->created_by ): ?>
                                    <a href="#" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('remove-workspace-form').submit();">
                                        <i class="fa fa-trash"></i>
                                        <span><?php echo e(__('Remove Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form" action="<?php echo e(route('delete-workspace', ['id' => $currentWorkspace->id])); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php else: ?>
                                    <a href="#" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('remove-workspace-form').submit();">
                                        <i class="fa fa-trash"></i>
                                        <span><?php echo e(__('Leave Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form" action="<?php echo e(route('leave-workspace', ['id' => $currentWorkspace->id])); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(Auth::user()->type == 'user'): ?>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <a href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('users.my.account')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.users.my.account')); ?><?php endif; ?>" class="dropdown-item">
                            <i class="fa fa-user-circle"></i> <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="logout-form" action="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('logout')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.logout')); ?><?php endif; ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                                <img <?php if(Auth::user()->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?>" <?php else: ?> avatar="<?php echo e(Auth::user()->name); ?>" <?php endif; ?> alt="<?php echo e(Auth::user()->name); ?>">
                            </span>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold"><?php echo e(Auth::user()->name); ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0 text-center"><?php echo e(__('Hi')); ?>, <?php echo e(Auth::user()->name); ?></h6>
                        <?php $__currentLoopData = Auth::user()->workspace; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($workspace->is_active): ?>
                                <a href="<?php if($currentWorkspace->id == $workspace->id): ?>#<?php else: ?> <?php if(auth()->guard('web')->check()): ?><?php echo e(route('change-workspace',$workspace->id)); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.change-workspace',$workspace->id)); ?><?php endif; ?> <?php endif; ?>" title="<?php echo e($workspace->name); ?>" class="dropdown-item">
                                    <?php if($currentWorkspace->id == $workspace->id): ?>
                                        <i class="fa fa-check"></i>
                                    <?php endif; ?>
                                    <span><?php echo e($workspace->name); ?></span>
                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission =='Owner'): ?>
                                            <span class="badge badge-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php else: ?>
                                <a href="#" class="dropdown-item " title="<?php echo e(__('Locked')); ?>">
                                    <i class="fa fa-lock"></i>
                                    <span><?php echo e($workspace->name); ?></span>
                                    <?php if(isset($workspace->pivot->permission)): ?>
                                        <?php if($workspace->pivot->permission =='Owner'): ?>
                                            <span class="badge badge-primary"><?php echo e(__($workspace->pivot->permission)); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <?php if(auth()->guard('web')->check()): ?>
                            <?php if(Auth::user()->type == 'user'): ?>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modelCreateWorkspace">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo e(__('Create New Workspace')); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                            <?php if(auth()->guard('web')->check()): ?>
                                <?php if(Auth::user()->id == $currentWorkspace->created_by ): ?>
                                    <a href="#" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('remove-workspace-form').submit();">
                                        <i class="fa fa-trash"></i>
                                        <span><?php echo e(__('Remove Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form" action="<?php echo e(route('delete-workspace', ['id' => $currentWorkspace->id])); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php else: ?>
                                    <a href="#" class="dropdown-item" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('remove-workspace-form').submit();">
                                        <i class="fa fa-trash"></i>
                                        <span><?php echo e(__('Leave Me From This Workspace')); ?></span>
                                    </a>
                                    <form id="remove-workspace-form" action="<?php echo e(route('leave-workspace', ['id' => $currentWorkspace->id])); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(Auth::user()->type == 'user'): ?>
                            <div class="dropdown-divider"></div>
                        <?php endif; ?>

                        <a href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('users.my.account')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.users.my.account')); ?><?php endif; ?>" class="dropdown-item">
                            <i class="fa fa-user-circle"></i> <span><?php echo e(__('My Profile')); ?></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault();document.getElementById('logout-form1').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="logout-form1" action="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('logout')); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.logout')); ?><?php endif; ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-lg-auto align-items-lg-center">
                <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                    <?php if(auth()->guard('web')->check()): ?>
                        <?php ($messages = Auth::user()->unread($currentWorkspace->id,Auth::user()->id)); ?>

                        <li class="nav-item dropdown dropdown-animate">
                            <a class="nav-link nav-link-icon message-toggle <?php if(count($messages)): ?> beep <?php endif; ?>" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-comment-alt"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0">
                                        <?php echo e(__('Messages')); ?>

                                        <div class="float-right">
                                            <a href="#" class="mark_all_as_read_message"><?php echo e(__('Mark All As Read')); ?></a>
                                        </div>
                                    </h5>
                                </div>
                                <div class="list-group list-group-flush dropdown-list-message">
                                </div>
                                <div class="py-3 text-center">
                                    <a href="<?php echo e(route('chats')); ?>" class="link link-sm link--style-3"><?php echo e(__('View All')); ?> <i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-animate">
                            <?php ($notifications = Auth::user()->notifications($currentWorkspace->id)); ?>

                            <a class="nav-link nav-link-icon notification-toggle <?php if(count($notifications)): ?> beep <?php endif; ?>" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0 notification-dropdown">
                                <div class="py-3 px-3">
                                    <h5 class="heading h6 mb-0">
                                        <?php echo e(__('Notifications')); ?>

                                        <div class="float-right">
                                            <a href="#" class="mark_all_as_read"><?php echo e(__('Mark All As Read')); ?></a>
                                        </div>
                                    </h5>
                                </div>
                                <div class="list-group list-group-flush is-end dropdown-list-icons">
                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $notification->toHtml(); ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="py-3 text-center">
                                    <a href="#" class="link link-sm link--style-3">View all notifications</a>
                                </div>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner'): ?>
                    <?php ($currantLang = basename(App::getLocale())); ?>

                    <li class="nav-item dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-icon">
                            <span class="align-middle"><i class="fas fa-globe-europe mr-2"></i><?php echo e(Str::upper($currantLang)); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow mr-3">
                            <?php $__currentLoopData = $currentWorkspace->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('change_lang_workspace',[$currentWorkspace->id,$lang])); ?>" class="dropdown-item <?php echo e($currantLang == $lang ? 'text-danger' : ''); ?>">
                                    <span class="small"><?php echo e(Str::upper($lang)); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>











<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/partials/topnav.blade.php ENDPATH**/ ?>