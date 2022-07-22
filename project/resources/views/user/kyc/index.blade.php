@extends('layouts.user')

@section('styles')

@endsection

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{__('KYC Form')}}
              </h3>
            </div>
            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form id="userform" class="px-4" action="{{route('user.kyc.submit')}}">


                {{ csrf_field() }}
                @include('includes.admin.form-both')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group bmd-form-group">
                            <input type="text" class="form-control" id="details" name="details" value="{{auth()->user()->details}}" required="">
                            <span class="bmd-help">@lang('Give Your info')</span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-round">{{ __('Submit') }}</button>
                    </div>
                </div>
            </form>
          </div>
        </div>

@endsection

@push('js')

@endpush
