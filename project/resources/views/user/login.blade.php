@extends('layouts.front')

@push('css')
    
@endpush

@section('contents')
<div class="container-fluid user-auth">
    <div class="hidden-xs col-sm-2 col-md-2 col-lg-2">

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-container">
            <div>
                <div class="text-center">
                <h2 class="title-head hidden-xs">{{__('member')}} <span>{{__('login')}}</span></h2>
                     <p class="info-form">{{__('Send, receive and securely store your coins in your wallet')}}</p>
                </div>
                <form id="loginform" action="{{ route('user.login.submit') }}" method="POST">
                    @includeIf('includes.admin.form-both')
                    @csrf
                    <div class="form-group">
                        <input class="form-control" name="email" id="email" placeholder="{{__('EMAIL')}}" type="email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" id="password" placeholder="{{__('PASSWORD')}}" type="password" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">{{__('login')}}</button>
                        <p class="text-center">{{__("don't have an account ?")}} <a href="{{route('user.register')}}">{{__('register now')}}</a>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center copyright-text">
            @php
                echo $gs->copyright;
            @endphp
        </p>
    </div>
</div>
@endsection

@push('js')
    
@endpush