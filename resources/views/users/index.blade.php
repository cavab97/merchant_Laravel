@extends('layouts.admin')

@section('page-title') {{__('Users')}} @endsection

@section('action-button')
    @auth('web')
        @if(Auth::user()->type == 'admin')
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="{{ __('Add User') }}" data-url="{{route('users.create')}}">
                <i class="fa fa-plus"></i> {{ __('Add User') }}
            </a>
        @elseif(isset($currentWorkspace) && $currentWorkspace->creater->id == Auth::id())
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="{{ __('Invite New User') }}" data-url="{{route('users.invite',$currentWorkspace->slug)}}">
                <i class="fa fa-plus"></i> {{ __('Invite User') }}
            </a>
        @endif
    @endauth
@endsection

@section('content')
    <!-- Start Content-->
    <section class="section">
        @if($currentWorkspace || Auth::user()->type == 'admin')
            <div class="row">
                @foreach ($users as $user)
                    @php($workspace_id = (isset($currentWorkspace) && $currentWorkspace) ? $currentWorkspace->id : '')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        @if(Auth::user()->type == 'admin' && isset($user->getPlan))
                                            <div class="badge badge-pill badge-info">{{ $user->getPlan->name }}</div>
                                        @else
                                            @if($user->permission == 'Owner')
                                                <div class="badge badge-pill badge-success">{{ __('Owner')}}</div>
                                            @else
                                                <div class="badge badge-pill badge-warning">{{ __('Member')}}</div>
                                            @endif
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            @if((Auth::user()->type == 'admin' && isset($user->getPlan)) || (isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner' && Auth::user()->id != $user->id))
                                <div class="dropdown action-item edit-profile user-text">
                                    <a href="#" class="action-item p-2" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        @if(Auth::user()->type == 'admin' && isset($user->getPlan))
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{__('Change Plan')}}" data-url="{{route('users.change.plan',$user->id)}}">{{__('Change Plan')}}</a>
                                            <a href="#" class="dropdown-item text-danger" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete_user_{{$user->id}}').submit();">{{__('Delete')}}</a>
                                            <form action="{{route('users.delete',$user->id)}}" method="post" id="delete_user_{{$user->id}}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @elseif(isset($currentWorkspace) && $currentWorkspace && $currentWorkspace->permission == 'Owner' && Auth::user()->id != $user->id)
                                            <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="md" data-title="{{ __('Edit User') }}" data-url="{{route('users.edit',[$currentWorkspace->slug,$user->id])}}">{{ __('Edit') }}</a>
                                            <a href="#" class="dropdown-item text-danger" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('remove_user_{{$user->id}}').submit();">{{__('Remove User From Workspace')}}</a>
                                            <form action="{{route('users.remove',[$currentWorkspace->slug,$user->id])}}" method="post" id="remove_user_{{$user->id}}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="card-body text-center pb-3">
                                <a href="#" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                                    <img @if($user->avatar) src="{{asset('/storage/avatars/'.$user->avatar)}}" @else avatar="{{ $user->name }}" @endif>
                                </a>
                                <h5 class="h6 mt-4 mb-0">
                                    <a href="#" class="text-title">{{ $user->name }}</a>
                                </h5>
                                <span>{{$user->email}}</span>
                                <hr class="my-3">
                                <div class="row align-items-center">
                                    @if(Auth::user()->type == 'admin')
                                        <div class="col-6">
                                            <div class="h6 mb-0">{{ $user->countWorkspace() }}</div>
                                            <span class="text-sm text-muted">{{ __('Workspaces') }}</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="h6 mb-0">{{ $user->countUsers($workspace_id) }}</div>
                                            <span class="text-sm text-muted">{{ __('Users') }}</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="h6 mb-0">{{ $user->countClients($workspace_id) }}</div>
                                            <span class="text-sm text-muted">{{ __('Clients') }}</span>
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <div class="h6 mb-0">{{ $user->countProject($workspace_id) }}</div>
                                        <span class="text-sm text-muted">{{ __('Projects') }}</span>
                                    </div>
                                    @if(Auth::user()->type != 'admin')
                                        <div class="col-6">
                                            <div class="h6 mb-0">{{ $user->countTask($workspace_id) }}</div>
                                            <span class="text-sm text-muted">{{ __('Tasks') }}</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="mt-2 mb-0">
                                    @if(Auth::user()->type == 'admin' && isset($user->getPlan))
                                        <button class="btn btn-sm btn-neutral mt-3 font-weight-500">
                                            <a>{{ $user->is_trial_done == 1 ? __('Plan Trial') : __('Plan') }} {{ $user->plan_expire_date < date('Y-m-d') ? __('Expired') : __('Expires') }} {{__(' on ')}} {{ (date('d M Y',strtotime($user->plan_expire_date))) }}</a>
                                        </button>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="page-error">
                            <div class="page-inner">
                                <h1>404</h1>
                                <div class="page-description">
                                    {{ __('Page Not Found') }}
                                </div>
                                <div class="page-search">
                                    <p class="text-muted mt-3">{{ __("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")}}</p>
                                    <div class="mt-3">
                                        <a class="btn-return-home badge-blue" href="{{route('home')}}"><i class="fas fa-reply"></i> {{ __('Return Home')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <!-- container -->
@endsection
