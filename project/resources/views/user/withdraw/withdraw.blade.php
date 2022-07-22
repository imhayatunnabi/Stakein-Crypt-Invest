@extends('layouts.user')


@section('content')



        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Withdraw Now') }} <a href="{{route('user-wwt-index')}}" class="btn btn-primary btn-round ml-2">{{ __('Back') }}</a>
              </h3>
            </div>


                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                @if ($gs->withdraw_status == 0)
                    <p class="text-center text-danger">{{__('WithDraw is temporary Off')}}</p>
                    @else

                    <form id="userform" class="form-horizontal px-4" action="{{route('user-wwt-store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
    
                       @include('includes.admin.form-both') 
    
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <select name="methods" id="withmethod" class="form-control" required>
                                    <option value="">@lang('Withdraw Method')</option>
                                    @foreach ($methods as $data)
                                        <option value="{{$data->method}}">{{$data->method}}</option>
                                    @endforeach                       
                                </select>
                            </div>
                        </div>
    
                        <div class="col-lg-12">
                            <label for="amount" class="bmd-label-floating">{{ __('Withdraw Amount') }}*</label>
                            <input name="amount" id="amount" class="form-control" autocomplete="off"  type="text" value="{{ old('amount') }}" required>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group bmd-form-group">
                                <textarea name="details" class="form-control nic-edit" cols="30" rows="10" placeholder="{{__('Receive account details')}}"></textarea>
                            </div>
                        </div>
    
    
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary btn-round">{{ __('Withdraw') }}</button>
                        </div>
                    </div>
                </form>
                @endif
          </div>
        </div>

@endsection

@push('js')


<script type="text/javascript">
    'use strict';

    $("#withmethod").change(function(){
        var method = $(this).val();
        if(method == "Bank"){

            $("#bank").show();
            $("#bank").find('input, select').attr('required',true);

            $("#paypal").hide();
            $("#paypal").find('input').attr('required',false);

        }
        if(method != "Bank"){
            $("#bank").hide();
            $("#bank").find('input, select').attr('required',false);

            $("#paypal").show();
            $("#paypal").find('input').attr('required',true);
        }
        if(method == ""){
            $("#bank").hide();
            $("#paypal").hide();
        }

    })

</script>

@endpush