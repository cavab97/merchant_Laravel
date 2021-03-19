@extends('layouts.admin')

@section('page-title') {{__('Payment')}} @endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-5 mb-1">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form role="form" action="{{ route('prepare.payment', $currentWorkspace->slug) }}" method="post" class="require-validation" id="payment-form">
                            @csrf
                            <input type="hidden" name="code" value="{{\Illuminate\Support\Facades\Crypt::encrypt($plan->id)}}">
                            <div class="row">
                                <div class="col-md-6 my-3">
                                    <label class="form-control-label text-dark">{{__('Payment Method')}}</label>
                                    <div class="d-flex radio-check">
                                        @if((env('ENABLE_PAYPAL') == 'on' && !empty(env('PAYPAL_CLIENT_ID')) && !empty(env('PAYPAL_SECRET_KEY'))))
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="paypal" value="paypal" name="payment_processor" class="custom-control-input" checked>
                                                <label class="custom-control-label form-control-label text-dark" for="paypal">{{__('Paypal')}}</label>
                                            </div>
                                        @endif
                                        @if((env('ENABLE_STRIPE') == 'on' && !empty(env('STRIPE_KEY')) && !empty(env('STRIPE_SECRET'))))
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="stripe" value="stripe" name="payment_processor" class="custom-control-input">
                                                <label class="custom-control-label form-control-label text-dark" for="stripe">{{__('Stripe')}}</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 my-3">
                                    <label class="form-control-label text-dark">{{__('Payment Type')}}</label>
                                    <div class="d-flex radio-check">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="one_time_type" value="one-time" name="payment_type" class="custom-control-input" checked>
                                            <label class="custom-control-label form-control-label text-dark" for="one_time_type">{{__('One Time')}}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="recurring_type" value="recurring" name="payment_type" class="custom-control-input">
                                            <label class="custom-control-label form-control-label text-dark" for="recurring_type">{{__('Reccuring')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 my-3">
                                    <div class="row">
                                        <div class="col-lg-10 col-mg-10 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" id="coupon" name="coupon" class="form-control" placeholder="{{__('Enter Coupon Code Here')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-mg-2 col-sm-12 col-xs-12 mt-1">
                                            <a href="#" class="btn badge-blue btn-xs rounded-pill my-auto text-white " id="apply-coupon">{{__('Apply')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <input type="hidden" name="payment_frequency" value="{{ $frequency }}" data-price="{{ $plan->price }}">
                                    <button class="btn badge-blue btn-xs rounded-pill px-3" type="submit">
                                        {{__('Checkout')}} (<span class="final-price">{{ $plan->price }}</span>)
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <?php $stripe_session = \Session::get('stripe_session');?>

    <?php if(isset($stripe_session) && $stripe_session): ?>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        stripe.redirectToCheckout({
            sessionId: '{{ $stripe_session->id }}',
        }).then((result) => {
        });
    </script>
    <?php endif ?>

    <script type="text/javascript">
        $(document).on('change', 'input[name="payment_type"]', function (e) {
            var price = $('input[name="payment_frequency"]').attr('data-price');
            var frequency = '{{ $frequency }}';
            var type = $('input[name="payment_type"]:checked').val();

            var total = per = '';

            if (frequency == 'monthly') {
                var per = '/month';
            } else if (frequency == 'annual') {
                var per = '/year';
            }

            if (type == 'recurring') {
                var total = price + per;
            } else if (type == 'one-time') {
                var total = price;
            }

            $('.final-price').text(total);
        });

        // Apply Coupon
        $(document).on('click', '#apply-coupon', function (e) {
            e.preventDefault();

            var ele = $(this);
            var coupon = $('#coupon').val();

            if (coupon != '') {
                $.ajax({
                    url: '{{route('apply.coupon')}}',
                    datType: 'json',
                    data: {
                        plan_id: '{{ $plan->id }}',
                        coupon: coupon,
                        frequency: '{{ $frequency }}'
                    },
                    success: function (data) {
                        $('#stripe_coupon, #paypal_coupon').val(coupon);
                        if (data.is_success) {
                            $('.coupon-tr').show().find('.coupon-price').text(data.discount_price);
                            $('.final-price').text(data.final_price);
                            show_toastr('Success', data.message, 'success');
                        } else {
                            $('.coupon-tr').hide().find('.coupon-price').text('');
                            $('.final-price').text(data.final_price);
                            show_toastr('Error', data.message, 'error');
                        }
                    }
                })
            } else {
                show_toastr('Error', '{{__('Invalid Coupon Code.')}}', 'error');
            }
        });

    </script>
@endpush
