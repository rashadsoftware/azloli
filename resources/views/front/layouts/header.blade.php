<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Rashad Alakbarov, 0558215673">
		<meta name="description" content="İş vəya işçi axtaranlar üçün geniş fürsətlər">
		<meta name="keywords" content="iş elanları, işçi elanları, iş axtaranlar, işçi axtaranlar, iş vakansiyaları">
		<meta name="revisit-after" content="1 days">
		<meta data-rh="true" id="meta-description" name="description" content="İş vəya işçi axtarın. Yeni iş təklifləri sistemi">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

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

        <style>
            input[type="file"] {
                display: block;
            }
            .imageThumb {
                max-height: 75px;
                padding: 1px;
            }
            .pip {
                display: inline-block;
                margin: 10px 10px 0 0;
                position: relative;
                background: #ccc;
                padding: 3px
            }
            .remove {
                color: #fff;
                cursor: pointer;
                position: absolute;
                top: 1px;
                right: 6px
            }
            .remove:hover {
                color: black;
            }
            .form-control:focus{
                box-shadow: none
            }
            #error_msg{
                display: none
            }
        </style>
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

        <!-- Person Modal -->
        <div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yeni İş Təklifi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" enctype="multipart/form-data" action="{{route('home.form.advert')}}" method="POST" id="formOrder">
                            @csrf
                            
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Adınızı daxil edin">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>                                
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="surname" placeholder="Soyadınızı daxil edin">
                                        <span class="text-danger error-text surname_error"></span>
                                    </div>
                                </div>
                            </div>
							
							<div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Başlıq daxil edin" minLength="3" maxLength="200">
                                <span class="text-danger error-text title_error"></span>
                            </div>

                            @php $cate = DB::table('categories')->where('category_state','active')->get(); @endphp
                            <div class="form-group">
                                <select class="form-control" name="selectCategory" id="selectCategory">
                                    <option>Kateqoriya seçin</option>
                                    @foreach ($cate as $cat_item)                                        
                                        <option value="{{$cat_item->category_id}}">{{$cat_item->category_title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text selectCategory_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <select class="form-control" name="selectSubcategory" id="selectSkills">
                                    <option>Alt kateqoriya seçin</option>
                                </select>
                                <span class="text-danger error-text selectSubcategory_error"></span>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" aria-describedby="phoneHelp" placeholder="Nümunə: 0551234567" minLength="10" maxLength="10">
                                <small id="phoneHelp" class="form-text text-muted ml-1">Əlaqəsi nömrəsi ilə heç kim ilə paylaşılmayacaq</small>
                                <span class="text-danger error-text phone_error"></span>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" rows="7" placeholder="İş vəya xidmət təklifiniz barədə ətraflı məlumat daxil edin" name="message"></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>

                            <div class="custom-file">
                                <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
                                <label class="custom-file-label" for="images">Şəkil seçin</label>
                                <span class="text-danger error-text imageFile_error"></span>
                            </div>

                            <div class="user-image my-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>

                            <div class="alert" id="alert-noti"></div>

                            <button type="submit" class="btn uza-btn mt-2">Sorğunu Göndər</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                            <span class="brand-text">AZloli.com </span>                        
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
                                <div class="get-a-quote mx-2">
                                    <div data-toggle="modal" data-target="#searchModal" class="btn uza-btn">İşçi Axtar</div>
                                    <div data-toggle="modal" data-target="#personModal" class="btn uza-btn">İş Təklifi Ver</div>
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
                                        <span> <img src="{{asset('front/')}}/img/icons/profile.svg" alt="" width="50" height="30"> <span class="text_login">İş tap / Qeydiyyat</span> </span>
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