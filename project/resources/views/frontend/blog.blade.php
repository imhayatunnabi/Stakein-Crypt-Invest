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
								<h2 class="title-head">{{__('Blog')}} <span>{{__('Posts')}}</span></h2>
								<hr>
								<ul class="breadcrumbb">
									<li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
									<li>{{__('Blog')}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="container blog-page">
			<div class="row">
				<div class="sidebar col-xs-12 col-md-4">

                    <div class="widget">
						<h3 class="widget-title">{{ __('Categories') }}</h3>
						<ul class="nav nav-tabs">
							@foreach ($bcats as $key=>$data)
								<li><a href="{{ route('front.blogcategory',$data->slug) }}">{{$data->name}}</a></li>
							@endforeach

						</ul>
					</div>

					<div class="widget">
						<h3 class="widget-title">{{__('Archives')}}</h3>
						<ul class="arrow nav nav-tabs second-font uppercase">
							@foreach ($archives as $key=>$data)
								<li><a href="{{ route('front.blogarchive',$key) }}">{{$key}}</a></li>
							@endforeach
						</ul>
					</div>


					<div class="widget widget-tags">
						<h3 class="widget-title">{{__('Popular Tags')}} </h3>
						<ul class="unstyled clearfix">
							@foreach($tags as $tag)
								@if(!empty($tag))
								<li>
									<a class="{{ isset($slug) ? ($slug == $tag ? 'active' : '') : '' }}" href="{{ route('front.blogtags',$tag) }}">{{ $tag }} </a>
								</li>
								@endif
							@endforeach
			            </ul>
					</div>
				</div>


				<div class="content col-xs-12 col-md-8">
					@if (count($blogs) == 0)
						<div class="card">
							<div class="card-body">
								<h3 class="text-center">{{__('No Blog Found')}}</h3>
							</div>
						</div>
					@else
						@foreach ($blogs as $key=>$data)
							<article class="mb-3">
								<a href="{{route('blog.details',$data->slug)}}"><h4>{{Str::limit($data->title,50)}}</h4></a>
								<figure>
									<a href="{{route('blog.details',$data->slug)}}">
										<img class="img-fluid" src="{{asset('assets/images/'.$data->photo)}}" alt="">
									</a>
								</figure>
								<p class="excerpt">
									@php
										echo substr($data->details,0,300);
									@endphp
								</p>
								<a href="{{route('blog.details',$data->slug)}}" class="btn btn-primary btn-readmore">
									{{__('Read more')}}
								</a>
							</article>
						@endforeach
					@endif
						{{ $blogs->links()}}
				</div>
			</div>
		</section>
		<!-- Section Content Ends -->

		@includeIf('partials.front.footer_top')

@endsection

@push('js')

@endpush
