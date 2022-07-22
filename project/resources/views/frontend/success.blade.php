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
                        <h2 class="title-head"><span>{{__('Success')}}</span></h2>
                        <hr>

                        <ul class="breadcrumbb">
                            <li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
                            <li>{{__('success')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="thankyou">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10 offset-lg-3  mx-auto">
          <div class="card shadow-lg p-3 bg-dark ">

              <div class="card-body text-center">

                    <h4 class="heading success-heading">
                        <i class="fa fa-check-circle"></i> {{__('THANK YOU FOR YOUR INVEST.')}}
                    </h4>
                    <p class="text success-heading">
                         {{__("We'll email you an order confirmation with details and tracking info.")}}
                    </p>
                    <a href="{{route('front.index')}}" class="link">{{__('Get Back To Our Homepage')}}</a>

              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('js')

@endpush
