<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title & Favicon-->
        <title>{{$config->config_title}} | @yield('title', 'Axtardığınız ustanı tapmanın yeganə yolu | Usta axtarıram')</title>
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
		
		@yield('css')
    </head>

    <body>		
		<!-- ***** Top Search Area Start ***** -->
		<div class="top-search-area">
			<!-- Search Modal -->
			<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<!-- Close Button -->
							<button type="button" class="btn close-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            <form action="{{route('search')}}" method="post" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" name="top_search_bar" id="top_search_bar" class="form-control" placeholder="Kateqoriya daxil edin..." />
                                    <div id="categoryList"></div>
                                </div>
                                {{ csrf_field() }}
								<button type="submit">Axtar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ***** Top Search Area End ***** -->

        <!-- ***** Header Area Start ***** -->
        <header class="header-area">
            <!-- Main Header Start -->
            <div class="main-header-area">
                <div class="classy-nav-container breakpoint-off">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="uzaNav">
                        <!-- Logo -->
                        <a class="nav-brand" href="{{route('index')}}">
                            @if($config->config_logo == '')
                                <img src="{{asset('front/')}}/img/logo.png" width="90" alt="{{$config->config_title}}">
                            @else
                                <img src="{{asset('front/')}}/img/{{$config->config_logo}}" width="90" alt="{{$config->config_title}}">
                            @endif                            
                        </a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="{{ Route::is('index') ? 'current-item' : '' }}"><a href="{{route('index')}}">Ana Səhifə</a></li>
                                    <li class="{{ Route::is('about') ? 'current-item' : '' }}"><a href="{{route('about')}}">Haqqımızda</a></li>
                                    <li class="{{ Route::is('contact') ? 'current-item' : '' }}"><a href="{{route('contact')}}">Bizimlə Əlaqə</a></li>
                                </ul>

                                <!-- Get A Quote -->
                                <div class="get-a-quote ml-4 mr-3">
                                    <div data-toggle="modal" data-target="#searchModal" class="btn uza-btn">İşçi Axtar</div>
                                </div>

                                <!-- Login / Register -->
                                <div class="login-register-btn mx-1">
                                    @if(Session::has('LoggedUser'))
                                    <a href="{{route('profile.dashboard')}}">
                                        @php $data = DB::table('users')->where('user_id',Session('LoggedUser'))->first() @endphp

                                        @if($data->user_image == '')
                                            <span> <img src="{{asset('front/')}}/img/icons/profile.svg" alt="" width="50" height="30"> </span>
                                        @else
                                            <span> <img src="{{asset('front/')}}/img/user/{{$data->user_image}}" alt="" width="50" height="30" style="border-radius:50%; height:50px"> </span>
                                        @endif                                        
                                    </a>
                                    @else
                                    <a href="{{route('login')}}">
                                        <span> <img src="{{asset('front/')}}/img/icons/profile.svg" alt="" width="50" height="30"> İş tap / Qeydiyyat</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->