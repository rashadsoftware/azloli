<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Title & Favicon-->
        <title>{{$config->config_title}} | Usta Girişi</title>
        @if($config->config_favicon == '')
            <link rel="icon" href="{{asset('front/')}}/img/favicon.png">
        @else
            <link rel="icon" href="{{asset('front/')}}/img/{{$config->config_favicon}}">
        @endif

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('front/')}}/style.css">
		
		<style>
			#login_eye{
				top:50%;
				right:10px;
				transform:translateY(-50%);
				cursor:pointer;
				color:#ccc;
				font-size:15px;
			}
			.fa-eye-slash{
				color:#1583e9 !important
			}
		</style>
    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>

        <!-- ***** Top Search Area Start ***** -->
        <div class="top-search-area">
            <!-- Search Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Close Button -->
                            <button type="button" class="btn close-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
                            <!-- Form -->
                            <form action="index.html" method="post">
                                <input type="search" name="top-search-bar" class="form-control" placeholder="Search and hit enter...">
                                <button type="submit">Search</button>
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
                                <img src="{{asset('front/')}}/img/logo.png" alt="{{$config->config_title}}">
                            @else
                                <img src="{{asset('front/')}}/img/{{$config->config_logo}}" alt="{{$config->config_title}}">
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
                                    <li class="{{ Route::is('service') ? 'current-item' : '' }}"><a href="{{route('service')}}">Xidmətlər</a></li>
                                    <li class="{{ Route::is('contact') ? 'current-item' : '' }}"><a href="{{route('contact')}}">Əlaqə</a></li>
                                </ul>

                                <!-- Get A Quote -->
                                <div class="get-a-quote ml-4 mr-3">
                                    <button data-toggle="modal" data-target="#searchModal" class="btn uza-btn">Təklif Göndər</button>
                                </div>

                                <!-- Login / Register -->
                                <div class="login-register-btn mx-3">
                                    <a href="{{route('login')}}">
                                        <span> <img src="{{asset('front/')}}/img/icons/user.png" alt="" width=30 height=30> Giriş</span>
                                    </a>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->

		<!-- ***** Login Area Start ***** -->
		<section class="position-relative" style="padding:120px 0">
			<!-- Background Curve -->
			<div class="background-curve">
				<img src="{{asset('front/')}}/img/core/curve-5.png" alt="curve header">
			</div>
			<div class="container">
				<div class="d-flex align-items-center justify-content-center" style="min-height:63vh">
					<div class="card box-shadow" style="max-width:400px">
						<div class="card-body">
							<h2 class="mb-4">Usta Girişi</h2>
							<form action="{{route('login.post')}}" method="post" autocomplete="off">
								@csrf
								
								@if($message=Session::get('failLogin'))
								<div class="w-100 mt-1">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
								@endif
							
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-poçt" value="{{old('email')}}">
											<span class="text-danger">@error('email') {{$message}} @enderror</span>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="position-relative">
												<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Şifrə" id="loginPassword" value="{{old('password')}}">
												<i class="fa fa-eye position-absolute" id="login_eye"></i>
											</div>                                        
											<span class="text-danger">@error('password') {{$message}} @enderror</span>
										</div>
									</div>
									<div class="col-12">
										<button class="btn uza-btn btn-3">Giriş</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ***** Login Area End ***** -->

		<!-- ******* All JS Files ******* -->
        <!-- jQuery js -->
        <script src="{{asset('front/')}}/js/jquery.min.js"></script>
        <!-- Popper js -->
        <script src="{{asset('front/')}}/js/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="{{asset('front/')}}/js/bootstrap.min.js"></script>
        <!-- All js -->
        <script src="{{asset('front/')}}/js/uza.bundle.js"></script>
        <!-- Active js -->
        <script src="{{asset('front/')}}/js/default-assets/active.js"></script>
        <!-- Main js -->
        <script src="{{asset('front/')}}/js/main.js"></script>
    </body>
</html>