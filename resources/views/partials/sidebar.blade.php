<div class="sidenav custom-sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{asset(Storage::url('logo/logo-blue.png'))}}" class="sidebar-logo" alt="{{ env('APP_NAME') }}" height="35">
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
                    <a class="nav-link {{ (Request::route()->getName() == 'home' || Request::route()->getName() == NULL) ? ' active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @if(isset($currentWorkspace) && $currentWorkspace)
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'projects.index' || Request::segment(2) == 'projects') ? ' active' : '' }}" href="@auth('web'){{ route('projects.index',$currentWorkspace->slug) }}@elseauth{{ route('client.projects.index',$currentWorkspace->slug) }}@endauth">
                            <i class="fas fa-briefcase"></i>
                            <span> {{ __('Projects') }} </span>
                        </a>
                    </li>
                    @auth('web')
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'tasks.index') ? ' active' : '' }}" href="{{ route('tasks.index',$currentWorkspace->slug) }}">
                                <i class="fas fa-list"></i>
                                <span> {{ __('Tasks') }} </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'timesheet.index') ? ' active' : '' }}" href="{{route('timesheet.index',$currentWorkspace->slug)}}">
                                <i class="fas fa-clock"></i>
                                <span> {{ __('Timesheet') }} </span>
                            </a>
                        </li>
                        @if($currentWorkspace->creater->id == Auth::user()->id)
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'invoices.index' || Request::segment(2) == 'invoices') ? ' active' : '' }}" href="{{ route('invoices.index',$currentWorkspace->slug) }}">
                                    <i class="fas fa-print"></i>
                                    <span> {{ __('Invoices') }} </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'clients.index') ? ' active' : '' }}" href="{{ route('clients.index',$currentWorkspace->slug) }}">
                                    <i class="fas fa-network-wired"></i>
                                    <span> {{ __('Clients') }} </span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'users.index') ? ' active' : '' }}" href="{{ route('users.index',$currentWorkspace->slug) }}">
                                <i class="fas fa-user"></i>
                                <span> {{ __('Users') }} </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'calender.index') ? ' active' : '' }}" href="{{route('calender.index',$currentWorkspace->slug)}}">
                                <i class="fas fa-calendar"></i>
                                <span> {{ __('Calender') }} </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'notes.index') ? ' active' : '' }}" href="{{route('notes.index',$currentWorkspace->slug)}}">
                                <i class="fas fa-clipboard"></i>
                                <span> {{ __('Notes') }} </span>
                            </a>
                        </li>
                        @if(env('CHAT_MODULE') == 'yes')
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::route()->getName() == 'chats') ? ' active' : '' }}" href="{{ route('chats') }}">
                                    <i class="fas fa-comment"></i>
                                    <span> {{ __('Chat') }} </span>
                                </a>
                            </li>
                        @endif
                    @elseauth
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'client.timesheet.index') ? ' active' : '' }}" href="{{route('client.timesheet.index',$currentWorkspace->slug)}}">
                                <i class="fas fa-clock"></i>
                                <span> {{ __('Timesheet') }} </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'client.invoices.index') ? ' active' : '' }}" href="{{ route('client.invoices.index',$currentWorkspace->slug) }}">
                                <i class="fas fa-print"></i>
                                <span> {{ __('Invoices') }} </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'client.calender.index') ? ' active' : '' }}" href="{{route('client.calender.index',$currentWorkspace->slug)}}">
                                <i class="fas fa-calendar"></i>
                                <span> {{ __('Calender') }} </span>
                            </a>
                        </li>
                    @endauth
                @endif
                @if(Auth::user()->type == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'users.index') ? ' active' : '' }}" href="{{ route('users.index','') }}">
                            <i class="fas fa-users"></i>
                            <span> {{ __('Users') }} </span>
                        </a>
                    </li>
                @endif
                @if((Auth::user()->type == 'admin' || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id)) && Auth::user()->getGuard() != 'client')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'plans.index') ? ' active' : '' }}" href="{{ route('plans.index') }}">
                            <i class="fas fa-trophy"></i>
                            <span> {{ __('Plans') }} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'order.index') ? ' active' : '' }}" href="{{ route('order.index') }}">
                            <i class="fas fa-credit-card"></i>
                            <span> {{ __('Orders') }} </span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->type == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'coupons.index') ? ' active' : '' }}" href="{{ route('coupons.index') }}">
                            <i class="fas fa-tag"></i>
                            <span> {{ __('Coupons') }} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'lang_workspace') ? ' active' : '' }}" href="{{ route('lang_workspace') }}">
                            <i class="fas fa-globe"></i>
                            <span> {{ __('Languages') }} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'settings.index') ? ' active' : '' }}" href="{{ route('settings.index') }}">
                            <i class="fas fa-cog"></i>
                            <span> {{ __('Settings') }} </span>
                        </a>
                    </li>
                @endif

                @if(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->creater->id == Auth::user()->id && Auth::user()->getGuard() != 'client')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'workspace.settings') ? ' active' : '' }}" href="{{ route('workspace.settings',$currentWorkspace->slug) }}">
                            <i class="fas fa-cogs"></i>
                            <span> {{ __('Workspace Settings') }} </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
