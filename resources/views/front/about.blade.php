@extends('front.layouts.master')

@section('title', 'Haqqımızda')

@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">Haqqımızda</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Haqqımızda</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Breadcrumb Area End ***** -->

    <!-- ***** About Us Area Start ***** -->
    <section class="uza-about-us-area section-padding-80">
        <div class="container">
            <div class="row align-items-center">
                <!-- About Thumbnail -->
                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-80">
                        @if( $dataMissionImage->data_value != '' )
                        <img src="{{asset('front/')}}/img/about/{{$dataMissionImage->data_value}}" alt="">
                        @endif
                    </div>
                </div>

                <!-- About Us Content -->
                <div class="col-12 col-lg-6">
                    <div class="section-heading mb-5">
                        <h2>Bizim Məqsədimiz</h2>
                    </div>

                    <div class="about-us-content mb-80">
                        <div class="about-tab-area">
                            <ul class="nav nav-tabs mb-50" id="mona_modelTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-uppercase" id="tab1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Məqsədimiz</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">STRATEGiyamız</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Mona Tab Content -->
                        <div class="about-tab-content">
                            <div class="tab-content" id="mona_modelTabContent">
                                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1">
                                    <!-- Tab Content Text -->
                                    <div class="tab-content-text">
                                        <p>{{DB::table('datas')->where('data_key','first_title')->first()->data_value}}</p>                                        
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab3">
                                    <!-- Tab Content Text -->
                                    <div class="tab-content-text">
                                        <p>{{DB::table('datas')->where('data_key','third_title')->first()->data_value}}</p> 
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- ***** Why Choose Us Area Start ***** -->
    <section class="uza-why-choose-us-area">
        <div class="container">
            <div class="row align-items-center">
                <!-- Choose Us Content -->
                <div class="col-12 col-lg-6">
                    <div class="choose-us-content mb-80">
                        <div class="section-heading mb-4">
                            <h2>Niyə Bizi Seçin</h2>
                            <p>Biz Sizin Uğurunuzun Partnyoruyuq</p>
                        </div>
                        <ul>
                            @foreach($dataOffers as $dataOffer)
                            <li><i class="fa fa-check" aria-hidden="true"></i> {{$dataOffer->data_value}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Choose Us Thumbnail -->
                <div class="col-12 col-lg-6">
                    <div class="choose-us-thumbnail mb-80">
                        @if( $dataOfferImage->data_value != '' )
                        <img class="w-100" src="{{asset('front/')}}/img/about/{{$dataOfferImage->data_value}}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Why Choose Us Area End ***** -->

    <!-- ***** CTA Area Start ***** -->
    <div class="uza-cta-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <div class="cta-content mb-80">
                        <h2>Bizimlə tərəfdaş olmaq istəyirsiniz?</h2>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="cta-content mb-80">
                        <div class="call-now-btn">
                            <a href="#"><span>İndi zəng edin:</span> 0{{$config->getPhoneAttribute()}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** CTA Area End ***** -->
@endsection