@extends('admin.layouts.master')

@section('title', 'Sayt Tənzimləmələri')

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 col-xl-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($configs->config_logo == '')
                                    <img class="profile-user-img img-fluid border-0 mb-2" src="{{asset('back/')}}/img/icons/company.jpg" alt="$configs->config_title">
                                @else
                                    <img class="profile-user-img img-fluid border-0 mb-2" src="{{asset('front/')}}/img/{{$configs->config_logo}}" alt="{{$configs->config_title}}">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$configs->config_title}}</h3>

                            <p class="text-muted text-center">Biznes Saytı</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$configs->config_email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Telefon</b> <a class="float-right">(+994){{$configs->getPhoneAttribute()}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Ünvan</b> <a class="float-right">{{$configs->config_address}}</a>
                                </li>
                                <p class="mt-3">{{$configs->config_description}}</p>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-12 col-md-7 col-xl-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Ümumi Məlumatlar</a></li>
                                <li class="nav-item"><a class="nav-link" href="#parametres" data-toggle="tab">Şəkillər</a></li>
                                <li class="nav-item"><a class="nav-link" href="#advert" data-toggle="tab">Sosial Hesablar</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <form autocomplete="off" action="{{route('admin.settings.ajax.optional')}}" method="POST" id="formOptionalCompany">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="companyTitle">Şirkətin adı</label>
                                            <input type="text" class="form-control" name="companyTitle" placeholder="Şirkətin adını daxil edin" value="{{$configs->config_title}}" />
                                            <span class="text-danger error-text companyTitle_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyEmail">E-poçt</label>
                                            <input type="email" class="form-control" name="companyEmail" placeholder="Şirkətin Email ünvanını daxil edin" value="{{$configs->config_email}}"/>
                                            <span class="text-danger error-text companyEmail_error"></span>
                                        </div>
										<div class="form-group">
                                            <label for="companyEmail2">E-poçt 2</label>
                                            <input type="email" class="form-control" name="companyEmail2" placeholder="Şirkətin ehtiyyat email ünvanını daxil edin" value="{{$configs->config_email2}}"/>
                                            <span class="text-danger error-text companyEmail2_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyPhone">Telefon</label>
                                            <input type="text" class="form-control" name="companyPhone" placeholder="Əlaqə nömrəsini daxil edin" value="{{$configs->config_phone}}" minlength=10 maxlength=10/>
                                            <span class="text-danger error-text companyPhone_error"></span>
                                        </div>
										<div class="form-group">
                                            <label for="companyPhone2">Telefon 2</label>
                                            <input type="text" class="form-control" name="companyPhone2" placeholder="Birinci rezerv əlaqə nömrəsini daxil edin" value="{{$configs->config_phone2}}" minlength=10 maxlength=10/>
                                            <span class="text-danger error-text companyPhone2_error"></span>
                                        </div>
										<div class="form-group">
                                            <label for="companyPhone3">Telefon 3</label>
                                            <input type="text" class="form-control" name="companyPhone3" placeholder="İkinci rezerv əlaqə nömrəsini daxil edin" value="{{$configs->config_phone3}}" minlength=10 maxlength=10/>
                                            <span class="text-danger error-text companyPhone3_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyAddress">Hüquqi Ünvan</label>
                                            <input type="text" class="form-control" name="companyAddress" placeholder="Şirkətin ünvanını daxil edin" value="{{$configs->config_address}}"/>
                                            <span class="text-danger error-text companyAddress_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyShortDescription">Qısa Məlumat</label>
                                            <textarea name="companyShortDescription" cols="30" rows="5" placeholder="Şirkət haqqında qısa məlumat daxil edin" class="form-control" maxlength="200" minlength="5">{{$configs->config_shortdescription}}</textarea>
                                            <span class="text-danger error-text companyShortDescription_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyDescription">Ətraflı Məlumat</label>
                                            <textarea name="companyDescription" cols="30" rows="10" placeholder="Şirkət haqqında ətraflı məlumat daxil edin" class="form-control" id="summernote">{{$configs->config_description}}</textarea>
                                            <span class="text-danger error-text companyDescription_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyVideoRolik">Video Rolik</label>
                                            <input type="text" class="form-control" name="companyVideoRolik" placeholder="Şirkətin video rolik linkini daxil edin" value="{{$configs->config_video_rolik}}"/>
                                            <span class="text-danger error-text companyVideoRolik_error"></span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary float-right">Məlumatları Yenilə</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="parametres">
                                    <form enctype="multipart/form-data" action="{{route('admin.settings.ajax.logo')}}" method="POST" class="mb-3" id="formLogoCompany">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-inline">
                                            <input class="form-control" type="file" name="companyLogo" onchange="document.getElementById('previewLogo').src = window.URL.createObjectURL(this.files[0])">                                            
                                            <button type="submit" class="btn btn-primary ml-3">Logo Yerləşdir</button>
                                        </div>  
                                        <span class="text-danger error-text companyLogo_error"></span>                                                       
                                    </form>
                                    <form enctype="multipart/form-data" action="{{route('admin.settings.ajax.favicon')}}" method="POST" id="formFaviconCompany">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-inline">
                                            <input class="form-control" type="file" name="companyFavicon" onchange="document.getElementById('previewFavicon').src = window.URL.createObjectURL(this.files[0])">                                            
                                            <button type="submit" class="btn btn-primary ml-3">Favicon Yerləşdir</button>
                                        </div>  
                                        <span class="text-danger error-text companyFavicon_error"></span>                                                    
                                    </form>
                                    @if($configs->config_logo == '')
                                        <img id="previewLogo" alt="logo" width="100" class="mt-4 mr-3" src="{{asset('front/')}}/img/logo.png" />
                                    @else
                                        <img id="previewLogo" alt="logo" width="100" class="mt-4 mr-3" src="{{asset('front/')}}/img/{{$configs->config_logo}}" />
                                    @endif

                                    @if($configs->config_favicon == '')
                                        <img id="previewFavicon" alt="favicon" width="100" class="mt-4" src="{{asset('front/')}}/img/favicon.png" />
                                    @else
                                        <img id="previewFavicon" alt="favicon" width="100" class="mt-4" src="{{asset('front/')}}/img/{{$configs->config_favicon}}" />
                                    @endif
                                </div>

                                <div class="tab-pane" id="advert">
                                    <form autocomplete="off" action="{{route('admin.settings.ajax.social')}}" method="POST" id="formSocialCompany">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="companyFacebook">Facebook</label>
                                            <input type="text" class="form-control" name="companyFacebook" placeholder="Facebook addressinizi daxil edin" value="{{$configs->config_facebook}}" />
                                            <span class="text-danger error-text companyFacebook_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyInstagram">İnstagram</label>
                                            <input type="text" class="form-control" name="companyInstagram" placeholder="İnstagram addressinizi daxil edin" value="{{$configs->config_instagram}}" />
                                            <span class="text-danger error-text companyInstagram_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyWhatsapp">Whatsapp</label>
                                            <input type="text" class="form-control" name="companyWhatsapp" placeholder="Whatsapp addressinizi daxil edin" value="{{$configs->config_whatsapp}}" />
                                            <span class="text-danger error-text companyWhatsapp_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyYoutube">Youtube</label>
                                            <input type="text" class="form-control" name="companyYoutube" placeholder="Youtube addressinizi daxil edin" value="{{$configs->config_youtube}}" />
                                            <span class="text-danger error-text companyYoutube_error"></span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary float-right">Məlumatları Yenilə</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('js')
<!-- summernote -->
<script src="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        $(function(){              
            $("#formOptionalCompany").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formOptionalCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });

            $("#formSocialCompany").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formSocialCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });

            $("#formLogoCompany").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formSocialCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });

            $("#formFaviconCompany").on('submit', function(e){
                e.preventDefault();
          
                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else{
                            // $('#formSocialCompany')[0].reset();
                            toastr.success(data.msg, data.state);
                        }
                    }
                });
            });

            // Summernote
            $('#summernote').summernote();
        });
    </script>
@endsection