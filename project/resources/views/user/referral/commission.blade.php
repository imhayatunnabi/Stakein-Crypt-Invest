@extends('layouts.user')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Commissions Log') }}
              </h3>
            </div>
            <div class="content">
              @if (count($commissions) == 0)
                <div class="row justify-content-md-center">
                  <p>{{__('NO DATA FOUND')}}</p>
                </div>
              @else
                    <div class="mr-table allproduct mt-4">
                        <div class="table-responsive">
                            <table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('From') }}</th>
                                        <th>{{ __('Level') }}</th>
                                        <th>{{ __('Percentage') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($commissions as $key=>$data)
                                @php
                                    $receiver = App\Models\User::where('id',$data->from_user_id)->first();
                                @endphp
                                    <tr>
                                        <td>{{ $data->created_at->toDateString() }}</td>
                                        <td>{{ ucfirst($data->type) }}</td>
                                        <td>{{  $receiver ? $receiver->name : '' }}</td>
                                        <td>@lang('LEVEL')# {{ $data->level }}</td>
                                        <td>{{ $data->percentage }}(%)</td>
                                        <td>{{ $defaultCurrency->sign }}{{ round($data->amount,2) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $commissions->links() }}
                @endif
              </div>
            </div>
          </div>

@endsection

@push('js')

<script type="text/javascript">
'use strict';
	   $('#example').DataTable({
          ordering: false
      });
</script>

@endpush

