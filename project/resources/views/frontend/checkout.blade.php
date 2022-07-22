@extends('layouts.front')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/checkout.css')}}">
@endpush

@section('contents')

<section class="banner-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
    <div class="banner-overlay">
        <div class="banner-text text-center">
            <div class="container">
                <div class="text-center">
                    <div class="col-xs-12">
                        <h2 class="title-head"><span>{{__('Checkout')}}</span></h2>
                        <hr>
                        <ul class="breadcrumbb">
                            <li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
                            <li>{{__('Checkout')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="order-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="order-details-box">
                    <div class="header">
                        <h4 class="title">
                            {{ __('Enter Your Details') }}
                        </h4>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-12">
                            <div class="content">
                                @include('includes.admin.form-flash')

                                <form id="payment-form" method="POST" action="">

                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" name="customer_name" class="form-control" placeholder="{{ __('Enter your full Name') }}" required="" value="{{auth()->user()->name }}">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="email" name="customer_email" class="form-control" placeholder="{{ __('Enter your email address') }}" required="" value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="customer_phone" class="form-control" placeholder="{{ __('Enter your Phone Number') }}" required="" value="{{ auth()->user()->phone }}">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="customer_address" class="form-control" placeholder="{{ __('Enter your Address') }}" required="" value="{{ auth()->user()->address }}">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="customer_city" class="form-control" placeholder="{{ __('Enter your City') }}" required="" value="{{ auth()->user()->city }}">
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" name="customer_zip" class="form-control" placeholder="{{ __('Enter your Postal Code') }}" required="" value="{{ auth()->user()->zip }}">
                                        </div>
                                        <div class="col-lg-12">
                                            <select class="patment-method form-control" id="method" name="method" required>
                                                <option value="">{{ __('Select Payment Method') }}</option>
                                                    @foreach ($gateways as $gateway)
                                                        @if ($gateway->type == 'manual')
                                                            <option value="Manual" data-details="{{$gateway->details}}">{{ $gateway->title }}</option>
                                                            @else
                                                            <option value="{{$gateway->keyword}}">{{ $gateway->name }}</option>
                                                        @endif
                                                    @endforeach

                                                    <option value="parisi_bank">{{ __('Parisi Bank') }}</option>
                                                    @if ($gs->isWallet == 1)
                                                        <option value="Wallet">{{ __('Wallet') }}</option>
                                                    @endif
                                           </select>
                                        </div>

                                        <div class="col-lg-12 mt-4 manual-payment d-none">
                                            <div class="card manual_card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 pb-2 manual-payment-details">
                                                        </div>
                                                        
                                                        <div class="col-lg-12">
                                                            <label>{{__('Transaction ID')}}# *</label>
                                                            <input class="form-control manual_input" name="txn_id4" type="text" placeholder="{{ __('Transaction ID') }}#" id="manual_transaction_id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

              
                                    <div id="perfects" class="d-none">
                                        <input type="hidden" name="PAYEE_ACCOUNT" value="{{$gs->pm_account}}">
                                        <input type="hidden" name="PAYEE_NAME" value="{{$gs->title}}">
                                        <input type="hidden" name="PAYMENT_ID" value="{{Str::random(2).time().Str::random(2)}}">
                                        <input type="hidden" name="PAYMENT_UNITS" value="USD">

                                        <input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
                                        <input type="hidden" name="NOPAYMENT_URL" value="{{url()->current()}}">
                                        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
                                        <input type="hidden" name="SUGGESTED_MEMO" value="">
                                        <input type="hidden" name="BAGGAGE_FIELDS" value="CUST_NUM">
                                        <input type="hidden" name="CUST_NUM" value="{{Auth::user()->email}}">
                                    </div>



                                    <div id="card-view" class="col-lg-12 pt-3 d-none">
                                        <div class="row">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="no_note" value="1">
                                            <input type="hidden" name="lc" value="UK">
                                            <input type="hidden" id="currencyCode" name="currency_code" value="{{ $defaultCurrency->name }}">
                                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

                                            <div class="col-lg-6">
                                                <input type="text" class="form-control card-elements" name="cardNumber" placeholder="{{ __('Card Number') }}" autocomplete="off" required autofocus oninput="validateCard(this.value);"/>
                                                <span id="errCard"></span>
                                            </div>

                                            <div class="col-lg-6 cardRow">
                                                <input type="text" class="form-control card-elements" placeholder="{{ __('CVV') }}" name="cardCVC" oninput="validateCVC(this.value);">
                                                <span id="errCVC"></span>
                                            </div>

                                            <div class="col-lg-6">
                                                <input type="text" class="form-control card-elements" placeholder="{{ __('Month') }}" name="month" >
                                            </div>

                                            <div class="col-lg-6">
                                                <input type="text" class="form-control card-elements" placeholder="{{ __('Year') }}" name="year">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="subtitle" value="{{ $product->subtitle }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" id="amount" name="invest" value="{{ Session::get('payprice') }}">
                                    <input type="hidden" name="title" value="{{ $product->title }}">
                                    <input type="hidden" name="details" value="{{ $product->details }}">
                                    <input type="hidden" name="days" value="{{ $product->days }}">
                                    <input type="hidden" name="total" value="{{ Session::get('getprice')}}">
                                    <input type="hidden" name="currency_sign" value="{{ $defaultCurrency->sign }}">
                                    <input type="hidden" name="currency_code" value="{{ $defaultCurrency->name }}">
                                    <input type="hidden" name="currency_id" value="{{ $defaultCurrency->id }}">


                                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                    <input type="hidden" name="ref_id" id="ref_id" value="">
                                    <input type="hidden" name="sub" id="sub" value="0">
                                    
                                    <input type="hidden" name="paystackInfo" id="paystackInfo" value="{{$paystackdata['key']}}">

                                    <div class="col-lg-12">
                                        <button type="submit" class="btn-checkout btn btn-primary mt-3" id="final-btn">{{ __('Checkout') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-4 ">
                <div class="pricing">
                    <div class="single-pricebox">
                        <p class="plan-title">
                            {{ $product->title }}
                        </p>

                        <div class="bonus">
                            <i class="fas fa-dollar-sign"></i>
                            <p class="persent">{{ $product->percentage }}%</p>
                            <p class="time">{{ __('Bonus in') }} {{ $product->days }} {{ __('day(s)') }}</p>
                        </div>

                        <div class="price-range-area-checkout">
                            <div class="invest-get">
                                <div class="left">
                                    {{ __('Invest') }} 
                                    <span>{{ $gs->currency_format == 0 ? $defaultCurrency->sign.Session::get('payprice') : Session::get('payprice').$defaultCurrency->sign }}</span>
                                </div>
                                <div class="right">
                                    {{ __('Get') }} <span>{{ $gs->currency_format == 0 ? $defaultCurrency->sign.Session::get('getprice') : Session::get('getprice').$defaultCurrency->sign }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="pricing">
                <div class="single-pricebox">
                    <p class="plan-title">
                        {{ __('Wallet Balance') }}
                    </p>
                    <div class="bonus">
                        @if($gs->currency_format == 0)
                            <p class="persent">{{ $defaultCurrency->sign }}{{ round(Auth::user()->income,2) }}</p>
                        @else 
                            <p class="persent">{{ round(Auth::user()->income,2) }}{{ $defaultCurrency->sign }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
</section>
@endsection

@push('js')
    <script type="text/javascript">
    'use strict';

    $(document).on('change','#method',function(){
        var val = $(this).val();

        if(val == 'stripe')
        {
            $('#payment-form').prop('action','{{ route('stripe.submit') }}');
            $('#card-view').removeClass('d-none');
            $('.card-elements').prop('required',true);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');

        }

        if(val == 'authorize.net')
        {
            $('#payment-form').prop('action','{{ route('authorize.submit') }}');
            $('#card-view').removeClass('d-none');
            $('.card-elements').prop('required',true);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'paypal') {
            $('#payment-form').prop('action','{{ route('paypal.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'mollie') {
            $('#payment-form').prop('action','{{ route('molly.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'paystack') {
            $('#payment-form').prop('action','{{ route('paystack.submit') }}');
            $('#payment-form').prop('class','step1-form');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'flutterwave') {
            $('#payment-form').prop('action','{{ route('flutter.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'coingate') {
            $('#payment-form').prop('action','{{ route('coingate.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'paytm') {
            $('#payment-form').prop('action','{{ route('paytm.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'coinbase') {
            $('#payment-form').prop('action','{{ route('coincommerce.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'blockChain') {
            $('#payment-form').prop('action','{{ route('blockchain.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'PerfectMoney') {
            $('#amount').attr('name', 'PAYMENT_AMOUNT');
            $('#payment-form').prop('action','https://perfectmoney.is/api/step1.asp');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'coinPayment') {
            $('#payment-form').prop('action','{{ route('coinpay.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'BlockIO(BTC)' || val == 'BlockIO(LTC)' || val == 'BlockIO(DGC)') {
            $('#payment-form').prop('action','{{ route('blockio.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'VougePay') {
            $('#payment-form').prop('action','https://voguepay.com/pay/');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'Coingate') {
            $('#payment-form').prop('action','{{route('coingate.submit')}}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'block.io.btc' || val == 'block.io.ltc' || val == 'block.io.dgc') {
            $('#payment-form').prop('action','{{route('blockio.submit')}}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'instamojo') {
            $('#payment-form').prop('action','{{ route('instamojo.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }


        if(val == 'razorpay') {
            $('#payment-form').prop('action','{{ route('user.razorpay.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'Manual'){
            $('#payment-form').prop('action','{{route('manual.submit')}}');
            $('.manual-payment').removeClass('d-none');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',true);
            const details = $(this).find(':selected').data('details');
            $('.manual-payment-details').empty();
            $('.manual-payment-details').append(`<font size="3">${details}</font>`)
        }

        if(val == 'Wallet'){
            $('#payment-form').prop('action','{{route('wallet.submit')}}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }

        if(val == 'parisi_bank') {
            $('#payment-form').prop('action','{{ route('parisi.submit') }}');
            $('#card-view').addClass('d-none');
            $('.card-elements').prop('required',false);
            $('#manual_transaction_id').prop('required',false);
            $('.manual-payment').addClass('d-none');
        }
    });

    $(document).on('submit','.step1-form',function(){
        var val = $('#sub').val();
        var total = $('#amount').val();
        var paystackInfo = $('#paystackInfo').val();
        var curr = $('#currencyCode').val();
        total = Math.round(total);
            if(val == 0)
            {
            var handler = PaystackPop.setup({
            key: paystackInfo,
            email: $('input[name=email]').val(),
            amount: total * 100,
            currency: curr,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            callback: function(response){
                $('#ref_id').val(response.reference);
                $('#sub').val('1');
                $('#final-btn').click();
            },
            onClose: function(){
                window.location.reload();
            }
            });
            handler.openIframe();
                return false;                    
            }
            else {
                $('#preloader').show();
                return true;   
            }
    });
    </script>

    <script>
        'use strict';
        closedFunction=function() {
            alert('Payment Cancelled!');
        }

        successFunction=function(transaction_id) {
            window.location.href = '{{ url('order/payment/return') }}?txn_id=' + transaction_id;
        }

        failedFunction=function(transaction_id) {
            alert('Transaction was not successful, Ref: '+transaction_id)
        }
    </script>

  <script type="text/javascript">
    'use strict';

    var cnstatus = false;
    var dateStatus = false;
    var cvcStatus = false;

    function validateCard(cn) {
      cnstatus = Stripe.card.validateCardNumber(cn);
      if (!cnstatus) {
        $("#errCard").html('Card number not valid<br>');
      } else {
        $("#errCard").html('');
      }
      btnStatusChange();


    }

    function validateCVC(cvc) {
      cvcStatus = Stripe.card.validateCVC(cvc);
      if (!cvcStatus) {
        $("#errCVC").html('CVC number not valid');
      } else {
        $("#errCVC").html('');
      }
      btnStatusChange();
    }

  </script>

<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>


@endpush