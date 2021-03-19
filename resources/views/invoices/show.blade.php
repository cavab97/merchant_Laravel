@extends('layouts.admin')

@section('page-title') {{__('Invoices')}} @endsection

@section('multiple-action-button')
    @auth('client')
        @if($invoice->getDueAmount() > 0 && (($currentWorkspace->is_stripe_enabled == 1 && !empty($currentWorkspace->stripe_key) && !empty($currentWorkspace->stripe_secret)) || ($currentWorkspace->is_paypal_enabled == 1 && !empty($currentWorkspace->paypal_client_id) && !empty($currentWorkspace->paypal_secret_key))))
            <div class="text-sm-right">
                <a href="#" data-toggle="modal" data-target="#paymentModal" class="btn btn-xs btn-white btn-icon-only width-auto" type="button">
                    <i class="fas fa-credit-card mr-1"></i> {{__('Pay Now')}}
                </a>
            </div>
        @endif
    @endauth

    @auth('web')
        @if($currentWorkspace->creater->id == Auth::user()->id)
            <div class="text-sm-right">
                <a href="#" data-toggle="modal" data-target="#addPaymentModal" class="btn btn-xs btn-white btn-icon-only width-auto" type="button">
                    <i class="fas fa-credit-card mr-1"></i> {{__('Add Payment')}}
                </a>
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit Invoice') }}" data-url="{{route('invoices.edit',[$currentWorkspace->slug,$invoice->id])}}">
                    <i class="fas fa-pencil-alt mr-1"></i>{{__('Edit Invoice')}}
                </a>
                <a href="#" data-ajax-popup="true" data-title="{{ __('Add Item') }}" data-url="{{route('invoice.item.create',[$currentWorkspace->slug,$invoice->id])}}" class="btn btn-xs btn-white btn-icon-only width-auto" type="button">
                    <i class="fas fa-plus mr-1"></i> {{__('Add Item')}}
                </a>
            </div>
        @endif
    @endauth
@endsection

@section('content')

    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="text-right">
                        <div class="h5">{{Utility::invoiceNumberFormat($invoice->invoice_id)}}</div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <address class="text-sm">
                                <h6>{{__('From')}}:</h6>
                                @if($currentWorkspace->company){{$currentWorkspace->company}}@endif
                                @if($currentWorkspace->address) <br>{{$currentWorkspace->address}}@endif
                                @if($currentWorkspace->city) <br> {{$currentWorkspace->city}}, @endif @if($currentWorkspace->state){{$currentWorkspace->state}}@endif @if($currentWorkspace->zipcode) - {{$currentWorkspace->zipcode}}@endif
                                @if($currentWorkspace->country) <br>{{$currentWorkspace->country}}@endif
                                @if($currentWorkspace->telephone) <br>{{$currentWorkspace->telephone}}@endif
                            </address>
                            <address class="text-sm">
                                <h6>{{__('To')}}:</h6>
                                @if($invoice->client)
                                    {{$invoice->client->name}}
                                    @if($invoice->client->address) <br>{{$invoice->client->address}}@endif
                                    @if($invoice->client->city) <br> {{$invoice->client->city}}, @endif @if($invoice->client->state){{$invoice->client->state}}@endif @if($invoice->client->zipcode) - {{$invoice->client->zipcode}}@endif
                                    @if($invoice->client->country) <br>{{$invoice->client->country}}@endif
                                    <br>{{$invoice->client->email}}
                                    @if($invoice->client->telephone) <br>{{$invoice->client->telephone}}@endif
                                @endif
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <h6>{{ __('Project') }}:</h6>
                                {{$invoice->project->name}}
                            </address>
                            <address>
                                <h6>{{ __('Status') }}:</h6>
                                <div class="font-weight-bold font-style">
                                    @if($invoice->status == 'sent')
                                        <span class="badge badge-warning">{{__('Sent')}}</span>
                                    @elseif($invoice->status == 'paid')
                                        <span class="badge badge-success">{{__('Paid')}}</span>
                                    @elseif($invoice->status == 'canceled')
                                        <span class="badge badge-danger">{{__('Canceled')}}</span>
                                    @endif
                                </div>
                            </address>
                            <address>
                                <h6>{{__('Issue Date')}}:</h6>
                                {{Utility::dateFormat($invoice->issue_date)}}
                            </address>
                            <address>
                                <h6>{{__('Due Date')}}:</h6>
                                {{Utility::dateFormat($invoice->due_date)}}
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="h6">{{__('Order Summary')}}</div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                    <tr>
                                        <th class="form-control-label">#</th>
                                        <th class="form-control-label">{{__('Item')}}</th>
                                        <th class="form-control-label text-right">{{__('Totals')}}</th>
                                        @auth('web')
                                            <th class="form-control-label text-right">{{__('Action')}}</th>
                                        @endauth
                                    </tr>
                                    @foreach($invoice->items as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->task->title}} - <b>{{$item->task->project->name}}</b></td>
                                            <td>{{$currentWorkspace->priceFormat($item->price * $item->qty)}}</td>
                                            @auth('web')
                                                <td class="text-right">
                                                    <a href="#" class="delete-icon" data-confirm="{{ __('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?') }}" data-confirm-yes="document.getElementById('delete-form-{{$item->id}}').submit();">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <form id="delete-form-{{$item->id}}" action="{{ route('invoice.item.destroy',[$currentWorkspace->slug,$invoice->id,$item->id]) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            @endauth
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="offset-md-8 col-md-4 text-right">
                                    <div class="invoice-detail-item">
                                        <span>{{__('Subtotal')}}</span>
                                        <div class="h6">{{$currentWorkspace->priceFormat($invoice->getSubTotal())}}</div>
                                    </div>
                                    @if($invoice->discount)
                                        <div class="invoice-detail-item">
                                            <span>{{__('Discount')}}</span>
                                            <div class="h6">{{$currentWorkspace->priceFormat($invoice->discount)}}</div>
                                        </div>
                                    @endif
                                    @if($invoice->tax)
                                        <div class="invoice-detail-item">
                                            <span>{{__('Tax')}} {{$invoice->tax->name}} ({{$invoice->tax->rate}}%)</span>
                                            <div class="h6">{{$currentWorkspace->priceFormat($invoice->getTaxTotal())}}</div>
                                        </div>
                                    @endif
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <span>{{__('Total')}}</span>
                                        <div class="h6">{{$currentWorkspace->priceFormat($invoice->getTotal())}}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <span>{{__('Due Amount')}}</span>
                                        <div class="h6 text-danger">{{$currentWorkspace->priceFormat($invoice->getDueAmount())}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="@auth('web'){{route('invoice.print',[$currentWorkspace->slug,\Illuminate\Support\Facades\Crypt::encryptString($invoice->id)])}}@elseauth{{route('client.invoice.print',[$currentWorkspace->slug,\Illuminate\Support\Facades\Crypt::encryptString($invoice->id)])}}@endauth" class="btn-submit">
                                <i class="fas fa-print"></i> {{ __('Print') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($payments = $invoice->payments)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>{{__('Payments')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tbody>
                                <tr>
                                    <th class="form-control-label">{{__('Id')}}</th>
                                    <th class="form-control-label">{{__('Amount')}}</th>
                                    <th class="form-control-label">{{__('Currency')}}</th>
                                    <th class="form-control-label">{{__('Status')}}</th>
                                    <th class="form-control-label">{{__('Payment Type')}}</th>
                                    <th class="form-control-label">{{__('Date')}}</th>
                                    <th class="form-control-label">{{__('Receipt')}}</th>
                                </tr>
                                @foreach($payments as $key => $payment)
                                    <tr>
                                        <td>{{$payment->order_id}}</td>
                                        <td>{{$currentWorkspace->priceFormat($payment->amount)}}</td>
                                        <td>{{strtoupper($payment->currency)}}</td>
                                        <td>
                                            @if($payment->payment_status == 'succeeded' || $payment->payment_status == 'approved')
                                                <i class="fas fa-circle text-success"></i> {{__(ucfirst($payment->payment_status))}}
                                            @else
                                                <i class="fas fa-circle text-danger"></i> {{__(ucfirst($payment->payment_status))}}
                                            @endif
                                        </td>
                                        <td>{{ __($payment->payment_type) }}</td>
                                        <td>{{Utility::dateFormat($payment->created_at)}}</td>
                                        <td>
                                            @if(!empty($payment->receipt))
                                                <a href="{{$payment->receipt}}" target="_blank" class="btn-submit"><i class="fas fa-print mr-1"></i> {{__('Receipt')}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(auth('web') && $invoice->getDueAmount() > 0)
        <!-- Modal -->
        <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">{{ __('Add Manual Payment') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-box">
                            <form method="post" action="{{ route('manual.invoice.payment',[$currentWorkspace->slug,$invoice->id]) }}" class="require-validation">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="amount" class="form-control-label">{{ __('Amount') }}</label>
                                        <div class="form-icon-user">
                                            <span class="currency-icon">{{ (!empty($currentWorkspace->currency)) ? $currentWorkspace->currency : '$' }}</span>
                                            <input class="form-control" type="number" id="amount" name="amount" value="{{$invoice->getDueAmount()}}" min="0" step="0.01" max="{{$invoice->getDueAmount()}}" placeholder="{{ __('Enter Monthly Price') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn-create badge-blue" value="{{ __('Make Payment') }}">
                                        <input type="button" class="btn-create bg-gray" data-dismiss="modal" value="{{ __('Cancel') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @auth('client')
        @if($invoice->getDueAmount() > 0)
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">{{ __('Add Payment') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-box">
                                @if($currentWorkspace->is_stripe_enabled == 1 && $currentWorkspace->is_paypal_enabled == 1)
                                    <ul class="nav nav-tabs">
                                        <li>
                                            <a data-toggle="tab" href="#stripe-payment" class="active">{{__('Stripe')}}</a>
                                        </li>
                                        <li class="annual-billing">
                                            <a data-toggle="tab" href="#paypal-payment" class="">{{__('Paypal')}} </a>
                                        </li>
                                    </ul>
                                @endif

                                <div class="tab-content mt-3">
                                    @if($currentWorkspace->is_stripe_enabled == 1)
                                        <div class="tab-pane fade {{ (($currentWorkspace->is_stripe_enabled == 1 && $currentWorkspace->is_paypal_enabled == 1) || $currentWorkspace->is_stripe_enabled == 1) ? "show active" : "" }}" id="stripe-payment" role="tabpanel" aria-labelledby="stripe-payment">
                                            <form method="post" action="{{ route('client.invoice.payment',[$currentWorkspace->slug,$invoice->id]) }}" class="require-validation" id="payment-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="custom-radio">
                                                            <label class="font-16 form-control-label">{{__('Credit / Debit Card')}}</label>
                                                        </div>
                                                        <p class="mb-0 pt-1 text-sm">{{__('Safe money transfer using your bank account. We support Mastercard, Visa, Discover and American express.')}}</p>
                                                    </div>
                                                    <div class="col-sm-4 text-sm-right mt-3 mt-sm-0">
                                                        <img src="{{asset('assets/img/payments/master.png')}}" height="24" alt="master-card-img">
                                                        <img src="{{asset('assets/img/payments/discover.png')}}" height="24" alt="discover-card-img">
                                                        <img src="{{asset('assets/img/payments/visa.png')}}" height="24" alt="visa-card-img">
                                                        <img src="{{asset('assets/img/payments/american express.png')}}" height="24" alt="american-express-card-img">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="card-name-on" class="form-control-label">{{__('Name on card')}}</label>
                                                            <input type="text" name="name" id="card-name-on" class="form-control required" placeholder="{{\Auth::user()->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div id="card-element">
                                                        </div>
                                                        <div id="card-errors" role="alert"></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount" class="form-control-label">{{ __('Amount') }}</label>
                                                        <div class="form-icon-user">
                                                            <span class="currency-icon">{{ (!empty($currentWorkspace->currency)) ? $currentWorkspace->currency : '$'}}</span>
                                                            <input class="form-control" required="required" min="0" name="amount" type="number" value="{{$invoice->getDueAmount()}}" min="0" step="0.01" max="{{$invoice->getDueAmount()}}" id="amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="error" style="display: none;">
                                                            <div class='alert-danger alert'>{{__('Please correct the errors and try again.')}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="submit" class="btn-create badge-blue" value="{{ __('Make Payment') }}">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    @if($currentWorkspace->is_paypal_enabled == 1)
                                        <div class="tab-pane fade {{ ($currentWorkspace->is_stripe_enabled == 0 && $currentWorkspace->is_paypal_enabled == 1) ? "show active" : "" }}" id="paypal-payment" role="tabpanel" aria-labelledby="paypal-payment">
                                            <form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form" action="{{ route('client.pay.with.paypal', [$currentWorkspace->slug, $invoice->id]) }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label for="amount" class="form-control-label">{{ __('Amount') }}</label>
                                                        <div class="form-icon-user">
                                                            <span class="currency-icon">{{ (!empty($currentWorkspace->currency)) ? $currentWorkspace->currency : '$'}}</span>
                                                            <input class="form-control" required="required" min="0" name="amount" type="number" value="{{$invoice->getDueAmount()}}" min="0" step="0.01" max="{{$invoice->getDueAmount()}}" id="amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <input type="submit" class="btn-create badge-blue" value="{{ __('Make Payment') }}">
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

@auth('client')
    @if($invoice->getDueAmount()>0 && $currentWorkspace->is_stripe_enabled == 1 && !empty($currentWorkspace->stripe_key) && !empty($currentWorkspace->stripe_secret))

        @push('css-page')
            <style>
                #card-element {
                    border: 1px solid #e4e6fc;
                    border-radius: 5px;
                    padding: 10px;
                }
            </style>
        @endpush
        @push('scripts')
            <script src="https://js.stripe.com/v3/"></script>

            <script type="text/javascript">

                var stripe = Stripe('{{ $currentWorkspace->stripe_key }}');
                var elements = stripe.elements();

                // Custom styling can be passed to options when creating an Element.
                var style = {
                    base: {
                        // Add your base input styles here. For example:
                        fontSize: '14px',
                        color: '#32325d',
                    },
                };

                // Create an instance of the card Element.
                var card = elements.create('card', {style: style});

                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');

                // Create a token or display an error when the form is submitted.
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    stripe.createToken(card).then(function (result) {
                        if (result.error) {
                            show_toastr('Error', result.error.message, 'error');
                        } else {
                            // Send the token to your server.
                            stripeTokenHandler(result.token);
                        }
                    });
                });

                function stripeTokenHandler(token) {
                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            </script>
        @endpush
    @endif
@endauth
