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
	.mb-500{
		margin-bottom:500px
	}
	</style>
@endsection

@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area @if(!$catCount > 0 || !$skills_count > 0) mb-500 @endif">
        <div class="container h-100">
            <div class="row h-75 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">Axtarış</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
								@if($catCount > 0)
									<li class="breadcrumb-item active" aria-current="page">Axtarış</li>
									<li class="breadcrumb-item active" aria-current="page">{{$catID->subcategory_title}}</li>
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
						<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
							<div class="card-item">
								<div class="img">
									@if($worker->user_image == '')
									<img src="{{asset('front/')}}/img/icons/image_default.png" alt="{{$worker->user_name}}">
									@else
									<img src="{{asset('front/')}}/img/user/{{$worker->user_image}}" alt="{{$worker->user_name}}">
									@endif
									@if($worker->user_online == 'online')
									<div class="img-online"><span class="user-online">Online</span></div>									
									@endif
								</div>
								<div class="top-text">
									<div class="name">{{$worker->user_name}}</div>
									<p>{{$worker->getSkill->getCategory->category_title}} / {{$worker->getSkill->getSubCategory->subcategory_title}}</p>
								</div>		
								<div class="bottom-text">
									<div class="text">{{ Str::limit($worker->user_description,120) }}</div>
									<div class="card-btn">
										<a href="{{route('user.detail', $worker->user_id)}}" class="btn">Daha Ətraflı</a>
									</div>
								</div>					
							</div>
						</div>							
						@endif
					@endforeach				
				</div>
			</div>		
		</section>
		<!-- ****** Gallery Area End ****** -->	
		@endif	
	@endif
@endsection