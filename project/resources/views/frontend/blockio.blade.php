@extends('layouts.front')

@push('css')
    
@endpush

@section('contents')
<section class="order-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="order-details-box">
                    <div class="header">
                        <h4 class="title">
                            {{ __('Enter Your Details') }}
                        </h4>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-lg-12">
                            <div class="content">
                                <div class="card">
                                    <img src="{{ Session::get('qrcode_url') }}" class="img-fluid img-thumbnail payinfo mt-4">
                                    <div class="card-body text-center">
                                      <h5 class="card-title">{{__('Address')}}: {{ Session::get('address') }}</h5>
                                      <p>{{__('Please send approximately')}} <b>{{ Session::get('amount') }}</b> {{ Session::get('coin') }} {{__('to this address. After completing your payment')}}, <b>{{ Session::get('currency_sign') }}{{ Session::get('currency_value') }}</b> {{__('invest will be deposited')}}. <br>{{__('This Process may take some time for confirmations. Thank you.')}}</p>
                                      <h4><a href="javascript:history.back();">{{__('Go Back')}}</a></h4>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


@includeIf('partials.front.footer_top')
@endsection

@push('js')
    
@endpush