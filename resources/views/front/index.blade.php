@extends('front.layouts.master')

@section('content')
        <!-- ***** Welcome Area Start ***** -->
        <section class="welcome-area">
            <div class="welcome-slides owl-carousel">
                @foreach($banners as $banner)
                <!-- Single Welcome Slide -->
                <div class="single-welcome-slide">
                    <!-- Background Curve -->
                    <div class="background-curve">
                        <img src="{{asset('front/')}}/img/core/curve-1.png" alt="">
                    </div>

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
                            <!-- Video Area -->
                            <div class="uza-video-area hi-icon-effect-8">
                                <a href="https://www.youtube.com/watch?v=sSakBz_eYzQ" class="hi-icon video-play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                            </div>
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
@endsection