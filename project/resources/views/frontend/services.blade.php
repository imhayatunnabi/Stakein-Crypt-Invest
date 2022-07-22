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
								<h2 class="title-head">{{__('our')}} <span>{{__('services')}}</span></h2>
								<hr>
								<ul class="breadcrumbb">
									<li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
									<li>{{__('services')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="services">
			<div class="container">
				<div class="row">
                    @if (count($services) == 0)
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-center">{{__('No Service Found')}}</h3>
                            </div>
                        </div>
                    @else 
                        @foreach ($services as $key=>$data)
                            <div class="col-md-6 service-box">
                                <div>
                                    <img src="{{asset('assets/images/'.$data->photo)}}" alt="download bitcoin">
                                    <div class="service-box-content">
                                        <h3>{{$data->title}}</h3>
                                        <p>
											@php
												echo $data->details;
											@endphp
										</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
				</div>
			</div>
		</section>

        @includeIf('partials.front.footer_top')
@endsection

@push('js')
    
@endpush