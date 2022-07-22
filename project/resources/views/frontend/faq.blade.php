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
                                    <h2 class="title-head">{{__('Frequenty Asked')}} <span>{{__('Questions')}}</span></h2>
                                    <hr>
    
                                    <ul class="breadcrumbb">
                                        <li><a href="{{route('front.index')}}"> {{__('home')}}</a></li>
                                        <li>{{__('faq')}}</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Section Title Ends -->
                        </div>
                    </div>
                </div>
            </section>

            <section class="faq">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="panel-group" id="accordion">
                                @foreach ($faqs as $key=>$data)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">
                                                    {{$data->title}}
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse{{$key}}" class="panel-collapse collapse {{$loop->first ? 'in': ''}}">
                                            <div class="panel-body">
                                                @php
                                                    echo $data->details;
                                                @endphp
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    <div class="sidebar col-xs-12 col-md-4">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">{{__('Recent Blog Posts')}}</h3>
                            <ul class="unstyled clearfix">
                                @foreach ($blogs as $key=>$data)
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
                                                <span class="post-date"><i class="fa fa-clock-o"></i> {{$data->created_at->format('M d, Y')}} </span>
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
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
                    </div>
                </div>
            </section>
    @includeIf('partials.front.footer_top')
@endsection

@push('js')
    
@endpush