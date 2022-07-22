@extends('layouts.user')

@section('styles')
<link href="{{ asset('assets/user/css/pricing.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{__('Choose Your Plan')}}
              </h3>
            </div>
            <div class="content">
            <section class="pricing">
                <div class="container">
                    <div class="row">
                        @foreach($products as $prod)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-pricebox">
                                    <p class="plan-title">
                                        {{ $prod->title }}
                                    </p>
                                    <div class="bonus">
                                        <i class="fas fa-dollar-sign"></i>
                                        <p class="persent">{{ $prod->percentage }}%</p>
                                        <p class="time">{{ __('Payout ') }} {{ $prod->days }} {{ __('day(s)') }}</p>
                                    </div>
                                    <div class="price-range-area">
                                        <div class="invest-count">
                                            <div class="left">
                                                {{ __('Minimum Invest') }}
                                            </div>
                                            <div class="right">
                                                {{ $gs->currency_format == 0 ? $defaultCurrency->sign.$prod->setPrice($prod->min_price,$defaultCurrency->value) : $prod->setPrice($prod->min_price,$defaultCurrency->value) .$defaultCurrency->sign }}
                                            </div>
                                        </div>
                                        <div class="invest-range-slider">
                                            <div class="range-slider">
                                                <input class="range-slider__range" type="range" value="{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}" min="{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}" max="{{ $prod->setPrice($prod->max_price,$defaultCurrency->value) }}" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(253,150,26,1) 21%, rgba(9,9,121,1) 35%, rgba(8,25,131,1) 40%, rgba(0,212,255,1) 100%);">
                                            </div>
                                        </div>
                                        <div class="invest-get">
                                            <div class="left">
                                                {{ __('Invest')}}  <br>
                                                <input type="hidden" value="{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}" class="invest-min-price" />
                                                <input type="hidden" value="{{ $prod->setPrice($prod->max_price,$defaultCurrency->value) }}" class="invest-max-price" />
                                                <input type="number" min="{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}" max="{{ $prod->setPrice($prod->max_price,$defaultCurrency->value) }}"  class="payprice" value="{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}">
                                                <span style="display:none;" class="range-slider__value ck">{{ $prod->setPrice($prod->min_price,$defaultCurrency->value) }}</span>
                                            </div>
                                            <input type="hidden" class="dbl" value="{{ $prod->interest() }}">
                                            <div class="right">
                                                {{ __('Get') }}  <span class="dk">{{ round($prod->setPrice($prod->min_price,$defaultCurrency->value) * $prod->interest()) }}</span>
                                                <input type="hidden" class="prodid" value="{{ $prod->id }}">
                                                <input type="hidden" class="getprice" value="{{ round($prod->setPrice($prod->min_price,$defaultCurrency->value) * $prod->interest()) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invest-button">
                                        <a href="javascript:;" data-url="{{ route('front.setdata') }}" data-href="{{ route('front.checkout',$prod->id) }}" class="mybtn1 checkout-btn btn btn-primary">{{ __('INVEST NOW') }} </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            </div>
          </div>
        </div>

@endsection

@push('js')
@endpush
