@extends('front.layouts.master')

@section('title', 'Axtarış')

@section('css')
	<style>
		.single-team-slide .team-social-info a{
		width:auto;
		height:auto;
		line-height:normal;
		border-radius:5px;
		background:var(--main-color);
		border:1px solid var(--main-color)
	}
	.single-team-slide .team-social-info a:hover{
		font-weight:normal
	}
	</style>
@endsection

@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">Axtarış</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
								@if($catCount > 0)
									<li class="breadcrumb-item active" aria-current="page">Axtarış</li>
									<li class="breadcrumb-item active" aria-current="page">{{$catID->category_title}}</li>
								@else
									<li class="breadcrumb-item active" aria-current="page">Axtarış</li>
								@endif
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-12 mt-5">
					@if($catCount > 0)
						@if($skills_count > 0)
							<p>Sorğunuza görə "<span class="text-danger"> {{$data}} </span>" sözünə uyğun {{count($arr)}} eleman tapıldı</p>
						@else
							<p>Sorğunuza görə "<span class="text-danger"> {{$data}} </span>" sözünə uyğun 0 eleman tapıldı</p>
						@endif
					@else
						<p>Sorğunuza görə "<span class="text-danger"> {{$data}} </span>" sözünə uyğun 0 eleman tapıldı</p>
					@endif
				</div>
			</div>
        </div>

        <!-- Background Curve -->
        <div class="breadcrumb-bg-curve">
            <img src="{{asset('front/')}}/img/core/curve-5.png" alt="">
        </div>
    </div>
    <!-- ***** Breadcrumb Area End ***** -->

	@if($catCount > 0)
		@if($skills_count > 0)
		
		<!-- ****** Gallery Area Start ****** -->
		<section class="uza-portfolio-area section-padding-80">		
			<div class="container-fluid">			
				<div class="row">		
					<!-- Single Portfolio Item -->
					@foreach($workers as $worker)
						@if($worker->user_publish == 'publish')
						<div class="col-12 col-sm-6 col-lg-4 col-xl-3 single-portfolio-item">
							<!-- Single Team Slide -->
							<div class="single-team-slide">
								@if($worker->user_image == '')
								<img src="{{asset('front/')}}/img/icons/image_default.png" alt="{{$worker->user_name}}">
								@else
								<img src="{{asset('front/')}}/img/user/{{$worker->user_image}}" alt="{{$worker->user_name}}">
								@endif
								<!-- Overlay Effect -->
								<div class="overlay-effect">
									<h4>{{$worker->user_name}}</h4>
									<p>{{$worker->user_description}}</p>
								</div>
								<div class="team-social-info">
									<a href="{{route('user.detail', $worker->user_id)}}" class="btn btn-success">Daha Ətraflı</a>
								</div>
							</div>
						</div>							
						@endif
					@endforeach				
				</div>

				<div class="row">
					<div class="col-12 text-center mt-30">
						<a href="#" class="btn uza-btn btn-3">Load More</a>
					</div>
				</div>			
				
			</div>		
		</section>
		<!-- ****** Gallery Area End ****** -->	
		@endif	
	@endif
@endsection