<div class="top-header font-400  d-lg-block py-1 text-general">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="d-flex align-items-center text-general">
                    <i class="flaticon-phone-call flat-mini me-2 text-general"></i>
                    <span>{{$ps->phone}}</span>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-8">

                <ul class="top-links text-general ms-auto  d-flex justify-content-end">
                    <li class="my-account-dropdown">
                        <div class="language-selector">
                            <i class="fas fa-globe-americas"></i>
                            <select name="language" class="language selectors nice">
                                @foreach(DB::table('languages')->get() as $language)
                                <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                                    {{$language->language}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </li>

                    <li class="my-account-dropdown">
                        <div class="currency-selector">
                            <span>{{ Session::has('currency') ? DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
                            <select name="currency" class="currency selectors nice">
                                @foreach(DB::table('currencies')->get() as $currency)
                                <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                                    {{$currency->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="main-logo col-6 col-lg-2 col-md-6 col-xl-2 hidden-xsd-none d-sm-block">
            <a href="{{route('front.index')}}">
                <img class="img-responsive" src="{{asset('assets/images/'.$gs->logo)}}" alt="logo">
            </a>
        </div>
        <div class="col-6 col-lg-7 col-md-6 col-xl-7">
            <nav class="navbar navigation navbar-expand-lg new-nav " id="site-navigation">
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                  </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto text-center">

                    @foreach(json_decode($gs->menu,true) as $key => $menue)
                        <li><a href="{{ url($menue['href']) }}" target="{{ $menue['target'] == 'blank' ? '_blank' : '_self' }}">{{ $menue['title'] }}</a></li>
                    @endforeach

                    @if (count($pages) > 0)
                        <li class="dropdown">
                            <a href="#" class="" data-toggle="dropdown">{{__('pages')}} <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($pages as $key=>$data)
                                    <li><a href="{{route('front.page',$data->slug)}}">{{$data->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="search"><button class="fa fa-search"></button></li>
                    @endif
                  </ul>

                </div>
                <div class="site-search">
                    <div class="container">
                        <input type="text" placeholder="type your keyword and hit enter ...">
                        <span class="close">×</span>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 col-lg-3 col-md-12 col-xl-3">
            <ul class="unstyled user">
                @if (!auth()->user())
                    <li class="sign-in"><a href="{{route('user.login')}}" class="btn btn-primary"><i class="fa fa-user"></i> {{__('sign in')}}</a></li>
                    <li class="sign-up"><a href="{{route('user.register')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> {{__('register')}}</a></li>
                @else
                    <li class="sign-in"><a href="{{route('user.dashboard')}}" class="btn btn-primary"><i class="fa fa-user"></i> {{__('Dashboard')}}</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>



