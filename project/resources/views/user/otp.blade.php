@extends('layouts.front')

@section('contents')
<section class="banner-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
  <div class="banner-overlay">
    <div class="banner-text text-center">
      <div class="container">
        <div class="text-center">
          <div class="col-xs-12">
            <h2 class="title-head">{{__('OTP')}} <span></span></h2>
            <hr>
            <ul class="breadcrumbb">
              <li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
              <li>{{__('OTP')}}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- login-signup Area Start -->
<section class="login-signup">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="login-area signup-area">  
                <div class="login-form signup-form">
                  <form action="{{ route('user.otp.submit') }}" method="POST">
                    @include('includes.admin.form-login')
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-input">
                          <input type="text" class="form-control" name="otp" placeholder="@lang('Type Your otp')" required="">
                        </div>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                      <button type="submit" class="submit-btn btn btn-primary mt-4">@lang('Submit')</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>

<!-- login-signup Area Ends -->
@endsection

@section('scripts')

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
@endsection