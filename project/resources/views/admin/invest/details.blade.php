@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Investment Details') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.invests.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Purchase History') }}</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Order Details') }}</a></li>
        </ol>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                        {{__('Order Details')}}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th class="45%" width="45%">{{__('Transaction ID')}}</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{$order->order_number}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Pricing Plan')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->title}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Payment Method')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->method}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Invest')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->invest}}{{ $gs->currency_sign }}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Get')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->pay_amount}}{{ $gs->currency_sign }}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{$order->method}} {{__('Transaction ID')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->txnid}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer Email')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_email}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer Name')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_name}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer Phone')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_phone}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer Address')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_address}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer City')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_city}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Customer Zip')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->customer_zip}}</td>
                            </tr>

                            <tr>
                                <th width="45%">{{__('Date')}}</th>
                                <td width="10%">:</td>
                                <td width="45%">{{$order->created_at}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="footer-area">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
