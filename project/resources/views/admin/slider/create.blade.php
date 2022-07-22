@extends('layouts.admin')
@section('content')
<div class="card">
   <div class="d-sm-flex align-items-center justify-content-between">
      <h5 class=" mb-0 text-gray-800 pl-3">{{ __('Add New Slider') }} <a class="btn btn-primary btn-rounded btn-sm" href="{{route('admin.slider.index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h5>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
         <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">{{ __('Manage Sliders') }}</a></li>
         <li class="breadcrumb-item"><a href="{{ route('admin.slider.create') }}">{{ __('Add New Slider') }}</a></li>
      </ol>
   </div>
</div>
<div class="row justify-content-center mt-3">
   <div class="col-lg-8">
      <!-- Form Basic -->
      <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Add New Slider Form') }}</h6>
         </div>
         <div class="card-body">
            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
            <form action="{{route('admin.slider.store')}}" enctype="multipart/form-data" method="POST" class="geniusform">
               @csrf

               @include('includes.admin.form-both')

               <div class="form-group">
                  <label for="title">{{ __('Title') }}</label>
                  <input type="text" class="form-control" id="title" name="title_text" placeholder="{{ __('Enter Title') }}" value="" required>
               </div>

              <div class="form-group">
                  <label for="subtitle_text">{{ __('Sub Title') }}</label>
                  <input type="text" class="form-control" id="subtitle_text" name="subtitle_text" placeholder="{{ __('Enter Sub Title') }}" value="" required>
               </div>

               <div class="row">
                  <div class="col-lg-6 mx-auto">
                     <div class="form-group">
                        <label>{{ __('Set Picture') }} <small class="small-font">({{ __('Preferred Size 600 X 600') }})</small></label>
                        <div class="wrapper-image-preview">
                            <div class="box">
                                <div class="back-preview-image" style="background-image: url({{ asset('assets/images/placeholder.jpg') }});"></div>
                                <div class="upload-options">
                                    <label class="img-upload-label" for="img-upload"> <i class="fas fa-camera"></i> {{ __('Upload Picture') }} </label>
                                    <input id="img-upload" type="file" class="image-upload" name="photo" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-lg-12">
                     <div class="form-group">
                        <label for="name">{{ __('Link') }}</label>
                        <input type="text" class="form-control" name="link" placeholder="{{ __('Link') }}" required="" value="">
                     </div>
                  </div>
               </div>
               <button type="submit" id="insertButton" class="btn btn-primary">{{ __('Submit') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection