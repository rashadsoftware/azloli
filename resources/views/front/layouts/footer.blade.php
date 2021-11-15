        <!-- ***** Footer Area Start ***** -->
        <footer class="footer-area section-padding-80-0">
            <div class="container">
                <div class="row justify-content-between">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-md-6">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h4 class="widget-title" style="text-decoration:underline">Bizimlə Əlaqə</h4>

                            <!-- Footer Content -->
                            <div class="footer-content mb-15">
                                <h3>(+994){{$config->getPhoneAttribute()}}</h3>
                                <p>{{$config->config_address}} <br> {{$config->config_email}}</p>
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

                                @if($config->config_whatsapp !='')
                                <a href="{{$config->config_whatsapp}}" class="whatsapp" data-toggle="tooltip" data-placement="top" title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-md-6 text-md-right">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h4 class="widget-title" style="text-decoration:underline">Haqqımızda</h4>
                            <p>{{$config->config_shortdescription}}</p>

                            <!-- Copywrite Text -->
                            <div class="copywrite-text mb-30">
                                <p>&copy; Copyright <script>document.write(new Date().getFullYear());</script> | {{$config->config_title}}.</p>
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
        <!-- LightBox -->
        <script src="{{asset('front/')}}/plugins/lightbox2-2.11.3/lightbox.js"></script>
        <!-- Masonry -->
        <script src="{{asset('front/')}}/js/masonry.pkgd.js"></script>
        <!-- Active js -->
        <script src="{{asset('front/')}}/js/default-assets/active.js"></script>
        <!-- Main js -->
        <script src="{{asset('front/')}}/js/main.js"></script>
		
		<script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			$(function(){				
				$('#top_search_bar').keyup(function(){ 
                    var query = $(this).val();
                    
                    if(query != ''){
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:"{{ route('autocomplete') }}",
                            method:"POST",
                            data:{query:query, _token:_token},
                            success:function(data){
                                $('#categoryList').fadeIn();  
                                $('#categoryList').html(data);
                            }
                        });
                    }
                });

                $(document).on('click', '.ulCateList li', function(){  
                    $('#top_search_bar').val($.trim($(this).text()));  
                    $('#categoryList').fadeOut();  
                }); 

                // dependent dropdown using AJAX
                $("#selectCategory").change(function (e) {
                    e.preventDefault();
                    var cateDropdown = document.getElementById("selectCategory").value;

                    $.ajax({
                        type: "POST",
                        url: "category/fetch",
                        data: { cateID: cateDropdown },
                        success: function (response) {
                            var districtDropdown = "";
                            var msg = response.content;

                            if (response.status == "success") {
                                $.each(msg, function (key, value) {
                                    districtDropdown +=
                                        "<option value='" +
                                        key +
                                        "' >" +
                                        value +
                                        "</option>";
                                });
                            } else {
                                districtDropdown += "<option value=''>" + msg + "</option>";
                            }

                            document.getElementById("selectSkills").innerHTML =
                                districtDropdown;
                        },
                    });
                });
			})
		</script>

		@yield('js')
    </body>

</html>