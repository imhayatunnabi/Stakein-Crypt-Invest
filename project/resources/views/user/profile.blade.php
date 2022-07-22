@extends('layouts.user')
@section('content')

        <div class="col-lg-9">
            <div class="account-box">
              <div class="header-area">
                <h4 class="title">
                    {{__('Edit Profile')}}
                </h4>
                <a href="javascript:;" class="edit"  data-toggle="modal" data-target="#edit-account">
                    <i class="material-icons">{{__('edit')}}</i>
                </a>
              </div>
              <div class="content">


                <div class="table-responsive referral">
                <table>
                  <tr>
                    <td>
                        {{__('User Name')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('Email Address')}}<span>:</span>
                    </td>
                    <td>
                         {{ $user->email }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('Phone Number')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('Address')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->address }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('City')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->city }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('Fax')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->fax }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        {{__('Zip')}}<span>:</span>
                    </td>
                    <td>
                        {{ $user->zip }}
                    </td>
                  </tr>
                </table>
                </div>
              </div>
            </div>

        </div>


  <div class="modal edit-account fade" id="edit-account" tabindex="-1" role="">
      <div class="modal-dialog modal-login" role="document">
          <div class="modal-content">
              <div class="card card-signup card-plain">
                  <div class="modal-header">
                    <div class="card-header card-header-primary text-center">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <span aria-hidden="true">&times;</span>
                      </button>

                      <h4 class="card-title">{{__('Edit Profile')}}</h4>
                    </div>
                  </div>
                  <div class="modal-body">

                      <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                      <form class="form" method="POST" action="{{route('user-profile-update')}}" enctype="multipart/form-data">

                        {{ csrf_field() }}

                      <div class="upload-image-area">
                        <div class="img">
                          @if($user->is_provider == 1)
                            <img src="{{ $user->photo ? asset($user->photo):asset('assets/images/noimage.png') }}">
                          @else
                            <img src="{{ $user->photo ? asset('assets/images/'.$user->photo):asset('assets/images/noimage.png') }}">
                          @endif
                        </div>
                        <a href="javascript:;" class="mybtn1 edit-profile">{{__('Upload Image')}}</a>
                        <input class="d-none upload" type="file" name="photo">
                      </div>

                          <div class="card-body">

                              <div class="form-group">
                                <label for="name" class="bmd-label-floating">{{__('User Name')}} *</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required="">
                              </div>


                              <div class="form-group">
                                <label for="phone" class="bmd-label-floating">{{__('Phone Number')}} *</label>
                                <input type="tel" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required="">
                              </div>

                              <div class="form-group">
                                <label for="address" class="bmd-label-floating">{{__('Address')}} *</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" required="">
                              </div>

                              <div class="form-group">
                                <label for="city" class="bmd-label-floating">{{__('City')}}</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ $user->city }}">
                              </div>

                              <div class="form-group">
                                <label for="fax" class="bmd-label-floating">{{__('Fax')}}</label>
                                <input type="text" class="form-control" name="fax"  id="fax" value="{{ $user->fax }}">
                              </div>

                              <div class="form-group">
                                <label for="zip" class="bmd-label-floating">{{__('Zip')}}</label>
                                <input type="text" class="form-control" name="zip" id="zip" value="{{ $user->zip }}">
                              </div>

                              <div class="form-group">
                                  <button type="submit" class="btn submit-btn btn-round">
                                    {{__('Save')}}
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>




@endsection

@push('js')

<script type="text/javascript">
  'use strict';
  
  $('.edit-profile').on('click',function(){
    $('.upload').click();

  });

</script>

@endpush
