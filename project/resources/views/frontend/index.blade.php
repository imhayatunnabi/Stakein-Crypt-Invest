@extends('layouts.front')

@push('css')

@endpush

@section('contents')
    <div id="main-slide" class="carousel slide w-100 carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key=>$slider)
                <div data-target="#main-slide" data-slide-to="{{$key}}" class="bg-parallax carousel-item item {{$loop->first ? 'active':''}}" style="background:url({{  $slider->photo ? asset('assets/images/'.$slider->photo):asset('assets/images/noimage.png') }} )">
                    <div class="slider-content">
                        <div class="container">
                            <div class="slider-text text-center">
                                <h3 class="slide-title">{{$slider->title_text}}</h3>
                                <h3 class="slide-title">{{$slider->subtitle_text}}</h3>
                                <p>
                                    <a href="{{$slider->link}}" class="slider btn btn-primary">{{__('Learn more')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#main-slide" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">{{__('Previous')}}</span>
        </a>
        <a class="carousel-control-next" href="#main-slide" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">{{__('Next')}}</span>
        </a>
    </div>

    <section class="features">
        <div class="container">
            <div class="row features-row">
                @foreach ($features as $key=>$data)
                    <div class="feature-box col-lg-4 col-md-12">
                        <span class="feature-icon">
                            <img src="{{asset('assets/images/'.$data->photo)}}" alt="download bitcoin">
                        </span>
                        <div class="feature-box-content">
                            <h3>{{$data->title}}</h3>
                            <p>{{$data->details}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <section class="about-us">
        <div class="container">
            <div class="text-center">
                <h2 class="title-head">{{__('About')}} <span>{{__('Us')}}</span></h2>
                <div class="title-head-subtitle">
                    <p>{{__('a commercial website that lists wallets, exchanges and other bitcoin related info')}}</p>
                </div>
            </div>
            <div class="row about-content">
                <div class="col-sm-12 col-md-5 col-lg-6 text-center">
                    <img class="img-fluid img-about-us" src="{{asset('assets/images/'.$ps->about_photo)}}" alt="about us">
                </div>
                <div class="col-sm-12 col-md-7 col-lg-6">
                    <h3 class="title-about">{{$ps->about_title}}</h3>
                    <p class="about-text">{{$ps->about_text}}</p>
                    <a class="btn btn-primary mt-4" href="{{$ps->about_link}}">{{__('Read More')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="image-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 ts-padding img-block-left">
                    @foreach ($services->chunk(2) as $servicechunks)
                        <div class="gap-20"></div>
                        <div class="row">
                            @foreach ($servicechunks as $data)
                                <div class="col-sm-6 col-md-6 col-xs-12">
                                    <div class="feature text-center">
                                        <span class="feature-icon">
                                            <img src="{{asset('assets/images/'.$data->photo)}}" alt="strong security"/>
                                        </span>
                                        <h3 class="feature-title">{{$data->title}}</h3>
                                        <p>
                                            @php
                                                echo $data->details;
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="gap-20-mobile"></div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4 ts-padding bg-image-1" style="background: url({{ $ps->service_photo ? asset('assets/images/'.$ps->service_photo):asset('assets/images/noimage.png') }});">
                    <div>
                        <div class="text-center">
                            <a class="button-video mfp-youtube" href="{{$ps->service_video}}"></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="pricing">
        <div class="container">
            <div class=" text-center">
                <h2 class="title-head">{{ __('affordable') }} <span>{{ __('packages') }}</span></h2>
                <div class="title-head-subtitle">
                    <p>{{ __('Purchase Bitcoin using a credit card or with your linked bank account')}}</p>
                </div>
            </div>

            <div class="row">
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

    <section class="blog">
        <div class="container">
            <div class="text-center">
                <h2 class="title-head">{{ __('Bitcoin') }} <span>{{ __('News') }}</span></h2>
                <div class="title-head-subtitle">
                    <p>{{ __('Discover latest news about Bitcoin on our blog')}}</p>
                </div>
            </div>

            <div class="row latest-posts-content">
                @foreach ($blogs->get() as $key=>$blog)
                <div class="col-md-4 col-lg-4 col-12">
                    <div class="latest-post">
                        <a href="{{route('blog.details',$blog->slug)}}"><img class="img-fluid" src="{{asset('assets/images/'.$blog->photo)}}" alt="img"></a>
                        <div class="post-body">
                            <h4 class="post-title">
                                <a href="{{route('blog.details',$blog->slug)}}">{{Str::limit($blog->title,50)}}</a>
                            </h4>
                            <div class="post-text">
                                <?php echo substr($blog->details,0,100) ?>
                            </div>
                        </div>
                        <div class="post-date">
                            <span>{{$blog->created_at->format('d')}}</span>
                            <span>{{$blog->created_at->format('M')}}</span>
                        </div>
                        <a href="{{route('blog.details',$blog->slug)}}" class="btn btn-primary">{{__('read more')}}</a>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Section Content Ends -->
        </div>
    </section>

@includeIf('partials.front.footer_top')
@endsection

@push('js')

@endpush
