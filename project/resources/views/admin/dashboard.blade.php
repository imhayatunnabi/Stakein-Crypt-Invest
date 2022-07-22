@extends('layouts.admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Dashboard') }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
    </ol>
  </div>
  @if(Session::has('cache'))

  <div class="alert alert-success validation">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">×</span></button>
      <h3 class="text-center">{{ Session::get("cache") }}</h3>
  </div>


@endif

  <div class="row mb-3">

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Active Customers') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($acustomers)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Blocked Customers') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($bcustomers) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Plans') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-paper-plane fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Invests') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($invests) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Pending Invest') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pending) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Running Invest') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($running) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Completed Invest') }}</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($completed) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Declined Invest') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($declined) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-piggy-bank fa-2x text-danger"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Blogs') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($blogs) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-fw fa-newspaper fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Fonts') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($fonts) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-font fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Total Deposits') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($deposits) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Pending Deposits') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($pdeposits) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Completed Deposits') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($cdeposits) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Today,s Joined Customer') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ count($todayCustomers) }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Today,s Total Deposits') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ $todayDeposits }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">{{ __('Today,s Total Invests') }}</div>
                <div class="h6 mb-0 mt-2 font-weight-bold text-gray-800">{{ $todayInvests }} </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-xl-12 col-lg-12 mt-5">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Total Invest in Last 30 Days') }}</h6>
          </div>
            <div class="card-body">
              <canvas id="lineChart"></canvas>
            </div>
        </div>
      </div>

      <div class="col-xl-12 col-lg-12 mt-5">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Latest User') }}</h6>
          </div>
            <div class="card-body">
              <div class="table-responsive p-3">
                <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                  <thead class="thead-light">
                    <tr>
                      <th>{{__('Serial No')}}</th>
                      <th>{{__('Name')}}</th>
                      <th>{{__('Email')}}</th>
                      <th>{{__('Balance')}}</th>
                      <th>{{__('Status')}}</th>
                    </tr>
                  </thead>
            
                  <tbody>
                      @if (count($latestCustomers) == 0)
                          <p>{{__('No LATEST USER FOUND')}}</p>
                        @else 

                        @foreach ($latestCustomers as $key=>$data)
                          <tr>
                              <td><span class="text-info">{{ $loop->iteration }}</span></td>
                              <td>{{ $data->name }}</td>
                              <td>{{ $data->email }}</td>
                              <td>{{$currency->sign}} {{$data->income}}</td>
                              <td>
                                @if ($data->is_banned == 0)
                                  <span class="badge bg-success text-white">@lang('Active')</span>
                                  @else 
                                  <span class="badge bg-danger text-white">@lang('Banned')</span>
                                @endif
                              </td>
                          </tr>
                        @endforeach
                      @endif
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

  </div>
  <!--Row-->

@endsection

@section('scripts')

<script language="JavaScript">
  displayLineChart();

  function displayLineChart() {
      var data = {
          labels: [
            @php
            echo $days;
            @endphp
          ],
          datasets: [{
              label: "Prime and Fibonacci",
              fillColor: "#3dbcff",
              strokeColor: "#0099ff",
              pointColor: "rgba(220,220,220,1)",
              pointStrokeColor: "#fff",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [
              @php
                echo $sales;
              @endphp
              ]
          }]
      };
      var ctx = document.getElementById("lineChart").getContext("2d");
      var options = {
          responsive: true
      };
      var lineChart = new Chart(ctx).Line(data, options);
  }

</script>
@endsection
