@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Edit WithDraw Method') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin-withdraw-method-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Manage Customers') }}</a></li>
	</ol>
	</div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-8">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Update WithDraw Method') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin-withdraw-method-update',$data->id)}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}

            <div class="form-group">
                <label for="inp-name">{{ __('WithDraw Method Name') }}</label>
                <input type="text" class="form-control" id="inp-name" name="method" placeholder="{{ __('Enter Name') }}" value="{{ $data->method }}" required>
            </div>

            <div class="form-group">
                <label for="inp-name">{{ __('Status') }}</label>
                <select class="form-control mb-3" name="status">
                  <option value="" selected>{{__('Select Status')}}</option>
                  <option value="1" {{ $data->status == 1 ? 'selected' : '' }} >{{__('Activated')}}</option>
                  <option value="0" {{ $data->status == 0 ? 'selected' : '' }} >{{__('Deactivated')}}</option>
                </select>
              </div>


            <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection
