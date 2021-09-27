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
                    