@extends('layouts.user')

@section('content')

<div class="col-lg-9 col-md-8 col-sm-12">

          <div class="transaction-area">
            <div class="heading-area">
              <h3 class="title">
                {{ __('My Referred') }}
              </h3>
            </div>
            <div class="content">
              @if (count($referreds) == 0)
                <div class="row justify-content-md-center">
                  <p>{{__('NO DATA FOUND')}}</p>
                </div>
              @else
                    <div class="mr-table allproduct mt-4">
                        <div class="table-responsive">
                            <table id="example" class="table tabl-text table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Serial No') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Joined At') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($referreds as $key=>$data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($data->name) }}</td>
                                        <td>{{ $data->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $referreds->links() }}
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

