@extends('layouts.user')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('My Withdraws') }} <a href="{{route('user-wwt-create')}}" class="btn btn-primary btn-round ml-2">{{ __('Withdraw Now') }}</a>
              </h3>
            </div>
            <div class="content">
              @if (count($withdraws) == 0)
                <div class="row justify-content-md-center">
                  <p>{{__('NO WITHDRAW FOUND')}}</p>
                </div>
              @else
							<div class="mr-table allproduct mt-4">
									<div class="table-responsive">
											<table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Withdraw Date') }}</th>
														<th>{{ __('Method') }}</th>
														<th>{{ __('Account') }}</th>
														<th>{{ __('Amount') }}</th>
														<th>{{ __('Status') }}</th>
													</tr>
												</thead>
												<tbody>
                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                    <td>{{$withdraw->method}}</td>
                                    @if($withdraw->method != "Bank")
                                        <td>{{$withdraw->acc_email}}</td>
                                    @else
                                        <td>{{$withdraw->iban}}</td>
                                    @endif
                                    @if($gs->currency_format == 0)
                                        <td>{{$gs->currency_sign}}{{ round($withdraw->amount, 2) }}</td>
                                    @else
                                        <td>{{ round($withdraw->amount, 2) }}{{$gs->currency_sign}}</td>
                                    @endif
                                    <td>{{ucfirst($withdraw->status)}}</td>
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

