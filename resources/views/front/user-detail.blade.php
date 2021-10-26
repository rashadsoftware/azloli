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
                    <div class="d-flex align-items-center">
                        @if($userData->user_image == '')
                        <img src="{{asset('front/')}}/img/icons/image_default.png" alt="{{$userData->user_name}}" class="mr-3" style="border-radius:50%; width:150px; height:150px">
                        @else
                        <img src="{{asset('front/')}}/img/user/{{$userData->user_image}}" alt="{{$userData->user_name}}" class="mr-3" style="border-radius:50%; width:150px; height:150px">
                        @endif
                        <div class="portfolio-details-text">                            
                            <h2 class="text-capitalize">{{$userData->user_name}}</h2>
                            <h6 class="font-weight-bold">{{implode(',', $category)}}</h6>  
                            @if($userData->user_online == 'online')
                                <span class="user-online">Online</span>
                            @endif                          
                        </div>
                    </div>
                    <p>{{$userData->user_description}}</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="portfolio-meta">
                        <h6><span class="font-weight-bold">Qeydiyyat tarixi:</span> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $userData->created_at)->format('Y/m/d') }}</h6>

                        @if($userData->user_address != '')
                        <h6><span class="font-weight-bold">Ünvan:</span> {{$userData->user_address}}</h6>
                        @endif

                        @if($userData->user_phone != '')
                        <h6><span class="font-weight-bold">Əlaqə:</span> (+994){{$userData->getPhoneAttribute()}}</h6>
                        @endif
                        <a href="{{route('chat.users.create', $userData->user_id)}}" class="btn uza-btn mt-3">Söhbətə Başla</a>
                    </div>
                </div>
            </div>

            <hr style="margin-top:50px">

            @if($images->count() > 0)
            <div class="row">
                <div class="col-12 mt-3 mb-2">
                    <h4>Referans işlər</h4>
                </div>
            </div>
            <div class="grid">
                @foreach($images as $image)
                <div class="grid-item" style="width:19%">
                    <div class="portfolio-thumbnail mb-3" style="padding: 5px; border:1px solid #ccc">
                        <img src="{{asset('front/')}}/img/jobs/{{$image->job_image}}" alt="" class="w-100">
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    <!-- ***** Portfolio Single Area End ***** -->
@endsection

@section('js')
    <script>
        $(function(){
            $('.grid').masonry({
                itemSelector: '.grid-item',
                gutter:10,
            });
        });
    </script>	
@endsection