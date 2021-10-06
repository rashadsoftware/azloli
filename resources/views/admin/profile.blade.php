@extends('admin.layouts.master')

@section('title', 'Profile')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5 col-xl-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($user->user_image == '')
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('back/')}}/img/icons/user.jpg" alt="{{$user->user_name}}">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('back/')}}/img/users/{{$user->user_image}}" alt="{{$user->user_name}}">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$user->user_name}}</h3>

                            <p class="text-muted text-center">Administrator</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>ID</b> <a class="float-right">{{$user->user_id}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$user->user_email}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Durum</b> <a class="float-right">{{$user->getUserStatusAttrribute()}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-12 col-md-7 col-xl-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Şəxsi Məlumatlar</a></li>
                                <li class="nav-item"><a class="nav-link" href="#parametres" data-toggle="tab">Profil Şəkilləri</a></li>
                                <li class="nav-item"><a class="nav-link" href="#advert" data-toggle="tab">Şifrə Yenilənməsi</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <form autocomplete="off" action="{{route('admin.profile.update.optional', $user->user_id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleUser">İstifadəçi adı</label>
                                            <input type="text" class="form-control @error('exampleUser') is-invalid @enderror" id="exampleUser" name="exampleUser" placeholder="İstifadəçi adını daxil edin" value="{{$user->user_name}}"/>
                                            <span class="text-danger">@error('exampleUser') {{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleEmail">Email</label>
                                            <input type="email" class="form-control @error('exampleEmail') is-invalid @enderror" id="exampleEmail" name="exampleEmail" placeholder="Email ünvanınızı daxil edin" value="{{$user->user_email}}"/>
                                            <span class="text-danger">@error('exampleEmail') {{$message}} @enderror</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleUserIP">IP ünvan</label>
                                            <input type="text" class="form-control @error('exampleUserIP') is-invalid @enderror" id="exampleUserIP" name="exampleUserIP" placeholder="IP ünvanınızı daxil edin" value="{{$user->user_ip}}"/>
                                            <span class="text-danger">@error('exampleUserIP') {{$message}} @enderror</span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary float-right">Məlumatları Yenilə</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="parametres">
                                    <form enctype="multipart/form-data" action="{{route('admin.profile.update.image', $user->user_id)}}" method="POST" id="formUserImage">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-inline">
                                            <input class="form-control" type="file" name="user_image" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">                                            
                                            <button type="submit" class="btn btn-primary ml-3">Şəkil Yerləşdir</button>
                                        </div>  
                                        <span class="text-danger error-text user_image_error"></span>                                                        
                                    </form>
                                    <img id="preview" alt="profile" width="100" height="100" class="mt-4" src="{{asset('back/')}}/img/icons/user.jpg" />
                                </div>

                                <div class="tab-pane" id="advert">
                                    <form autocomplete="off" action="{{route('admin.profile.update.password', $user->user_id)}}" method="POST" id="formChangePassword">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="oldPassword">Köhnə şifrə</label>
                                            <input type="password" class="form-control" name="oldPassword" placeholder="Köhnə şifrənizi daxil edin"/>
                                            <span class="text-danger error-text oldPassword_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword">Yeni şifrə</label>
                                            <input type="password" class="form-control" name="newpassword" placeholder="Yeni şifrənizi daxil edin"/>
                                            <span class="text-danger error-text newpassword_error"></span>
                                        </div>
										<div class="form-group">
                                            <label for="password_confirmation">Təkrar şifrə</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Yeni şifrənizi təkrar daxil edin"/>
                                            <span class="text-danger error-text password_confirmation_error"></span>
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
    <script>
        $(function(){
            $("#formUserImage").on('submit', function(e){
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

            $("#formChangePassword").on('submit', function(e){
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
                        } else if(data.status == 2) {
                            // $('#formSocialCompany')[0].reset();
                            toastr.error(data.msg, data.state);
                        } else {
                            window.location.href = "{!! route('admin.logout'); !!}";
                        }
                    }
                });
            });
        });
    </script>
@endsection