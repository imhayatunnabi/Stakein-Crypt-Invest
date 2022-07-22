@extends('layouts.user')

@section('content')

        <div class="col-lg-9">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Transactions') }}
              </h3>
            </div>
            <div class="content">
				@if (count($user->transactions()->orderBy('id','desc')->get()) == 0)
					<div class="row justify-content-md-center">
						<p>{{__('NO TRANSACTION FOUND')}}</p>
					</div>
				@else 
				<div class="mr-table allproduct mt-4">
					<div class="table-responsiv">
						<table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ __('Type') }}</th>
									<th>{{ __('Txnid') }}</th>
									<th>{{ __('Amount') }}</th>
									<th>{{ __('Date') }}</th>
								</tr>
							</thead>
							<tbody>

								@foreach($user->transactions()->orderBy('id','desc')->get() as $data)
									<tr>
										<td>
											{{$data->type}}
										</td>
										<td>
											{{ $data->txnid }}
										</td>
										<td>
											@if($gs->currency_format == 0)
												{{$gs->currency_sign}}{{ round($data->amount , 2) }}
											@else
												{{ round($data->amount , 2) }}{{$gs->currency_sign}}
											@endif
										</td>
										<td>
												{{date('d M Y',strtotime($data->created_at))}}
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

@endsection

@push('js')

<script type="text/javascript">
	'use strict';

	$('#example').DataTable({
		ordering: false
    });
</script>

@endpush
