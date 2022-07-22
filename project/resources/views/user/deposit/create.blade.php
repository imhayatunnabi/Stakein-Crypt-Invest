@extends('layouts.user')


@section('content')



        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Deposit Now') }} <a href="{{route('user-wwt-index')}}" class="btn btn-primary btn-round ml-2">{{ __('Back') }}</a>
              </h3>
            </div>

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>
                        @php
                           echo \Session::get('success');
                        @endphp
                    </p>
                </div>
            @endif

            @if (\Session::has('unsuccess'))
                <div class="alert alert-warning">
                    <p>
                        @php
                        echo \Session::get('unsuccess');
                        @endphp
                    </p>
                </div>
            @endif


                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                    <form id="deposit-form" class="form-horizontal px-4" action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
    
                       @include('includes.admin.form-both') 
    
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <select name="method" id="withmethod" class="form-control" required>
                                    <option value="">{{ __('Select Payment Method') }}</option>
                                    @foreach ($gateways as $gateway)
                                        @if (in_array($gateway->keyword,$availableGatways))
                                            @if ($gateway->type == 'manual')
                                                <option value="Manual" data-details="{{$gateway->details}}">{{ $gateway->title }}</option>
                                            @else
                                                <option value="{{$gateway->keyword}}">{{ $gateway->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach                   
                                </select>
                            </div>
                        </div>

                        <div id="card-view" class="col-lg-12 pt-3 d-none">
                            <div class="row">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="lc" value="UK">
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest">

                                <div class="col-lg-6">
                                    <input type="text" class="form-control card-elements" name="cardNumber" placeholder="{{ __('Card Number') }}" autocomplete="off" required autofocus oninput="validateCard(this.value);"/>
                                    <span id="errCard"></span>
                                </div>

                                <div class="col-lg-6 cardRow">
                                    <input type="text" class="form-control card-elements" placeholder="{{ ('Card CVC') }}" name="cardCVC" oninput="validateCVC(this.value);">
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

                        <input type="hidden" name="currency_sign" value="{{ $defaultCurrency->sign }}">
                        <input type="hidden" id="currencyCode" name="currency_code" value="{{ $defaultCurrency->name }}">
                        <input type="hidden" name="currency_id" value="{{ $defaultCurrency->id }}">
    
                        <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <label for="amount" class="bmd-label-floating">{{ __('Deposit Amount') }}*</label>
                                <input name="amount" id="amount" class="form-control" autocomplete="off"  type="number" value="{{ old('amount') }}" min="1" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <textarea name="details" class="form-control nic-edit" cols="30" rows="10" placeholder="{{__('More Informations?')}}"></textarea>
                            </div>
                        </div>
    
    
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-round">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </form>
          </div>
        </div>

@endsection

@push('js')

<script src="https://js.paystack.co/v1/inline.js"></script>


<script type="text/javascript">
'use strict';

$(document).on('change','#withmethod',function(){
	var val = $(this).val();

	if(val == 'stripe')
	{
		$('#deposit-form').prop('action','{{ route('deposit.stripe.submit') }}');
		$('#card-view').removeClass('d-none');
		$('.card-elements').prop('required',true);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
	}

    if(val == 'flutterwave')
	{
		$('#deposit-form').prop('action','{{ route('deposit.flutter.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
	}

    if(val == 'authorize.net')
	{
		$('#deposit-form').prop('action','{{ route('deposit.authorize.submit') }}');
		$('#card-view').removeClass('d-none');
		$('.card-elements').prop('required',true);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
	}

    if(val == 'paypal') {
        $('#deposit-form').prop('action','{{ route('deposit.paypal.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'mollie') {
        $('#deposit-form').prop('action','{{ route('deposit.molly.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }


	if(val == 'paytm') {
        $('#deposit-form').prop('action','{{ route('deposit.paytm.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);

        $('.manual-payment').addClass('d-none');
    }

    if(val == 'paystack') {
        $('#deposit-form').prop('action','{{ route('deposit.paystack.submit') }}');
        $('#deposit-form').prop('class','step1-form');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'instamojo') {
        $('#deposit-form').prop('action','{{ route('deposit.instamojo.submit') }}');
        $('#card-view').addClass('d-none');
        $('.card-elements').prop('required',false);
        $('#manual_transaction_id').prop('required',false);
        $('.manual-payment').addClass('d-none');
    }

    if(val == 'razorpay') {
        $('#deposit-form').prop('action','{{ route('deposit.razorpay.submit') }}');
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
<script src="//voguepay.com/js/voguepay.js"></script>

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


  <script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>


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


@endpush