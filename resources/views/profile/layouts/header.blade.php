<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title & Favicon-->
        <title>{{$config->config_title}} | @yield('title')</title>
        @if($config->config_favicon == '')
            <link rel="icon" href="{{asset('front/')}}/img/favicon.png">
        @else
            <link rel="icon" href="{{asset('front/')}}/img/{{$config->config_favicon}}">
        @endif

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('front/')}}/style.css">
        <link rel="stylesheet" href="{{asset('front/')}}/css/profile.css">

        @yield('css')
    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>

        <!-- ***** Area Start ***** -->
        <section class="section-padding-80">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center" style="min-height:69vh">
					<div class="col-xl-4 d-none d-xl-block">
						<div class="card box-shadow mx-auto" style="width:333px">
							<div class="card-body">
								@if($user->user_image == '')
									<img src="{{asset('front/')}}/img/user/profile.png" alt="{{$user->user_name}}" class="profile-img">
								@else
									<img src="{{asset('front/')}}/img/user/{{$user->user_image}}" alt="{{$user->user_name}}" class="profile-img">
								@endif
								<h4 class="profile-title">{{$user->user_name}}</h4>
								<ul class="profile-list mt-4">
									<li class="{{ Route::is('profile.dashboard') ? 'active' : '' }}">	
										<a href="{{route('profile.dashboard')}}">
											<div>
												<i class="fa fa-home"></i> Ana Səhifə
											</div>
											<i class="fa fa-arrow-right"  style="font-size:16px"></i>
										</a>                                
									</li>
									<li class="{{ Route::is('profile.settings') ? 'active' : '' }}">	
										<a href="{{route('profile.settings')}}">
											<div>
												<i class="fa fa-list-ol"></i> Elanlar
											</div>
											<i class="fa fa-arrow-right"  style="font-size:16px"></i>
										</a>
									</li>
									<li class="{{ Route::is('profile.settings') ? 'active' : '' }}">	
										<a href="{{route('profile.settings')}}">
											<div>
												<i class="fa fa-cogs"></i> Tənzimləmələr
											</div>
											<i class="fa fa-arrow-right"  style="font-size:16px"></i>
										</a>
									</li>
								</ul>
								<a href="{{route('profile.logout')}}" class="btn uza-btn btn-2 mt-3 w-100">Çıxış</a>
							</div>
						</div>
					</div>
					<div class="col-xl-8">
						<div class="card box-shadow w-100">
							<div class="card-body">								
								<!-- ***** Breadcrumb Area Start ***** -->
								<div class="breadcrumb-area" style="height:80px">
									<div class="container">
										<div class="row align-items-end">
											<div class="breadcumb--con">
												<h2 class="title" style="font-size:35px">@yield('title')</h2>
												<nav aria-label="breadcrumb">
													<ol class="breadcrumb">														
														@yield('breadcrumb')
														<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
													</ol>
												</nav>
											</div>
										</div>
									</div>
								</div>
								<!-- ***** Breadcrumb Area End ***** -->
                    