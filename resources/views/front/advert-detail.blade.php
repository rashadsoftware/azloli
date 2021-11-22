@extends('front.layouts.master')
	
@section('title', 'Əlaqə')
	
@section('content')
	<!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">{{$advertDetail->advert_title}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$advertDetail->advert_title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Curve -->
        <div class="breadcrumb-bg-curve">
            <img src="{{asset('front/')}}/img/core-img/curve-5.png" alt="">
        </div>
    </div>
    <!-- ***** Breadcrumb Area End ***** -->
	
	<!-- ***** Blog Details Area Start ***** -->
    <section class="blog-details-area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-details-content">
                        <!-- Post Details Text -->
                        <div class="post-details-text">

                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-10">
                                    <div class="post-content text-center mb-4">                                        
                                        <h2>{{$advertDetail->advert_title}}</h2>
										<a href="#" class="post-date text-left mb-2">{{ Carbon\Carbon::parse($advertDetail->updated_at)->toFormattedDateString() }}</a>
										<span class="post-date text-left">Baxış sayı: {{$advertDetail->advert_count}}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10">
                                    <p>{{$advertDetail->advert_description}}</p>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <!-- Post Catagories -->
                                        <div class="post-catagories">
                                            <ul class="d-flex flex-wrap align-items-center">
                                                <li><a href="{{route('home.advert.delete', $advertDetail->advert_id)}}">Elanı sil</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Comments Area -->
                                    <div class="comment_area mb-50 clearfix">
										@php
                                            $countArrayOffer=array(); 
                                        @endphp

                                        @foreach ($getAllAdvertUser as $itemAdvertID)
                                            @php $getUserID=DB::table('users')->where('user_id', $itemAdvertID->userID)->where('user_status', 'user')->first(); @endphp

                                            @if($getUserID->user_publish == "publish")
                                                @php array_push($countArrayOffer, $getUserID->user_id); @endphp
                                            @endif
                                        @endforeach

                                        
                                        <h5 class="title">{{count($countArrayOffer)}} Təklif</h5>
                                        
                                        <ol>
                                            @foreach($getAllAdvertUser as $itemAdvertUser)
                                                @php $getUserData=DB::table('users')->where('user_id', $itemAdvertUser->userID)->where('user_status', 'user')->first(); @endphp

                                                @if($getUserData->user_publish == "publish")
                                                <!-- Single Comment Area -->
                                                <li class="single_comment_area">
                                                    <!-- Comment Content -->
                                                    <div class="comment-content d-flex">
                                                        <!-- Comment Author -->
                                                        <div class="comment-author">
                                                            @if($getUserData->user_image == '')
                                                                <img src="{{asset('front/')}}/img/icons/image_default.png" alt="{{$getUserData->user_name}}">
                                                            @else
                                                                <img src="{{asset('front/')}}/img/icons/{{$getUserData->user_image }}" alt="{{$getUserData->user_name}}">
                                                            @endif
                                                        </div>
                                                        <!-- Comment Meta -->
                                                        <div class="comment-meta">
                                                            <a class="post-date">{{ Carbon\Carbon::parse($itemAdvertUser->updated_at)->toFormattedDateString() }}</a>
                                                            <h5>{{$getUserData->user_name}}</h5>
                                                            <a href="{{route('user.detail', $getUserData->user_id)}}" class="reply">Profile get</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog Details Area End ***** -->
@endsection