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


	@stack('css')
</head>

<body>


    <div class="wrapper">

        <section class="dashbord-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    </div>

                    <section class="order-details">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="order-details-box">
                                        <div class="header">
                                            <h4 class="title">
                                                {{ __('Bitcoin Invest Information') }}
                                            </h4>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-lg-12">
                                                <div class="content">
                                                    <div class="card">
                                                        <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:{{ Session::get('address') }}?amount={{ Session::get('amount') }}" class="img-fluid img-thumbnail payinfo" alt="Responsive image">
                                                        <div class="card-body text-center">
                                                          <h5 class="card-title">{{__('Address')}}: {{ Session::get('address') }}</h5>
                                                          <p>{{__('Please send approximately')}} <b>{{ Session::get('amount') }}</b> {{ Session::get('coin') }} {{__('to this address. After completing your payment')}}, <b>{{ Session::get('currency_sign') }}{{ Session::get('currency_value') }}</b> {{__('invest will be deposited')}}. <br>{{__('This Process may take some time for confirmations. Thank you.')}}</p>
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

		@stack('js')
    </div>
</body>

</html>
