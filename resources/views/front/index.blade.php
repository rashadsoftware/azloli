@extends('front.layouts.master')

@section('content')
        <!-- ***** Welcome Area Start ***** -->
        <section class="welcome-area">
            <div class="welcome-slides">
                <!-- Single Welcome Slide -->
                <div class="single-welcome-slide">
                    <!-- Background Curve -->
                    <div class="background-curve">
                        <img src="{{asset('front/')}}/img/core/curve-1.png" alt="curve header">
                    </div>

                    <!-- Welcome Content -->
                    <div class="welcome-content h-100">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                                <!-- Welcome Text -->
                                <div class="col-12 col-md-6">
                                    <div class="welcome-text">
                                        <h2><span>{{$config->config_title}}</span> ilə artıq usta tapmaq çox asandır</h2>
                                        <h5>Bu platforma ilə artıq ustalar qapınızdadır</h5>
                                    </div>
                                </div>
                                <!-- Welcome Thumbnail -->
                                <div class="col-12 col-md-6">
                                    <div class="welcome-thumbnail">
                                        <img src="{{asset('front/')}}/img/background/mobile.png" alt="banner">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Welcome Area End ***** -->

        <!-- ***** About Us Area Start ***** -->
        <section class="uza-about-us-area">
            <div class="container">
                <div class="row align-items-center">

                    <!-- About Thumbnail -->
                    <div class="col-12 col-md-6">
                        <div class="about-us-thumbnail mb-80">
                            <img src="{{asset('front/')}}/img/background/i.jpg" alt="">
                            <!-- Video Area -->
                            <div class="uza-video-area hi-icon-effect-8">
                                <a href="https://www.youtube.com/watch?v=sSakBz_eYzQ" class="hi-icon video-play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- About Us Content -->
                    <div class="col-12 col-md-6">
                        <div class="about-us-content mb-80">
                            <h2>Nəyə görə bizim platformu seçməlisən</h2>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing esed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
                            <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est Lorem ipsum dolor sit amet ipsumlor eut consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt labore et dolore magna
                                liquyam erat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Background Pattern -->
            <div class="about-bg-pattern">
                <img src="{{asset('front/')}}/img/core/curve-2.png" alt="">
            </div>
        </section>
        <!-- ***** About Us Area End ***** -->

        <!-- ***** Services Area Start ***** -->
        <section class="uza-services-area section-padding-80-0">
            <div class="container">
                <div class="row">
                    <!-- Section Heading -->
                    <div class="col-12">
                        <div class="section-heading text-center">
                            <h2>Necə istifadə olunur</h2>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Single Service Area -->
                    <div class="col-12 col-lg-4">
                        <div class="single-service-area mb-80">
                            <!-- Service Icon -->
                            <div class="service-icon">
                                <i class="icon_cone_alt"></i>
                            </div>
                            <h5>Ehtiyacını bəlirlə</h5>
                            <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata.</p>
                        </div>
                    </div>

                    <!-- Single Service Area -->
                    <div class="col-12 col-lg-4">
                        <div class="single-service-area mb-80">
                            <!-- Service Icon -->
                            <div class="service-icon">
                                <i class="icon_piechart"></i>
                            </div>
                            <h5>Bir çox təklif al</h5>
                            <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata.</p>
                        </div>
                    </div>

                    <!-- Single Service Area -->
                    <div class="col-12 col-lg-4">
                        <div class="single-service-area mb-80">
                            <!-- Service Icon -->
                            <div class="service-icon">
                                <i class="icon_easel"></i>
                            </div>
                            <h5>Ustanı seç</h5>
                            <p>Sənə təklif verən ustalarımız arasından birisinin qiymət və yorumlarını baz alaraq seç</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ***** Services Area End ***** -->

        <!-- ***** Portfolio Area Start ***** -->
        <section class="uza-portfolio-area section-padding-80">
            <div class="container">
                <div class="row">
                    <!-- Section Heading -->
                    <div class="col-12">
                        <div class="section-heading text-center">
                            <h2>Ən populyar xidmətlər</h2>
                            <p>We stay on top of our industry by being experts in yours.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <!-- Portfolio Slides -->
                    <div class="portfolio-sildes owl-carousel">

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/3.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Boya və Badana</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/4.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Su Tesisatı</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/5.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Kuxna Mətbəx Təmiri</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/6.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Digital Marketing</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/5.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Digital Marketing</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                        <!-- Single Portfolio Slide -->
                        <div class="single-portfolio-slide">
                            <img src="{{asset('front/')}}/img/bg-img/6.jpg" alt="">
                            <!-- Overlay Effect -->
                            <div class="overlay-effect">
                                <h4>Digital Marketing</h4>
                                <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet gubergren no sea takimata sanctus est</p>
                            </div>
                            <!-- View More -->
                            <div class="view-more-btn">
                                <a href="#"><i class="arrow_right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Background Curve -->
            <div class="portfolio-bg-curve">
                <img src="{{asset('front/')}}/img/core/curve-3.png" alt="">
            </div>
        </section>
        <!-- ***** Portfolio Area End ***** -->
@endsection