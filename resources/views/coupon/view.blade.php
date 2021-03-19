@extends('layouts.admin')

@section('page-title') {{__('Coupon Detail')}} @endsection

@section('content')

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="selection-datatable" class="table" width="100%">
                            <thead>
                            <tr>
                                <th> {{__('Coupon')}}</th>
                                <th> {{__('User')}}</th>
                                <th> {{__('Date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($userCoupons as $userCoupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ !empty($userCoupon->userDetail)?$userCoupon->userDetail->name:'' }}</td>
                                    <td>{{ $userCoupon->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('css-page')
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
