@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="d-sm-flex align-items-center justify-content-between">
    <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Top Service Section') }}</h5>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">{{ __('Home Page Settings') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.ps.topservice') }}">{{ __('Top Service Section') }}</a></li>
    </ol>
    </div>
</div>

<div class="row justify-content-center mt-3">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Top Service Section') }}</h6>
      </div>

      <div class="card-body">
        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
        <form class="geniusform" action="{{route('admin.ps.update')}}" method="POST" enctype="multipart/form-data">

            @include('includes.admin.form-both')

            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">{{ __('Youtube Video Link') }} *</label>
                <input type="text" class="form-control" id="title" name="service_video"  placeholder="{{ __('Youtube Video Link') }}" value="{{ $data->service_video }}" required>
            </div>

            <div class="form-group">
                <label>{{ __('Set Background Image') }} <small class="small-font">({{ __('Preferred Size 600 X 600') }})</small></label>
                <div class="wrapper-image-preview">
                    <div class="box full-width">
                        <div class="back-preview-image" style="background-image: url({{ $data->service_photo ? asset('assets/images/'.$data->service_photo) : asset('assets/images/placeholder.jpg') }});"></div>
                        <div class="upload-options">
                            <label class="img-upload-label full-width" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                            <input id="img-upload" type="file" class="image-upload" name="service_photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" id="submit-btn" class="btn btn-primary btn-block">{{ __('Submit') }}</button>

        </form>
      </div>
    </div>
  </div>

</div>
@endsection
