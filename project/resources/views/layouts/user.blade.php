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
    <div id="preloader">
        <div id="preloader-content">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="150px" height="150px" viewBox="100 100 400 400" xml:space="preserve">
                <filter id="dropshadow" height="130%">
                <feGaussianBlur in="SourceAlpha" stdDeviation="5"/>
                <feOffset dx="0" dy="0" result="offsetblur"/>
                <feFlood flood-color="red"/>
                <feComposite in2="offsetblur" operator="in"/>
                <feMerge>
                <feMergeNode/>
                <feMergeNode in="SourceGraphic"/>
                </feMerge>
                </filter>
                <path class="path" fill="#000000" d="M446.089,261.45c6.135-41.001-25.084-63.033-67.769-77.735l13.844-55.532l-33.801-8.424l-13.48,54.068
                    c-8.896-2.217-18.015-4.304-27.091-6.371l13.568-54.429l-33.776-8.424l-13.861,55.521c-7.354-1.676-14.575-3.328-21.587-5.073
                    l0.034-0.171l-46.617-11.64l-8.993,36.102c0,0,25.08,5.746,24.549,6.105c13.689,3.42,16.159,12.478,15.75,19.658L208.93,357.23
                    c-1.675,4.158-5.925,10.401-15.494,8.031c0.338,0.485-24.579-6.134-24.579-6.134l-9.631,40.468l36.843,9.188
                    c8.178,2.051,16.209,4.19,24.098,6.217l-13.978,56.17l33.764,8.424l13.852-55.571c9.235,2.499,18.186,4.813,26.948,6.995
                    l-13.802,55.309l33.801,8.424l13.994-56.061c57.648,10.902,100.998,6.502,119.237-45.627c14.705-41.979-0.731-66.193-31.06-81.984
                    C425.008,305.984,441.655,291.455,446.089,261.45z M368.859,369.754c-10.455,41.983-81.128,19.285-104.052,13.589l18.562-74.404
                    C306.28,314.65,379.774,325.975,368.859,369.754z M379.302,260.846c-9.527,38.187-68.358,18.781-87.442,14.023l16.828-67.489
                    C327.767,212.14,389.234,221.02,379.302,260.846z"/>
            </svg>
        </div>
    </div>

    <div class="wrapper">

        <header class="header">
            @includeIf('partials.front.navbar')
        </header>

        <div class="hero-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});""></div>

        <section class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="profile-image-area">
                            <div class="img">
                                @if(Auth::user()->is_provider == 1)
                                    <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}">
                                @else
                                    <img src="{{asset('assets/images/'.auth()->user()->photo)}}">
                                @endif

                            </div>
                            <div class="content">
                                <h4 class="name">
                                    {{ Auth::user()->name }}
                                </h4>
                                <p class="location">
                                    <i class="material-icons">
                                        location_on
                                    </i> {{ Auth::user()->address }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="open-tikit-area">
                            <div class="open-tikit">
                                <a href="{{ route('user-profile') }}">
                                    <img src="https://royalscripts.com/product/crypto/assets/user/img/ticket-icon.png" alt="">
                                </a>
                                <i class="material-icons">
                                        add
                                        </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashbord-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="aside-area">
                            <div class="main-menu">
                            <ul class="nav">
                                <li class="nav-item user-item">
                                    <a href="{{ route('user.dashboard') }}" class="nav-link"><i class="material-icons">home</i>{{ __('Dashboard') }}</a>
                                </li>

                                <li class="nav-item user-item">
                                    <a href="{{ route('user.deposit.index') }}" class="nav-link"><i class="material-icons">deblur</i>{{ ('Deposit') }}</a>
                                </li>

                                @if ($gs->balance_transfer)
                                <li class="nav-item user-item">
                                    <a href="{{ route('balance.transfer.index') }}" class="nav-link"><i class="material-icons">flight_land</i>{{ __('Balance Transfer') }}</a>
                                </li>
                                @endif

                                <li class="nav-item user-item">
                                <a href="{{ route('user-invests') }}" class="nav-link"><i class="material-icons">list</i>{{ __('Invests') }}</a>
                                </li>

                                <li class="nav-item user-item">
                                <a href="{{ route('user-payouts') }}" class="nav-link"><i class="material-icons">collections_bookmark</i>{{ __('Payouts') }}</a>
                                </li>

                                <li class="nav-item user-item">
                                <a href="{{ route('user-wwt-index') }}" class="nav-link"><i class="material-icons">monetization_on</i>{{ __('Withdraw') }}</a>
                                </li>
                                <li class="nav-item user-item">
                                <a href="{{ route('user-trans') }}" class="nav-link"><i class="material-icons">card_travel</i>{{ __('Transactions') }}</a>
                                </li>
                                <li class="nav-item user-item">
                                    <a href="{{ route('user-ranks') }}" class="nav-link"><i class="material-icons">card_travel</i>{{ __('Rank') }}</a>
                                    </li>
                                <li class="nav-item user-item">
                                <a href="{{route('user.plan')}}" class="nav-link"><i class="material-icons">payment</i>{{ __('Invest Now') }}</a>
                                </li>

                                @if ($gs->is_affilate)
                                    <li class="nav-item user-item">
                                        <a href="{{ route('user-affilate-code') }}" class="nav-link"><i class="material-icons">account_balance</i>{{ __('Referrals') }}</a>

                                        <span class="toggler ml-auto text-white">
                                        </span>
                                            <div class="mega-menu-area">
                                                <div class="mega-menu-item">
                                                    <h6 class="title">@lang('Referrals')</h6>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('user.referral.index') }}">@lang('Referred Users')</a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('user.referral.commissions') }}">@lang('Referral Commissions')</a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('user-affilate-code') }}">@lang('Referral Code')</a>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </div>
                                    </li>
                                @endif

                                @if ($gs->two_factor)
                                <li class="nav-item user-item">
                                    <a href="{{ route('user-show2faForm') }}" class="nav-link"><i class="material-icons">rocket_launch</i>@lang('2Fa Authentication')</a>
                                </li>
                                @endif

                                <li class="nav-item user-item">
                                <a href="{{ route('user-profile') }}" class="nav-link"><i class="material-icons">person</i>{{ __('Edit Profile') }}</a>
                                </li>

                                <li class="nav-item user-item">
                                <a href="{{ route('user-message-index') }}" class="nav-link"><i class="material-icons">send</i>@lang('Support Ticket')</a>
                                </li>

                                @if ($gs->kyc)
                                <li class="nav-item user-item">
                                    <a href="{{ route('user.kyc.form') }}" class="nav-link"><i class="material-icons">switch_access_shortcut</i>@lang('KYC')</a>
                                </li>
                                @endif

                                <li class="nav-item user-item">
                                <a href="{{ route('user-reset') }}" class="nav-link"><i class="material-icons">vpn_key</i>{{ __('Change Password') }}</a>
                                </li>

                                <li class="nav-item">
                                <a href="{{ route('user-logout') }}" class="nav-link"><i class="material-icons">logout</i>{{ __('Logout') }}</a>
                                </li>
                            </ul>

                            </div>


                        </div>
                    </div>

                    @yield('content')

                </div>
            </div>
        </section>


        @includeIf('partials.front.footer')

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
