<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a href="<?php echo e(route('home')); ?>" class="navbar-brand">
            <img src="<?php echo e(asset(Storage::url('logo/logo-blue.png'))); ?>" class="sidebar-logo" alt="<?php echo e(env('APP_NAME')); ?>" height="35">
        </a>
        <div class="ml-auto">
            <!-- Sidenav toggler -->
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a class="nav-link <?php echo e((Request::route()->getName() == 'home' || Request::route()->getName() == NULL) ? ' active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <i class="fas fa-home"></i> <?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <?php if(isset($currentWorkspace) && $currentWorkspace): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'projects.index' || Request::segment(2) == 'projects') ? ' active' : ''); ?>" href="<?php if(auth()->guard('web')->check()): ?><?php echo e(route('projects.index',$currentWorkspace->slug)); ?><?php elseif(auth()->guard()->check()): ?><?php echo e(route('client.projects.index',$currentWorkspace->slug)); ?><?php endif; ?>">
                            <i class="fas fa-briefcase"></i>
                            <span> <?php echo e(__('Projects')); ?> </span>
                        </a>
                    </li>
                    <?php if(auth()->guard('web')->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'tasks.index') ? ' active' : ''); ?>" href="<?php echo e(route('tasks.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-list"></i>
                                <span> <?php echo e(__('Tasks')); ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'timesheet.index') ? ' active' : ''); ?>" href="<?php echo e(route('timesheet.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-clock"></i>
                                <span> <?php echo e(__('Timesheet')); ?> </span>
                            </a>
                        </li>
                        <?php if($currentWorkspace->creater->id == Auth::user()->id): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::route()->getName() == 'invoices.index' || Request::segment(2) == 'invoices') ? ' active' : ''); ?>" href="<?php echo e(route('invoices.index',$currentWorkspace->slug)); ?>">
                                    <i class="fas fa-print"></i>
                                    <span> <?php echo e(__('Invoices')); ?> </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::route()->getName() == 'clients.index') ? ' active' : ''); ?>" href="<?php echo e(route('clients.index',$currentWorkspace->slug)); ?>">
                                    <i class="fas fa-network-wired"></i>
                                    <span> <?php echo e(__('Clients')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>" href="<?php echo e(route('users.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-user"></i>
                                <span> <?php echo e(__('Users')); ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'calender.index') ? ' active' : ''); ?>" href="<?php echo e(route('calender.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-calendar"></i>
                                <span> <?php echo e(__('Calender')); ?> </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'notes.index') ? ' active' : ''); ?>" href="<?php echo e(route('notes.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-clipboard"></i>
                                <span> <?php echo e(__('Notes')); ?> </span>
                            </a>
                        </li>
                        <?php if(env('CHAT_MODULE') == 'yes'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::route()->getName() == 'chats') ? ' active' : ''); ?>" href="<?php echo e(route('chats')); ?>">
                                    <i class="fas fa-comment"></i>
                                    <span> <?php echo e(__('Chat')); ?> </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php elseif(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'client.timesheet.index') ? ' active' : ''); ?>" href="<?php echo e(route('client.timesheet.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-clock"></i>
                                <span> <?php echo e(__('Timesheet')); ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'client.invoices.index') ? ' active' : ''); ?>" href="<?php echo e(route('client.invoices.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-print"></i>
                                <span> <?php echo e(__('Invoices')); ?> </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'client.calender.index') ? ' active' : ''); ?>" href="<?php echo e(route('client.calender.index',$currentWorkspace->slug)); ?>">
                                <i class="fas fa-calendar"></i>
                                <span> <?php echo e(__('Calender')); ?> </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(Auth::user()->type == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'users.index') ? ' active' : ''); ?>" href="<?php echo e(route('users.index','')); ?>">
                            <i class="fas fa-users"></i>
                            <span> <?php echo e(__('Users')); ?> </span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if((Auth::user()->type == 'admin' || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id)) && Auth::user()->getGuard() != 'client'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'plans.index') ? ' active' : ''); ?>" href="<?php echo e(route('plans.index')); ?>">
                            <i class="fas fa-trophy"></i>
                            <span> <?php echo e(__('Plans')); ?> </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'order.index') ? ' active' : ''); ?>" href="<?php echo e(route('order.index')); ?>">
                            <i class="fas fa-credit-card"></i>
                            <span> <?php echo e(__('Orders')); ?> </span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->type == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'coupons.index') ? ' active' : ''); ?>" href="<?php echo e(route('coupons.index')); ?>">
                            <i class="fas fa-tag"></i>
                            <span> <?php echo e(__('Coupons')); ?> </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'lang_workspace') ? ' active' : ''); ?>" href="<?php echo e(route('lang_workspace')); ?>">
                            <i class="fas fa-globe"></i>
                            <span> <?php echo e(__('Languages')); ?> </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'settings.index') ? ' active' : ''); ?>" href="<?php echo e(route('settings.index')); ?>">
                            <i class="fas fa-cog"></i>
                            <span> <?php echo e(__('Settings')); ?> </span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id && Auth::user()->getGuard() != 'client'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'workspace.settings') ? ' active' : ''); ?>" href="<?php echo e(route('workspace.settings',$currentWorkspace->slug)); ?>">
                            <i class="fas fa-cogs"></i>
                            <span> <?php echo e(__('Workspace Settings')); ?> </span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/chillibuddyLaravel/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>