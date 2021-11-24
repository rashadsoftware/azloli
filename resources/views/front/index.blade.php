@extends('front.layouts.master')

@section('content')
	<!-- ***** Welcome Area Start ***** -->
	<section class="welcome-area">
		<div class="welcome-slides owl-carousel">
			@foreach($banners as $banner)
			<!-- Single Welcome Slide -->
			<div class="single-welcome-slide">
				<!-- Welcome Content -->
				<div class="welcome-content h-100">
					<div class="container h-100">
						<div class="row h-100 align-items-center">
							<!-- Welcome Text -->
							<div class="col-12 col-md-6">
								<div class="welcome-text">
									<h2 data-animation="fadeInUp" data-delay="100ms">{{$banner->banner_title}}</h2>
									<h5 data-animation="fadeInUp" data-delay="200ms">{!! $banner->banner_subtitle !!}</h5>
								</div>
							</div>
							<!-- Welcome Thumbnail -->
							<div class="col-12 col-md-6">
								<div class="welcome-thumbnail">
									<img src="{{asset('front/')}}/img/banner/{{$banner->banner_image}}" alt="" data-animation="slideInRight" data-delay="300ms">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</section>
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