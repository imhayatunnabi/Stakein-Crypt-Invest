<!doctype html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <!-- favicon -->
  <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
    <!--     Fonts and icons   -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <!-- Material Kit CSS -->
    <link href="{{asset('assets/user/css/material-kit.css?v=2.0.5')}}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/jauery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/plugins.css') }}" rel="stylesheet" />
    <!-- Main Style CSS -->
    <link href="{{ asset('assets/user/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/user/css/responsive.css') }}" rel="stylesheet" />

    <!--Updated CSS-->
  <link rel="stylesheet" href="{{ asset('assets/user/css/styles.php?color='.str_replace('#','',$gs->colors)) }}">
    
    @yield('styles')
  </head>
  <body>

  <!-- Main Menu Area Start -->
  <nav class="main-menu navbar navbar-expand-lg bg-white">
      <div class="container">
        <div class="navbar-translate">
        <a class="navbar-brand" href="{{ route('front.index') }}">
          <img src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">{{__('Toggle navigation')}}</span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        </button>
      </div>
        <div class="collapse navbar-collapse" id="main-menu">
          <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.index') }}">{{ $langg->lang2 }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.blog') }}">{{ $langg->lang4 }}</a>
                </li>
                @if($gs->is_faq == 1)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.faq') }}">{{ $langg->lang5 }}</a>
                </li>
                @endif
                @if(DB::table('pages')->count() > 0)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $langg->lang6 }}
                  </a>
                  <ul class="dropdown-menu">
                    @foreach(DB::table('pages')->orderBy('id','desc')->get() as $data)
                    <li><a class="dropdown-item" href="{{ route('front.page',$data->slug) }}"> <i class="fa fa-angle-double-right"></i>{{ $data->title }}</a></li>
                    @endforeach
                  </ul>
                </li>
                @endif
                @if($gs->is_contact == 1)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('front.contact') }}">{{ $langg->lang7 }}</a>
                </li>
                @endif
          </ul> 
        </div>
      </div>
  </nav>
  <!-- Main Menu Area End -->

  <!-- Hero Area Start -->
  <div class="hero-area" style="background: url({{ asset('assets/images/'.$gs->breadcumb_banner) }});"></div>
  <!-- Hero Area End -->

  <!-- Profile Area Start -->
  <section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="profile-image-area">
            <div class="img">
              @if(Auth::user()->is_provider == 1)
                <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo):asset('assets/images/noimage.png') }}">
              @else 
                <img src="{{ Auth::user()->photo ? asset('assets/images/users/'.Auth::user()->photo):asset('assets/images/noimage.png') }}">
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

			</div>
		</div>
      </div>
    </div>
  </section>
  <!-- Profile Area End -->

  <!-- Dashbord-content Area Start -->
  <section class="dashbord-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if(Auth::user()->twofa)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title text-white">@lang('Two Factor Authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mx-auto text-center">
                                <a href="javascript:void(0)"  class="btn w-100 btn-md btn--danger" data-toggle="modal" data-target="#disableModal">
                                    @lang('Disable Two Factor Authenticator')</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title text-dark text-center">@lang('Two Factor Authenticator')</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mx-auto text-center">
                                <div class="input-group">
                                    <input type="text" name="key" value="{{$secret}}" class="form-control" id="referralURL" readonly>
                                    <button class="btn btn--secondary btn-sm copytext" id="copyBoard" onclick="myFunction()"> <i class="fa fa-copy"></i> </button>
                                </div>
                            </div>
                            <div class="form-group mx-auto text-center">
                                <img class="mx-auto" src="{{$qrCodeUrl}}">
                            </div>
                            <div class="form-group mx-auto text-center">
                                <a href="javascript:void(0)" class="btn btn--base btn-md mt-3 mb-1" data-toggle="modal" data-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                            </div> 

                            <div class="form-group mx-auto text-center">
                                <a class="btn btn--base btn-md mt-3" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('DOWNLOAD APP')</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
   
         <!--Enable Modal -->
        <div id="enableModal" class="modal fade" role="dialog">
            <div class="modal-dialog ">
                <!-- Modal content-->
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('Verify Your Otp')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{route('user-createTwoFactor')}}" method="POST">
                        @csrf
                        <div class="modal-body ">
                            <div class="form-group">
                                <input type="hidden" name="key" value="{{$secret}}">
                                <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('close')</button>
                            <button type="submit" class="btn btn-success">@lang('verify')</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!--Disable Modal -->
        <div id="disableModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">@lang('Verify Your Otp Disable')</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{route('user-disableTwoFactor')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn-success">@lang('Verify')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- Dashbord-content Area End -->

	<!-- Footer Area Start -->
<!-- Footer Area Start -->
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-4">
        <div class="footer-widget about-widget">
          <div class="footer-logo">
            <a href="{{ route('front.index') }}">
              <img src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
            </a>
          </div>
          <div class="text">
            <p>
              {{ $gs->footer }}
            </p>
          </div>
          
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="footer-widget address-widget">
          <h4 class="title">
            {{  $langg->lang49 }}
          </h4>
          <ul class="about-info">
            @if(App\Models\Pagesetting::find(1)->street != null)
            <li>
              <p>
                  <i class="fas fa-globe"></i>
                {{ App\Models\Pagesetting::find(1)->street }}
              </p>
            </li>
            @endif
            @if(App\Models\Pagesetting::find(1)->phone != null)
            <li>
              <p>
                  <i class="fas fa-phone"></i>
                  {{ App\Models\Pagesetting::find(1)->phone }}
              </p>
            </li>
            @endif
            @if(App\Models\Pagesetting::find(1)->email != null)
            <li>
              <p>
                  <i class="far fa-envelope"></i>
                  {{ App\Models\Pagesetting::find(1)->email }}
              </p>
            </li>
            @endif
          </ul>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
          <div class="footer-widget  footer-newsletter-widget">
            <h4 class="title">
              {{  $langg->lang50 }}
            </h4>
            <div class="newsletter-form-area">
              <form id="subscribeform" action="{{ route('front.subscribe') }}" method="POST">
                {{ csrf_field() }}
                <input type="email" id="subemail" name="email" required="" placeholder="{{ $langg->lang51 }}">
                <button class="btn" id="sub-btn" type="submit">
                  <i class="far fa-paper-plane"></i>
                </button>
              </form>
            </div>
            <div class="social-links">
              <h4 class="title">
                  {{  $langg->lang52 }}:
              </h4>
              <div class="fotter-social-links">
                <ul>
                    @if(App\Models\Socialsetting::find(1)->f_status == 1)
                    <li>
                      <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">
                          <i class="fab fa-facebook-f"></i>
                      </a>
                    </li>
                    @endif

                    @if(App\Models\Socialsetting::find(1)->g_status == 1)
                    <li>
                      <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">
                          <i class="fab fa-google-plus-g"></i>
                      </a>
                    </li>
                    @endif

                    @if(App\Models\Socialsetting::find(1)->t_status == 1)
                    <li>
                      <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">
                          <i class="fab fa-twitter"></i>
                      </a>
                    </li>
                    @endif

                    @if(App\Models\Socialsetting::find(1)->l_status == 1)
                    <li>
                      <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">
                          <i class="fab fa-linkedin-in"></i>
                      </a>
                    </li>
                    @endif
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="copy-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
              <div class="content">
                <p>
                  @php
                     echo $gs->copyright;
                  @endphp
                </p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var mainurl = "{{url('/')}}";
  var gs      = @php echo json_encode($gs);  @endphp
</script>

<script src="{{ asset('assets/user/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/plugins/jquery-ui.min.js') }}" type="text/javascript"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('assets/user/js/material-kit.js?v=2.0.5') }}" type="text/javascript"></script></body>
<script src="{{ asset('assets/front/js/notify.js') }}"></script>
<script src="{{ asset('assets/user/js/plugins.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/user/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/front/js/custom.js') }}" type="text/javascript"></script>

<script>
    "use strict";
    function myFunction() {
        var copyText = document.getElementById("referralURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);

        document.execCommand("copy");
        alert('copied');
    }
</script>

<script src="{{asset('assets/user/js/sweetalert2@9.js')}}"></script>

@if($errors->any())
    @foreach ($errors->all() as $error)
        <script>
          "use strict";
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
            Toast.fire({
            icon: 'error',
            title: '{{ $error }}'
            })
        </script>
    @endforeach
@endif


@if(Session::has('success'))
  <script>
    "use strict";
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
})
Toast.fire({
  icon: 'success',
  title: '{{Session::get('success')}}'
})
  </script>
@endif

</body>
</html>
