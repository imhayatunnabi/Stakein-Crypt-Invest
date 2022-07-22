@extends('layouts.front')

@push('css')
    
@endpush

@section('contents')
		<section class="banner-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<div class="text-center">
							<div class="col-xs-12">
								<h2 class="title-head"><span>{{$page->title}}</span></h2>
								<hr>
								<ul class="breadcrumbb">
									<li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
									<li>{{$page->title}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="terms-of-services">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
                        @php
                            echo $page->details;
                        @endphp
					</div>
				</div>
			</div>
		</section>

@endsection

@push('js')
    
@endpush