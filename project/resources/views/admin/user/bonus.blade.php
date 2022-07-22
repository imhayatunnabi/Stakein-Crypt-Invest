@extends('layouts.admin')

@section('content')


<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Register Bonus') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Users') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.bonus') }}">{{ __('Refferel Bonus') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('Refferel Bonus') }}</h6>
        </div>

        <div class="card-body">
          <form class="geniusform" action="{{ route('admin.gs.update') }}" method="POST" enctype="multipart/form-data">

              @include('includes.admin.form-both')
              {{ csrf_field() }}

              <div class="form-group">
                <label for="inp-title">{{  __('Refferel Service')  }}</label>
                  <div class="frm-btn btn-group mb-1">
                    <button type="button" class="btn btn-sm btn-rounded dropdown-toggle btn-{{ $gs->is_affilate == 1 ? 'success' : 'danger' }}" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      {{ $gs->is_affilate == 1 ? __('Activated') : __('Deactivated')}}
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="1" data-val="{{ __('Activated') }}" data-href="{{ route('admin.gs.status',['is_affilate',1]) }}">{{ __('Activate') }}</a>
                      <a class="dropdown-item drop-change" href="javascript:;" data-status="0" data-val="{{ __('Deactivated') }}" data-href="{{ route('admin.gs.status',['is_affilate',0]) }}">{{ __('Deactivate') }}</a>
                    </div>
                  </div>
              </div>

              <div class="form-group">
                <label>{{ __('Refferel Banner') }} <small class="small-font">({{ __('Maximum size is 2 MB.') }})</small></label>
                <div class="wrapper-image-preview">
                    <div class="box">
                        <div class="back-preview-image" style="background-image: url({{ $gs->affilate_banner ? asset('assets/images/'.$gs->affilate_banner) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload" type="file" class="image-upload" name="affilate_banner" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

              <div class="form-group">
                <label for="affilate_charge">{{ __('Referral Invest Bonus(%)') }}</label>
                <input type="number" class="form-control" id="affilate_charge"  placeholder="{{ __('Referral Invest Bonus') }}" name="affilate_charge" value="{{ $gs->affilate_charge }}" required="" min="0" step="0.1">
              </div>

              <div class="form-group">
                <label for="affilate_new_user">{{ __('Referral New User Bonus') }}</label>
                <input type="number" class="form-control" id="affilate_new_user"  placeholder="{{ __('Referral New User Bonus') }}" name="affilate_new_user" value="{{ $gs->affilate_new_user }}" required="" min="0" step="0.1">
              </div>

              <div class="form-group">
                <label for="affilate_user">{{ __('Referral User Bonus') }}</label>
                <input type="number" class="form-control" id="affilate_user"  placeholder="{{ __('Referral User Bonus') }}" name="affilate_user" value="{{ $gs->affilate_user }}" required="" min="0" step="0.1">
              </div>


              <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Update') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->

@endsection
