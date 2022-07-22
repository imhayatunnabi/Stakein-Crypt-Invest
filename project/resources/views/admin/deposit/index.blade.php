@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Deposits') }}</h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>

		<li class="breadcrumb-item"><a href="{{ route('admin.deposits.index') }}">{{ __('Deposits') }}</a></li>
	</ol>
	</div>
</div>


<!-- Row -->
<div class="row mt-3">
  <div class="col-lg-12">
	@include('includes.admin.form-success')
	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Deposit Number')}}</th>
                <th>{{__('Customer Email')}}</th>
                <th>{{__('Customer Name')}}</th>
                <th>{{__('Amount')}}</th>
                <th>{{__('Status')}}</th>
			</tr>
		  </thead>
		</table>
	  </div>
	</div>
  </div>
</div>



@endsection



@section('scripts')

<script type="text/javascript">
	"use strict";

    var table = $('#geniustable').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           searching: false,
           ajax: '{{ route('admin.deposits.datatables') }}',
           columns: [
                { data: 'created_at', name: 'created_at' },
                { data: 'deposit_number', name: 'deposit_number' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'customer_email', name: 'customer_email' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
            ],
            language : {
                processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
            }
        });

</script>

@endsection


