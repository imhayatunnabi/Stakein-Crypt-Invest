@extends('layouts.user')
@section('content')
<div class="col-lg-9 col-md-8 col-sm-12">
    <div class="transaction-area">
        <div class="heading-area">
            <h3 class="title">
                {{ __('My Rank') }} <a href="{{route('user.deposit.create')}}"
                    class="btn btn-primary btn-round ml-2">@if ($rank<=1000) MEMBER @elseif ($rank>1000 && $rank<=1500)
                            Advisor @elseif ($rank>1500 && $rank<=3000) Captain @elseif ($rank>3000 && $rank <=500)
                                    Influencer @endif</a>
            </h3>
        </div>
    </div>
</div>
@endsection
