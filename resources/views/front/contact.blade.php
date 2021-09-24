@extends('front.layouts.master')

@section('title', 'Əlaqə')

@section('content')
            <!-- ***** Breadcrumb Area Start ***** -->
    <div class="breadcrumb-area">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcumb--con">
                        <h2 class="title">Əlaqə</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Əlaqə</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Curve -->
        <div class="breadcrumb-bg-curve">
            <img src="{{asset('front/')}}/img/core/curve-5.png" alt="">
        </div>
    </div>
    <!-- ***** Breadcrumb Area End ***** -->

    <!-- ***** Contact Area Start ***** -->
    <section class="uza-contact-area section-padding-80">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Contact Form -->
                <div class="col-12 col-lg-8">
                    <div class="uza-contact-form mb-80">
                        <div class="contact-heading mb-50">
                            <h4>Bizə göstərdiyiniz maraq üçün sizə təşəkkür edirik.</h4>
                            <h5 class="text-muted">Hər hansı bir təklifiniz vəya iradınız varsa, aşağıdakı formu doldurub bizə göndərin.</h5>
                        </div>
                        <form action="{{route('contact.post')}}" method="POST" autocomplete="off" id="formContact">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Adınız">
                                        <span class="ml-3 text-danger error-text name_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="surname" placeholder="Soyadınız">
                                        <span class="ml-3 text-danger error-text surname_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email addresiniz">
                                        <span class="ml-3 text-danger error-text email_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone" placeholder="Əlaqə nömrəniz | Məs: 0501234578" minlength=10 maxlength=10 >
                                        <span class="ml-3 text-danger error-text phone_error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="theme" placeholder="Mövzu başlığı">
                                        <span class="ml-3 text-danger error-text theme_error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="10" cols="30" placeholder="İsmarıcınız" style="height:auto"></textarea>
                                        <span class="ml-3 text-danger error-text message_error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn uza-btn btn-3 mt-15">Göndər</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Single Contact Card -->
                <div class="col-12 col-lg-3">
                    <div class="contact-sidebar-area mb-80">
                        <!-- Single Sidebar Area -->
                        <div class="single-contact-card mb-50">
                            <h4>Bizimlə Əlaqə</h4>
                            <h3>(+994){{$config->getPhoneAttribute()}}</h3>
                            <h6>{{$config->config_email}}</h6>
                            <h6>{{$config->config_address}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Google Maps -->
                <div class="col-12">
                    <div class="google-maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11956.9355465873!2d24.0768412544878!3d56.9550599906977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46eecfb0e5073ded%3A0x400cfcd68f2fe30!2z4Kaw4Ka_4KaX4Ka-LCDgprLgp43gpq_gpr7gpp_gp43gpq3gpr_gpoY!5e0!3m2!1sbn!2sbd!4v1543911160102" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Area End ***** -->
@endsection