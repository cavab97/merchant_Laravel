@extends('layouts.admin')

@section('page-title') {{ __('Plans') }} @endsection

@section('action-button')
    @if(Auth::user()->type == 'admin' && ((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET')))
        || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY')))))
        <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-size="md" data-title="{{ __('Add Plan') }}" data-url="{{route('plans.create')}}">
            <i class="fa fa-plus"></i> {{ __('Add Plan') }}
        </a>
    @endif
@endsection

@section('content')
    <section class="section">

        <div class="row">
            <div class="col-md-12">
                @if(empty(env('STRIPE_KEY')) || empty(env('STRIPE_SECRET')))
                    <div class="alert alert-warning"><i class="fas fa-exclamation mr-1"></i> {{__('Please set stripe api key & secret key for add new plan')}}</div>
                @endif
                @if(empty(env('PAYPAL_CLIENT_ID')) || empty(env('PAYPAL_SECRET_KEY')))
                    <div class="alert alert-warning"><i class="fas fa-exclamation mr-1"></i> {{__('Please set paypal client id & secret key for add new plan')}}</div>
                @endif
            </div>
        </div>

        <div class="row">
            @foreach ($plans as $key => $plan)

                <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                    <div class="plan-3">
                        <h6>{{ $plan->name }}
                            @if(Auth::user()->type == 'admin' &&
                                ((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET')))
                                || (env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY')))))
                                <a href="#" class="edit-icon d-flex align-items-center float-right" data-url="{{ route('plans.edit',$plan->id) }}" data-ajax-popup="true" data-title="{{__('Edit Plan')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            @endif
                        </h6>

                        <p class="price">
                            <small><h6>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->monthly_price}} {{ __('Monthly Price') }}</h6></small>
                            <small><h6>{{(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$'}}{{$plan->annual_price}} {{ __('Annual Price') }}</h6></small>
                        </p>
                        <ul class="plan-detail">
                            <li>{{ ($plan->trial_days < 0)?__('Unlimited'):$plan->trial_days }} {{__('Trial Days')}}</li>
                            <li>{{ ($plan->max_workspaces < 0)?__('Unlimited'):$plan->max_workspaces }} {{__('Workspaces')}}</li>
                            <li>{{ ($plan->max_users < 0)?__('Unlimited'):$plan->max_users }} {{__('Users Per Workspace')}}</li>
                            <li>{{ ($plan->max_clients < 0)?__('Unlimited'):$plan->max_clients }} {{__('Clients Per Workspace')}}</li>
                            <li>{{ ($plan->max_projects < 0)?__('Unlimited'):$plan->max_projects }} {{__('Projects Per Workspace')}}</li>
                        </ul>
                        <p class="price-text">
                            {{ $plan->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
