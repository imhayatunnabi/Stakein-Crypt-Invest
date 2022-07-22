@extends('layouts.front')

@push('css')
    
@endpush

@section('contents')
		<section class="banner-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<div class="text-center">
							<div class="col-xs-12">
								<h2 class="title-head">{{__('Our')}} <span>{{__('Prices')}}</span></h2>
								<hr>
								<ul class="breadcrumbb">
									<li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
									<li>{{__('pricing')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="pricing">
            <div class="container">
				<h3 class="text-center">{{ __('Buy Bitcoins') }}</h3>
				<p class="text-center">{{ __('Buy bitcoins with your credit card or cash here! Register to Bayya and get your bitcoins today.') }}</p>
                <div class="row">
                    @if (count($plans) == 0)
                        <div class="card">
                            <div class="card-body">
                                <p>{{__('No Plan Found')}}</p>
                            </div>
                        </div>
                    @endif
                    @foreach($plans as $key=>$data)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-pricebox">
                                    <p class="plan-title">
                                        {{ $data->title }}
                                    </p>
                                    <div class="bonus">
                                        <i class="fas fa-dollar-sign"></i>
                                        <p class="persent">{{ $data->percentage }}%</p>
                                        <p class="time">{{ __('Payout ') }} {{ $data->days }} {{ __('day(s)') }} </p>
                                    </div>
                                    <div class="price-range-area">
                                        <div class="invest-count">
                                            <div class="left">
                                                {{ __('Minimum Invest') }} 
                                            </div>
                                            <div class="right">
                                                {{ $gs->currency_format == 0 ? $defaultCurrency->sign.$data->setPrice($data->min_price,$defaultCurrency->value) : $data->setPrice($data->min_price,$defaultCurrency->value) .$defaultCurrency->sign }}
                                            </div>
                                        </div>
                                        <div class="invest-range-slider">
                                            <div class="range-slider">
                                                <input class="range-slider__range" type="range" value="{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}" min="{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}" max="{{ $data->setPrice($data->max_price,$defaultCurrency->value) }}" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(253,150,26,1) 21%, rgba(9,9,121,1) 35%, rgba(8,25,131,1) 40%, rgba(0,212,255,1) 100%);">
                                            </div> 
                                        </div>
                                        <div class="invest-get">
                                            <div class="left">
                                                {{ __('Invest')}}  <br>
                                                <input type="hidden" value="{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}" class="invest-min-price" />
                                                <input type="hidden" value="{{ $data->setPrice($data->max_price,$defaultCurrency->value) }}" class="invest-max-price" />
                                                <input type="number" min="{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}" max="{{ $data->setPrice($data->max_price,$defaultCurrency->value) }}"  class="payprice" value="{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}">
                                                <span style="display:none;" class="range-slider__value ck">{{ $data->setPrice($data->min_price,$defaultCurrency->value) }}</span>
                                            </div>
                                            <input type="hidden" class="dbl" value="{{ $data->interest() }}">
                                            <div class="right">
                                                {{ __('Get') }}  <span class="dk">{{ round($data->setPrice($data->min_price,$defaultCurrency->value) * $data->interest()) }}</span>
                                                <input type="hidden" class="prodid" value="{{ $data->id }}">
                                                <input type="hidden" class="getprice" value="{{ round($data->setPrice($data->min_price,$defaultCurrency->value) * $data->interest()) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invest-button">
                                        @if (auth()->user())
                                            <a href="javascript:;" data-url="{{ route('front.setdata') }}" data-href="{{ route('front.checkout',$data->id) }}" class="mybtn1 checkout-btn btn btn-primary">{{ __('INVEST NOW') }} </a>
                                        @else 
                                            <a href="javascript:;" data-checkoutRoute="{{ route('front.checkout', $data->id) }}" data-url="{{ route('front.setdata') }}" data-href="{{ route('front.checkout',$data->id) }}" class="mybtn1 checkout-btn btn btn-primary">{{ __('INVEST NOW') }} </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
        
                    @endforeach
                </div>
            </div>
        </section>

    @includeIf('partials.front.footer_top')
@endsection

@push('js')
    
@endpush