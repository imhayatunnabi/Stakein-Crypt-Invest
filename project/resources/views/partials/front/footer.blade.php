<footer class="footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-5">
                    <div class="footer-widget about-widget">
                        <div class="footer-logo">
                            <a href="{{ route('front.index') }}">
                                <img src="{{ asset('assets/images/'.$gs->footer_logo) }}" alt="">
                            </a>
                        </div>
                        <div class="text mt-2">
                            <p>
                                {{ $gs->footer }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-3">
                    <h4>{{__('Help')}} &amp; {{__('Support')}}</h4>
                    <div class="menu">
                        <ul>
                            @foreach ($pages as $key=>$data)
                                <li><a href="{{route('front.page',$data->slug)}}">{{$data->title}}</a></li>
                            @endforeach
                            <li><a href="{{route('front.faq')}}">{{__('FAQ')}}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <h4>{{__('Contact Us')}} </h4>
                    <div class="contacts">
                        <div> <span>{{$ps->contact_email}}</span>
                        </div>
                        <div> <span>{{$ps->phone}}</span></div>
                        <div> <span>{{$ps->fax}}</span></div>
                        <div> <span>{{$ps->street}}</span></div>
                    </div>

                    <div class="social-footer">
                        <ul>
                            @if ($social->f_status)
                                <li><a href="{{$social->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            @endif

                            @if ($social->t_status)
                                <li><a href="{{$social->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            @endif

                            @if ($social->g_status)
                                <li><a href="{{$social->gplus}}" target="_blank"><i class="fa fa-google-plus"></i></a></li> 
                            @endif

                            @if ($social->l_status)
                                <li><a href="{{$social->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>   
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-center">
                        @php
                            echo $gs->copyright;
                        @endphp
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom Area Ends -->
</footer>