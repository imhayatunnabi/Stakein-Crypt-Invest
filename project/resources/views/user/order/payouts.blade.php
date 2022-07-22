@extends('layouts.user')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('Payouts') }}
              </h3>
            </div>
            <div class="content">
				@if (count($orders) == 0)
					<div class="row justify-content-md-center">
						<p>{{__('NO PAYOUT FOUND')}}</p>
					</div>
				@else
				<div class="mr-table allproduct mt-4">
					<div class="table-responsive">
						<table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>{{ __('Plan') }}</th>
									<th>{{ __('Method') }}</th>
									<th>{{ __('Paid') }}</th>
									<th>{{ __('Get') }}</th>
									<th>{{__('Details')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $data)
									<tr>
										<td>
											{{ $data->title }}
										</td>

										<td>
											{{ $data->method }}
										</td>

										<td>
											@if($gs->currency_format == 0)
											{{ $defaultCurrency->sign }}{{ round($data->invest * $defaultCurrency->value, 2) }}
											@else
											{{ round($data->invest * $defaultCurrency->value, 2) }}{{ $defaultCurrency->sign }}
											@endif
										</td>

										<td>
											@if($gs->currency_format == 0)
												{{ $defaultCurrency->sign }} {{ round($data->pay_amount * $defaultCurrency->value, 2) }}
											@else
												{{ round($data->pay_amount * $defaultCurrency->value, 2) }}{{ $defaultCurrency->sign }}
											@endif
										</td>

										<td>
											<a href="{{ route('user-order',$data->id) }}">
											{{ __('VIEW MORE') }}
											</a>
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
