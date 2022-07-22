@extends('layouts.user')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Investment Details') }} <a href="javascript:history.back();" class="btn btn-primary btn-round ml-2">{{ __('Back') }}</a>
              </h3>
            </div>
            <div class="content">
                <div class="mr-table allproduct mt-4">
                    <div class="table-responsive">
                        <table class="table tabl-text">
                            <tr>
                                <th width="50%">{{ __('Transaction ID') }}</th>
                                <td>{{$order->order_number}}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Pricing Plan') }}</th>
                                <td>{{$order->title}}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Payment Method') }}</th>
                                <td>{{$order->method}}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Invest') }}</th>
                                <td>{{ round($order->invest * $defaultCurrency->value)}}{{ $defaultCurrency->sign }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Get') }}</th>
                                <td>{{ round($order->pay_amount * $defaultCurrency->value)}}{{ $defaultCurrency->sign }}</td>
                            </tr>
                            <tr>
                                <th>{{$order->method}} {{ __('Transaction ID') }}</th>
                                <td>{{$order->txnid}}</td>
                            </tr>

                            @if($order->method != 'Paypal')
                            <tr>
                                <th>{{$order->method}} {{ __('Transaction ID') }}</th>
                                <td>{{$order->method}} {{$order->charge_id}}</td>
                            </tr>
                            @endif

                            <tr>
                                <th>{{ __('Payment Status') }}</th>
                                <td>{{$order->payment_status}}</td>
                            </tr>


                            <tr>
                                <th>{{ __('Date') }}</th>
                                <td>{{$order->created_at}}</td>
                            </tr>



                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>

@endsection

@push('js')
<script type="text/javascript">
    'use strict';

    $('#example').DataTable({
        ordering: false
    });
</script>
@endpush
