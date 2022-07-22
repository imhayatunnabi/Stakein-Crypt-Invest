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
                                    <h2 class="title-head">{{__('Get in')}} <span>{{__('touch')}}</span></h2>
                                    <hr>
                                    <ul class="breadcrumbb">
                                        <li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
                                        <li>{{__('contact')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-7 col-sm-12 contact-form">
                            <h3 class="col-xs-12">{{$ps->side_title}}</h3>
                            <p class="col-xs-12">{{$ps->side_text}}</p>

                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                            <form class="form-contact" method="post" action="{{route('front.contact.submit')}}" id="contactform">
                                @csrf
                                @include('includes.admin.form-both')
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input class="form-control" name="firstname" id="firstname" placeholder="{{__('FIRST NAME')}}" type="text" required>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <input class="form-control" name="lastname" id="lastname" placeholder="{{__('LAST NAME')}}" type="text" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input class="form-control" name="email" id="email" placeholder="{{__('EMAIL')}}" type="email" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input class="form-control" name="subject" id="subject" placeholder="{{__('SUBJECT')}}" type="text" required>
                                    </div>
                                </div>


                                <div class="form-group col-xs-12">
                                    <textarea class="form-control" id="message" name="message" placeholder="{{__('MESSAGE')}}" required></textarea>
                                </div>


                                <div class="form-group col-xs-12 col-sm-4">
                                    <button class="btn btn-primary btn-contact" type="submit">{{__('send message')}}</button>
                                </div>
                                <input type="hidden" name="to" value="{{ $ps->contact_email }}">

                            </form>

                        </div>

                        <div class="col-xs-12 col-md-5 col-sm-12">
                            <div class="widget">
                                <div class="contact-page-info">
                                    <div class="contact-info-box">
                                        <i class="fa fa-home big-icon"></i>
                                        <div class="contact-info-box-content">
                                            <h4>{{__('Address')}}</h4>
                                            <p>{{$ps->street}}</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-box">
                                        <i class="fa fa-phone big-icon"></i>
                                        <div class="contact-info-box-content">
                                            <h4>{{__('Phone Numbers')}}</h4>
                                            <p>{{$ps->phone}}<br>{{$ps->fax}}</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-box">
                                        <i class="fa fa-envelope big-icon"></i>
                                        <div class="contact-info-box-content">
                                            <h4>{{__('Email Addresses')}}</h4>

                                            <p>{{$ps->email}}</p>
                                        </div>
                                    </div>

                                    <div class="contact-info-box">
                                        <i class="fa fa-share-alt big-icon"></i>
                                        <div class="contact-info-box-content">
                                            <h4>{{__('Social Profiles')}}</h4>
                                            <div class="social-contact">
                                                <ul>
                                                    @if ($social->f_status == 1)
                                                        <li class="facebook"><a href="{{$social->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                    @endif

                                                    @if ($social->g_status == 1)
                                                        <li class="google-plus"><a href="{{$social->gplus}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                    @endif

                                                    @if ($social->t_status == 1)
                                                        <li class="twitter"><a href="{{$social->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                    @endif

                                                    @if ($social->l_status == 1)
                                                        <li class="linkedin"><a href="{{$social->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                                    @endif

                                                    @if ($social->d_status == 1)
                                                        <li class="dribble"><a href="{{$social->dribble}}" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                                    @endif
                                                </ul>
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
