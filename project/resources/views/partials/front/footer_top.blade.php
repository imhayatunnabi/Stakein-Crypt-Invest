<section class="call-action-all" style="background: url({{ $ps->footer_top_photo ? asset('assets/images/'.$ps->footer_top_photo):asset('assets/images/noimage.png') }});">
    <div class="call-action-all-overlay">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 mx-auto">
                    <div class="action-text">
                        <h2>{{$ps->footer_top_title}}</h2>
                        <p class="lead">{{$ps->footer_top_text}}</p>
                    </div>
                    <p class="action-btn"><a class="btn btn-primary" href="{{route('user.register')}}">{{__('Register Now')}}</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
