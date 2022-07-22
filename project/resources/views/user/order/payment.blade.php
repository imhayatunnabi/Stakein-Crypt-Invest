<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @if(isset($page->meta_tag) && isset($page->meta_description))
        <meta name="keywords" content="{{ $page->meta_tag }}">
        <meta name="description" content="{{ $page->meta_description }}"> 
    @elseif(isset($blog->meta_tag) && isset($blog->meta_description))
        <meta name="keywords" content="{{ $blog->meta_tag }}">
        <meta name="description" content="{{ $blog->meta_description }}"> 
    @else
        <meta name="keywords" content="{{ $seo->meta_keys }}">
        <meta name="author" content="GeniusOcean">
    @endif
    <title>{{$gs->title}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/'.$gs->favicon)}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/font-awesome.min.css')}}">
    <link href="{{asset('assets/front/css/material-kit.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/front/css/skins/orange.css')}}">
    <script src="{{asset('assets/front/js/modernizr.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('assets/front/css/rtl/styles.php?color='.str_replace('#','',$gs->colors)) }}">

    @if ($default_font->font_value)
        <link href="https://fonts.googleapis.com/css?family={{ $default_font->font_value }}&display=swap" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    @endif

    @if ($default_font->font_family)
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='.$default_font->font_family) }}">
    @else
        <link rel="stylesheet" id="colorr" href="{{ asset('assets/front/css/font.php?font_familly='."Open Sans") }}">
    @endif
	@stack('css')
</head>

<body>


    <div class="wrapper">

        <section class="dashbord-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    </div>

                    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    @include('includes.admin.form-flash')

                    <form id="payment-form" method="POST" action="">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="customer_name" class="form-control" placeholder="{{ __('Enter your full Name') }}" required="" value="{{ $invest->customer_name }}">
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="customer_email" class="form-control" placeholder="{{ __('Enter your email address') }}" required="" value="{{ $invest->customer_email }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="customer_phone" class="form-control" placeholder="{{ __('Enter your Phone Number') }}" required="" value="{{ $invest->customer_phone }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="customer_address" class="form-control" placeholder="{{ __('Enter your Address') }}" required="" value="{{ $invest->customer_address }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="customer_city" class="form-control" placeholder="{{ __('Enter your City') }}" required="" value="{{ $invest->customer_city }}">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="customer_zip" class="form-control" placeholder="{{ __('Enter your Postal Code') }}" required="" value="{{ $invest->customer_zip }}">
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
                            <input type="hidden" name="CUST_NUM" value="{{ $invest->customer_email }}">
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


                        <input type="hidden" name="order_number" value="{{ $invest->order_number }}">
                        <input type="hidden" name="email" value="{{ $invest->customer_email }}">
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
        </section>


        <a href="#" id="back-to-top" class="back-to-top fa fa-arrow-up"></a>

        <script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/front/js/jquery-migrate-3.3.2.js')}}"></script>
        <script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/front/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/front/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/front/js/notify.min.js')}}"></script>
        <script src="{{asset('assets/front/js/custom.js')}}"></script>
        <script src="{{asset('assets/front/js/rangeslider.min.js') }}"></script>

        <script src="https://js.paystack.co/v1/inline.js"></script>

        <script type="text/javascript">
            'use strict';
        
            $(document).on('change','#method',function(){
                var val = $(this).val();
        
                if(val == 'stripe')
                {
                    $('#payment-form').prop('action','{{ route('api.user.invest.stripe.submit') }}');
                    $('#card-view').removeClass('d-none');
                    $('.card-elements').prop('required',true);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
        
                }
        
                if(val == 'authorize.net')
                {
                    $('#payment-form').prop('action','{{ route('api.invest.authorize.submit') }}');
                    $('#card-view').removeClass('d-none');
                    $('.card-elements').prop('required',true);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'paypal') {
                    $('#payment-form').prop('action','{{ route('api.invest.paypal.store') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'mollie') {
                    $('#payment-form').prop('action','{{ route('api.invest.molly.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'paystack') {
                    $('#payment-form').prop('action','{{ route('api.invest.paystack.submit') }}');
                    $('#payment-form').prop('class','step1-form');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'flutterwave') {
                    $('#payment-form').prop('action','{{ route('api.invest.flutter.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'coingate') {
                    $('#payment-form').prop('action','{{ route('api.invest.coingate.submit') }}');
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
                    $('#payment-form').prop('action','{{ route('api.invest.blockchain.submit') }}');
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
                    $('#payment-form').prop('action','{{ route('api.invest.coinpay.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'BlockIO(BTC)' || val == 'BlockIO(LTC)' || val == 'BlockIO(DGC)') {
                    $('#payment-form').prop('action','{{ route('api.invest.blockio.submit') }}');
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
                    $('#payment-form').prop('action','{{route('api.invest.coingate.submit')}}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'block.io.btc' || val == 'block.io.ltc' || val == 'block.io.dgc') {
                    $('#payment-form').prop('action','{{route('api.invest.blockio.submit')}}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'instamojo') {
                    $('#payment-form').prop('action','{{ route('api.invest.instamojo.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }

                if(val == 'paytm') {
                    $('#payment-form').prop('action','{{ route('api.invest.paytm.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'razorpay') {
                    $('#payment-form').prop('action','{{ route('api.invest.razorpay.submit') }}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'Manual'){
                    $('#payment-form').prop('action','{{route('api.invest.manual.submit')}}');
                    $('.manual-payment').removeClass('d-none');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',true);
                    const details = $(this).find(':selected').data('details');
                    $('.manual-payment-details').empty();
                    $('.manual-payment-details').append(`<font size="3">${details}</font>`)
                }
        
                if(val == 'Wallet'){
                    $('#payment-form').prop('action','{{route('api.invest.wallet.submit')}}');
                    $('#card-view').addClass('d-none');
                    $('.card-elements').prop('required',false);
                    $('#manual_transaction_id').prop('required',false);
                    $('.manual-payment').addClass('d-none');
                }
        
                if(val == 'parisi_bank') {
                    $('#payment-form').prop('action','{{ route('api.invest.parisi.submit') }}');
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
		@stack('js')
    </div>
</body>

</html>
