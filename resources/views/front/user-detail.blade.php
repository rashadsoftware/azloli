@extends('front.layouts.master')

@section('title')
	{{$userData->user_name}}
@endsection

@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">Daha Ətraflı</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
								<li class="breadcrumb-item"><a href="{{route('user.detail', $userData->user_id)}}"> {{$userData->user_name}}</a></li>
								<li class="breadcrumb-item active" aria-current="page">Daha Ətraflı</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Curve -->
        <div class="breadcrumb-bg-curve">
            <img src="{{asset('front/')}}/img/core/curve-5.png" alt="">
        </div>
    </div>
    <!-- ***** Breadcrumb Area End ***** -->

	<!-- ***** Portfolio Single Area Start ***** -->
    <section class="uza-portfolio-single-area section-padding-80">
        <div class="container">
            <div class="row justify-content-between align-items-end">
                <div class="col-12 col-md-6">
                    <div class="portfolio-details-text">
                        <h2 class="text-capitalize">{{$userData->user_name}}</h2>
                        <h6>{{implode(',', $category)}}</h6>
                        <p>{{$userData->user_description}}</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="portfolio-meta">
                        <h6 class="text-capitalize"><span class="font-weight-bold">İstifadəçi:</span> {{$userData->user_name}}</h6>
                        <h6><span class="font-weight-bold">Qeydiyyat tarixi:</span> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $userData->created_at)->format('Y/m/d') }}</h6>

                        @if($userData->user_address != '')
                        <h6><span class="font-weight-bold">Ünvan:</span> {{$userData->user_address}}</h6>
                        @endif

                        @if($userData->user_phone != '')
                        <h6><span class="font-weight-bold">Əlaqə:</span> (+994){{$userData->getPhoneAttribute()}}</h6>
                        @endif
                        <a href="#" class="btn uza-btn mt-3">Təklif Göndər</a>
                    </div>
                </div>
            </div>

            <div class="row mt-80">
                @foreach($images as $image)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="portfolio-thumbnail mb-3"style="box-shadow: 0 0 10px rgb(0,0,0,0.5); padding: 15px;">
                        <img src="{{asset('front/')}}/img/jobs/{{$image->job_image}}" alt="">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** Portfolio Single Area End ***** -->
@endsection