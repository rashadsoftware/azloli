<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Title & Favicon-->
        <title>{{$config->config_title}} | @yield('title')</title>
        @if($config->config_favicon == '')
            <link rel="icon" href="{{asset('front/')}}/img/favicon.png">
        @else
            <link rel="icon" href="{{asset('front/')}}/img/{{$config->config_favicon}}">
        @endif

		<!-- Fontawesome -->
		<link rel="stylesheet" href="{{asset('front/')}}/plugins/fontawesome-free-5.15.4/css/all.css">
		<!-- LightBox -->
		<link rel="stylesheet" href="{{asset('front/')}}/plugins/lightbox2-2.11.3/lightbox.css">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('front/')}}/style.css">
        <link rel="stylesheet" href="{{asset('front/')}}/css/profile.css">

        @yield('css')
		
		@php
			$newArray=array();
			$newAdverts=array();
		
			$getSkill=DB::table('skills')->where('userID', $user->user_id)->get();

			foreach($getSkill as $getSkillItem){
				$adverts=DB::table('adverts')->where('advert_status', 'active')->where('advert_subcategory', $getSkillItem->subcategoryID)->get();
				
				array_push($newArray, $adverts);            
			}

			for($g=0; $g < count($newArray); $g++){
				foreach($newArray[$g] as $newArrayItem){
					array_push($newAdverts, $newArrayItem->advert_id);  
				}                      
			}

			for($f=0; $f < count($newAdverts); $f++){
				$queryCheck=DB::table('checks')->where('userID', $user->user_id)->where('advertID', $newAdverts[$f])->count();
				
				if(!$queryCheck > 0){
					DB::table('checks')->insert([
						'userID'=>$user->user_id,
						'advertID'=>$newAdverts[$f],
						'ownerID'=>'',
						'check_status'=>'',
					]);
				}                     
			}
		@endphp
    </head>

    <body>
        <!-- ***** Area Start ***** -->
        <section class="section-padding-80">
            <div class="container">
                <div class="d-flex justify-content-center" style="min-height:69vh">
					<div class="col-xl-4 d-none d-xl-block">
						<div class="card box-shadow mx-auto" style="width:333px">
							<div class="card-body">
								@if($user->user_image == '')
									<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$user->user_name}}" class="profile-img">
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
									<li class="{{ Route::is('profile.skills') ? 'active' : '' }}">	
										<a href="{{route('profile.skills')}}">
											<div>
												<i class="fas fa-stream"></i> Bacarıqlar
											</div>
											<i class="fa fa-arrow-right"  style="font-size:16px"></i>
										</a>
									</li>
									<li class="{{ Route::is('profile.jobs') ? 'active' : '' }}">	
										<a href="{{route('profile.jobs')}}">
											<div>
												<i class="fas fa-tasks"></i> Referans İşlər
											</div>
											<i class="fa fa-arrow-right"  style="font-size:16px"></i>
										</a>
									</li>
									<li class="{{ Route::is('profile.advert') ? 'active' : '' }}">	
										<a href="{{route('profile.advert')}}">
											<div>
												<i class="fas fa-briefcase"></i> iş Təklifləri
											</div>
											<div>
												@php $checksCount=DB::table('checks')->where('check_read','unread')->where('userID', $user->user_id )->count(); @endphp
												@if($user->user_publish == 'publish')
													@if($checksCount > 0)
													<span class="badge badge-info mr-2">{{ $checksCount }}</span>
													@endif
												@endif
												<i class="fa fa-arrow-right"  style="font-size:16px"></i>
											</div>											
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
									<li>	
										<a href="{{route('chat.login')}}">
											<div>
												<i class="fa fa-comments-o"></i> Canlı Söhbət
											</div>
										</a>
									</li>
									<div class="w-100 mt-3">
										@if($user->user_publish == 'unpublish')
											<a href="{{route('profile.dashboard.publish')}}" class="btn uza-btn btn-4 d-flex align-items-center mx-auto" style="width:170px"> <i class="fas fa-upload mr-md-2"></i> <span class="d-none d-md-block">Yayına Başla</span></a>
										@else
											<a href="{{route('profile.dashboard.unpublish')}}" class="btn uza-btn btn-1 d-flex align-items-center mx-auto" style="width:200px"> <i class="fa fa-download mr-md-2"></i> <span class="d-none d-md-block">Yayını Dayandır</span></a>
										@endif
									</div>									
								</ul>
								<a href="{{route('profile.logout')}}" class="btn uza-btn btn-2 mt-3 w-100">Çıxış</a>
							</div>
						</div>
					</div>
					<div class="col-xl-8">
						<div class="card box-shadow w-100">
							<div class="card-body">								
								<!-- ***** Breadcrumb Area Start ***** -->
								<div class="breadcrumb-area" style="height:auto">
									<div class="container">
										<div class="row align-items-end">
											<div class="breadcumb--con w-100">
												<div class="d-flex align-items-center justify-content-between w-100">
													<h2 class="title" style="font-size:35px">@yield('title')</h2>
													<div class="d-flex">
														<a href="{{route('index')}}" class="btn btn-primary d-flex align-items-center mr-2"> <i class="fa fa-globe mr-md-2"></i> <span class="d-none d-md-block">Sayta geri qayıt</span></a>
													</div>													
												</div>												
												<nav aria-label="breadcrumb">
													<ol class="breadcrumb">														
														@yield('breadcrumb')
														<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
													</ol>
												</nav>
											</div>
										</div>
										<div class="row">
											@if($user->user_publish == 'unpublish')
											<marquee class="mt-3 p-1 bg-light">Sifarişçilərin sizi görməsi və sizə iş təkliflərində bulunması üçün zəhmət olmasa özünüz haqqında bütün məlumatları doldurduqdan sonra yayına başla butonunu sıxın. Əks halda hesabınız görünməz olaraq qalacaqdır!</marquee>
											@endif

											@if($message=Session::get('successDashboard'))
											<div class="w-100 mt-2 j_Alert">
												<div class="alert alert-success">
													{{ $message }}
												</div>
											</div>
											@endif											
											
											@if($message=Session::get('alertDashboard'))
											<div class="w-100 mt-1 j_Alert mt-2">
												<div class="alert alert-info">
													{{ $message }}
												</div>
											</div>
											@endif											
										</div>
									</div>
								</div>
								<!-- ***** Breadcrumb Area End ***** -->
                    