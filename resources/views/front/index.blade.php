@extends('front.layouts.master')

@section('css')
	<style>
		.container-banner{
			width: 100%;
			height: 450px;
			padding: 20px;
			background-repeat: no-repeat !important;
			background-size: cover !important;
			box-shadow: 0 0 10px rgb(0 0 0 / 20%);
			border-radius: 5px;
		}
		.container-banner h2{
			color:black;
			font-size:22px
		}
	</style>
@endsection

@section('content')
	<!-- ***** Welcome Area Start ***** -->
	<div class="welcome-area mb-80 mt-100">
		<div class="container-fluid">
			<div class="row">
				@foreach($banners as $banner)
				<div class="col-lg-6 mb-40">
					<div class="container-banner" style="background:url({{asset('front/')}}/img/banner/{{$banner->banner_image}})">
						<h2>{{$banner->banner_title}}</h2>
						<h5 class="text-muted">{!! $banner->banner_subtitle !!}</h5>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>	
	<!-- ***** Welcome Area End ***** -->

	<!-- ***** About Us Area Start ***** -->
	<section class="uza-why-choose-us-area">
		<div class="container">
			<div class="row align-items-center">

				<!-- About Thumbnail -->
				<div class="col-12 col-md-6">
					<div class="about-us-thumbnail mb-80">
						@if( $dataOfferImage->data_value != '' )
						<img src="{{asset('front/')}}/img/about/{{$dataOfferImage->data_value}}" alt="">
						@endif

						@if($config->config_video_rolik != '')
						<!-- Video Area -->
						<div class="uza-video-area hi-icon-effect-8">
							<a href="{{$config->config_video_rolik}}" class="hi-icon video-play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
						</div>
						@endif
					</div>
				</div>

				<!-- About Us Content -->
				<div class="col-12 col-md-6">
					<div class="choose-us-content mb-80">
						<div class="section-heading mb-4">
							<h2>Bizim Haqqımızda</h2>
						</div>
						{!! $config->config_description !!}
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- ***** About Us Area End ***** -->
	@php $ipAdrress=$_SERVER['REMOTE_ADDR']; @endphp
	@php $getCurrentAdvert=DB::table('adverts')->where('unique_id', $ipAdrress)->where('advert_status', 'active')->get();	@endphp
	@if($getCurrentAdvert->count() > 0)
	<section class="uza-blog-area">
        <div class="container mb-50">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Sizin təkliflər</h2>
                        <p>Sizin saytımızda paylaşdığınız təkliflər</p>
                    </div>
                </div>
            </div>
			
			<div class="portfolio-sildes owl-carousel">
				@foreach($getCurrentAdvert as $getItemtAdvert)
				<!-- Single Slide -->
				<div class="single-blog-post bg-img mb-80" style="background-image: url({{asset('front/')}}/img/{{$config->config_logo}});">
					<!-- Post Content -->
					<div class="post-content">
						<span class="post-date">{{ \Carbon\Carbon::parse($getItemtAdvert->updated_at)->format('d m, Y')}}</span>
						<a class="post-title">{{$getItemtAdvert->advert_title}}</a>
						<p>{{$getItemtAdvert->advert_description}}</p>
						<a href="{{route('home.advert.detail', $getItemtAdvert->advert_id)}}" class="read-more-btn">Daha Ətraflı <i class="arrow_carrot-2right"></i></a>
					</div>
				</div>
				@endforeach
			</div>
        </div>
    </section>
	@endif
		
	@php  $getAllAdvert=DB::table('adverts')->where('advert_status', 'active')->get(); @endphp		
	@if($getAllAdvert->count() > 0)
	<!-- ***** Blog Area Start ***** -->
    <section class="uza-blog-area">
        <!-- Background Curve -->
        <div class="blog-bg-curve">
            <img src="{{asset('front/')}}/img/core/curve-4.png" alt="">
        </div>

        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Cari iş təklifləri</h2>
                        <p>Siz bu bölmədə ən son paylaşılan iş təkliflərini görə bilərsiniz</p>
                    </div>
                </div>
            </div>

            <div class="row">
				@foreach($getAllAdvert as $itemAdvert)
                <!-- Single Blog Post -->
                <div class="col-12 col-lg-4">
                    <div class="single-blog-post bg-img mb-80" style="background-image: url({{asset('front/')}}/img/{{$config->config_logo}});">
                        <!-- Post Content -->
                        <div class="post-content">
                            <span class="post-date">{{ \Carbon\Carbon::parse($itemAdvert->updated_at)->format('d m, Y')}}</span>
                            <a class="post-title">{{$itemAdvert->advert_title}}</a>
                            <p>{{$itemAdvert->advert_description}}</p>
							<a href="{{route('home.advert.detail', $itemAdvert->advert_id)}}" class="read-more-btn">Daha Ətraflı <i class="arrow_carrot-2right"></i></a>
                        </div>
                    </div>
                </div>
				@endforeach
            </div>
        </div>
    </section>
    <!-- ***** Blog Area End ***** -->
	@endif
@endsection