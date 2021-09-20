        <!-- ***** Footer Area Start ***** -->
        <footer class="footer-area section-padding-80-0">
            <div class="container">
                <div class="row justify-content-between">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-md-6">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h4 class="widget-title">Bizimlə Əlaqə</h4>

                            <!-- Footer Content -->
                            <div class="footer-content mb-15">
                                <h3>(+994){{$config->getPhoneAttribute()}}</h3>
                                <p>{{$config->config_address}} <br> {{$config->config_email}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-md-6 text-md-right">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h4 class="widget-title">Haqqımızda</h4>
                            <p>{{$config->config_description}}</p>

                            <!-- Copywrite Text -->
                            <div class="copywrite-text mb-30">
                                <p>&copy; Copyright <script>document.write(new Date().getFullYear());</script> | {{$config->config_title}}.</p>
                            </div>

                            <!-- Social Info -->
                            <div class="footer-social-info">
                                @if($config->config_facebook !='')
                                <a href="{{$config->config_facebook}}" class="facebook" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                                @endif

                                @if($config->config_twitter !='')
                                <a href="{{$config->config_twitter}}" class="twitter" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                                @endif

                                @if($config->config_pinterest !='')
                                <a href="{{$config->config_pinterest}}" class="pinterest" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                @endif

                                @if($config->config_instagram !='')
                                <a href="{{$config->config_instagram}}" class="instagram" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                                @endif

                                @if($config->config_youtube !='')
                                <a href="{{$config->config_youtube}}" class="youtube" data-toggle="tooltip" data-placement="top" title="YouTube"><i class="fa fa-youtube-play"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
        <!-- ***** Footer Area End ***** -->

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

    </body>

</html>