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

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('front/')}}/style.css">
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
                                    <!--
                                    <li><a href="#">Kateqoriyalar</a>
                                        <ul class="dropdown">
                                            <li><a href="./index.html">- Home</a></li>
                                            <li><a href="./about.html">- About</a></li>
                                            <li><a href="./services.html">- Services</a></li>
                                            <li><a href="./portfolio.html">- Portfolio</a></li>
                                            <li><a href="./portfolio-single.html">- Single Portfolio</a></li>
                                            <li><a href="./blog.html">- Blog</a></li>
                                            <li><a href="./single-blog.html">- Blog Details</a></li>
                                            <li><a href="./contact.html">- Contact</a></li>
                                            <li><a href="#">- Dropdown</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                    <li><a href="#">- Dropdown Item</a>
                                                        <ul class="dropdown">
                                                            <li><a href="#">- Even Dropdown</a></li>
                                                            <li><a href="#">- Even Dropdown</a></li>
                                                            <li><a href="#">- Even Dropdown</a></li>
                                                            <li><a href="#">- Even Dropdown</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                    <li><a href="#">- Dropdown Item</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    -->
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
                                    <a href="#">Giriş /</a>
                                    <a href="#"><span> Qeydiyyat</span></a>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->