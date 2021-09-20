<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- site title & logo -->
        <title>Admin Panel | @yield('title', 'Welcome')</title>
        <link rel="icon" href="{{asset('back/')}}/img/AdminLTELogo.png">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('back/')}}/plugins/fontawesome-free/css/all.min.css">
        <!-- Toastr Laravel -->
        @toastr_css        
        @yield('css')
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('back/')}}/css/adminlte.min.css">

        <style>
            /* bootstrap table design */
            tr th {
                text-align: center;
            }
            tr td img {
                width: 70px;
                margin: 0 auto;
                display: block;
            }
            .form-control.is-invalid,
            .was-validated .form-control:invalid {
                background-image: none;
            }
        </style>
    </head>