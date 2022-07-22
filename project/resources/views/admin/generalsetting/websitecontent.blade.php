@extends('layouts.admin')

@section('content')


<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Website Contents') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('General Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.gs.contents') }}">{{ __('Website Contents') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Website Contents Form') }}</h6>
        </div>

        <div class="card-body">
          <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
          <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

              @include('includes.admin.form-both')

              {{ csrf_field() }}

            <div class="form-group">
              <label for="inp-title">{{  __('Login Email Verification')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_verification_email == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->is_verification_email == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_verification_email',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_verification_email',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('Wallet Checkout')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->isWallet == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->isWallet == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['isWallet',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['isWallet',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('Withdraw')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->withdraw_status == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->withdraw_status == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['withdraw_status',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['withdraw_status',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('Balance Transfer(User to user)')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->balance_transfer == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->balance_transfer == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['balance_transfer',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['balance_transfer',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('KYC')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->kyc == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->kyc == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['kyc',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['kyc',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('Two Factor Authentication')  }}</label>
              <div class="frm-btn btn-group mb-1">
                  <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->two_factor == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $gs->two_factor == 1 ? __('Activated') : __('Deactivated')}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['two_factor',1]) }}">{{ __('Activate') }}</a>
                    <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['two_factor',0]) }}">{{ __('Deactivate') }}</a>
                  </div>
                </div>
            </div>


            <div class="form-group">
              <label for="inp-title">{{  __('Disqus')  }}</label>
              <div class="frm-btn btn-group mb-1">
                <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_disqus == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ $gs->is_disqus == 1 ? __('Activated') : __('Deactivated')}}
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_disqus',1]) }}">{{ __('Activate') }}</a>
                  <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_disqus',0]) }}">{{ __('Deactivate') }}</a>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inp-disqus">{{  __('Disqus Website Short Name')  }}</label>
              <input type="text" class="form-control" id="inp-disqus" name="disqus"  placeholder="{{ __('Disqus Website Short Name') }}" value="{{ $gs->disqus }}" required>
            </div>

            <div class="form-group">
              <label for="inp-title">{{  __('Website Title')  }}</label>
              <input type="text" class="form-control" id="inp-title" name="title"  placeholder="{{ __('Enter Website Title') }}" value="{{ $gs->title }}" required>
            </div>

            <div class="form-group">
              <label for="cp3">{{  __('Website Color')  }}</label>
              <div class="cp-container" id="cp3-container">
                <div class="input-group" title="Using input value">
                    <input  type="color" name="colors"  class="form-control"  value="{{ $gs->colors }}" id="exampleInputPassword1">
                
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="copyright-text">{{  __('Copyright Text')  }}</label>
              <textarea name="copyright" class="form-control" id="copyright-text" cols="30" rows="10">{{ $gs->copyright }}</textarea>
            </div>


              <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>

          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
