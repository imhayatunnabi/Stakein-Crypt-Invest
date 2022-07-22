@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="d-sm-flex align-items-center justify-content-between">
  <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Plan') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.plan.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.plan.index')}}">{{ __('Plan') }}</a></li>
      <li class="breadcrumb-item"><a href="{{route('admin.plan.create')}}">{{ __('Add New Plan') }}</a></li>
  </ol>
  </div>
</div>

<div class="row justify-content-center mt-3">
<div class="col-lg-6">
  <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Plan Form') }}</h6>
    </div>

    <div class="card-body">
      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
      <form class="geniusform" action="{{route('admin.plan.store')}}" method="POST" enctype="multipart/form-data">

          @include('includes.admin.form-both')

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('Enter Title') }}" value="" required>
          </div>

          <div class="form-group">
            <label for="subtitle">{{ __('Sub Title') }}</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="{{ __('Enter Sub Title') }}" value="" required>
          </div>

          <div class="form-group">
            <label for="min_price">{{ __('Minimum Price in') }} ({{$currency->name}})</label>
            <input type="number" class="form-control" id="min_price" name="min_price" placeholder="{{ __('Enter Minimum Price') }}" min="1" value="" required>
          </div>

          <div class="form-group">
            <label for="max_price">{{ __('Maximum Price in') }} ({{$currency->name}})</label>
            <input type="number" class="form-control" id="max_price" name="max_price" placeholder="{{ __('Enter Maximum Price') }}" min="1" value="" required>
          </div>

          <div class="form-group">
            <label for="days">{{ __('Days') }}</label>
            <input type="number" class="form-control" id="days" name="days" placeholder="{{ __('Enter Days') }}" min="1" value="" required>
          </div>

          <div class="form-group">
            <label for="percentage">{{ __('Payout Rate') }}</label>
            <input type="number" class="form-control" id="percentage" name="percentage" placeholder="{{ __('Payout Rate should be greater than hundreed') }}" min="1" value="" required>
          </div>


          <button type="submit" id="submit-btn" class="btn btn-primary">{{ __('Submit') }}</button>

      </form>
    </div>
  </div>
</div>

</div>

@endsection

@section('scripts')


@endsection
