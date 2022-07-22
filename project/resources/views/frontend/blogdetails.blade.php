@extends('layouts.front')

@push('css')
    
@endpush

@section('contents')
		<!-- Banner Area Starts -->
		<section class="banner-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<div class="text-center">
							<div class="col-xs-12">
								<h2 class="title-head banner-post-title">{{$data->title}}</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="container blog-page">
			<div class="row">
				<div class="content col-xs-12 col-md-8">
					<article>
						<figure class="blog-figure">
							<img class="img-fluid" src="{{asset('assets/images/'.$data->photo)}}" alt="">
						</figure>
						<p class="content-article">
							@php
								echo $data->details;
							@endphp
						</p>

						<div class="meta second-font">
							<span class="date"><i class="fa fa-calendar"></i> {{$data->created_at->format('d M Y')}}</span>
							<span><i class="fa fa-tags"></i> {{$data->tags}}</span>
						</div>

						<div id="disqus_thread"></div>
					</article>
				</div>
				<!-- Sidebar Starts -->
				<div class="sidebar col-xs-12 col-md-4">
					<div class="widget">
						<h3 class="widget-title">{{__('Categories')}}</h3>
						<ul class="arrow nav nav-tabs second-font uppercase">
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

					<div class="widget recent-posts">
						<h3 class="widget-title">{{__('Recent Posts')}}</h3>
						<ul class="unstyled clearfix">
							@foreach ($rblogs as $key=>$data)
								<li>
									<div class="posts-thumb pull-left"> 
										<a href="{{route('blog.details',$data->slug)}}">
											<img alt="img" src="{{asset('assets/images/'.$data->photo)}}">
										</a>
									</div>
									<div class="post-info">
										<h4 class="entry-title">
											<a href="{{route('blog.details',$data->slug)}}">{{Str::limit($data->title,50)}}</a>
										</h4>
										<p class="post-meta">
											<span class="post-date"><i class="fa fa-clock-o"></i> {{$data->created_at->format('M d, Y')}}</span>
										</p>
									</div>
									<div class="clearfix"></div>
								</li>
							@endforeach
						<!-- Recent Post Widget Ends -->
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
			</div>
		</section>

		@includeIf('partials.front.footer_top')

@endsection

@push('js')
@if ($gs->is_disqus == 1)
<script>
	'use strict';
	(function () {
		var d = document,
		s = d.createElement('script');
		s.src = 'https://{{ $gs->disqus}}.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
	})();
</script>
<noscript>{{__('Please enable JavaScript to view the')}} <a href="https://disqus.com/?ref_noscript">{{__('comments powered by Disqus.')}}</a></noscript>
@endif
@endpush