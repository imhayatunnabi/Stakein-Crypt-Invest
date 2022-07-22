@extends('layouts.user')
@section('content')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
               {{ __('Support Tickets') }} <a data-toggle="modal" data-target="#vendorform" href="javascript:;" class="btn btn-primary btn-round btn-base ml-2">{{ __('Add Ticket')}}</a>
              </h3>
            </div>
            <div class="content">
              @if (count($convs) == 0)
                <div class="row justify-content-md-center">
                  <p>{{__('NO MESSAGE FOUND')}}</p>
                </div>
              @else
              <div class="mr-table allproduct mt-4">
                  <div class="table-responsiv">
                      <table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>{{ __('Subject') }}</th>
                            <th>{{ __('Message') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th>{{ __('Action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($convs as $conv)
                              <tr class="conv">
                                <input type="hidden" value="{{$conv->id}}">
                                <td>{{$conv->subject}}</td>
                                <td>{{$conv->message}}</td>

                                <td>{{$conv->created_at->diffForHumans()}}</td>
                                <td>
                                  <a href="{{route('user-message-show',$conv->id)}}" class="link view ml-1"><i class="fa fa-eye"></i></a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user-message-delete1',$conv->id)}}"class="link remove-btn"><i class="fa fa-trash"></i></a>
                                </td>

                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                @endif
            </div>
          </div>
        </div>

{{-- MESSAGE MODAL --}}
<div class="message-modal">
  <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel">{{ __('Add Ticket') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form id="emailreply1">
                    {{csrf_field()}}
                    <ul>
                      <li>
                        <input type="text" class="form-control" id="subj1" name="subject" placeholder="{{ __('Subject') }}" required="">
                      </li>
                      <li>
                        <textarea class="form-control textarea" name="message" id="msg1" placeholder="{{ __('Your Message') }}" required=""></textarea>
                      </li>
                    </ul>
                    <button class="submit-btn" id="emlsub1" type="submit">{{ __('Send') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


{{-- CONFIRM DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-block text-center">
          <h4 class="modal-title d-inline-block">{{ __('Confirm Delete') }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
      </div>

                <div class="modal-body">
                  <p class="text-center">{{__("You are about to delete this Ticket.")}}</p>
                  <p class="text-center">{{ __("Do you want to proceed?") }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
                </div>
            </div>
        </div>
    </div>
{{-- CONFIRM DELETE MODAL ENDS --}}




@endsection

@push('js')

<script type="text/javascript">
'use strict';

          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/user/admin/user/send/message')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                  },
            success: function( data) {
                      $('#subj1').prop('disabled', false);
                      $('#msg1').prop('disabled', false);
                      $('#subj1').val('');
                      $('#msg1').val('');
                      $('#emlsub1').prop('disabled', false);
                      if(data == 0)
                      $.notify("Oops Something Goes Wrong !!","error");
                      else
                      $.notify("Message Sent !!","success");
                      $('.close').click();
                      location.reload();
            }

        });
          return false;
        });

</script>

<script type="text/javascript">
    'use strict';

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endpush
