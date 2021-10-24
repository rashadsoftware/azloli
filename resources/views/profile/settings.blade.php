@extends('profile.layouts.master')

@section('title', 'Tənzimləmələr')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('profile.dashboard')}}"><i class="fa fa-home"></i> Ana Səhifə</a></li>
@endsection

@section('content')    
	
	<div class="alert" id="alert-noti"></div>
	
	<div class="w-100">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ümumi</a>
				<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Şəkil</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Şifrə</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<form autocomplete="off" action="{{route('profile.update.optional')}}" method="POST" class="mt-4" id="formProfileOptional">
					@method('PUT')
					@csrf
					<div class="form-group">
						<label for="exampleUser">İstifadəçi adı</label>
						<input type="text" class="form-control" id="exampleUser" name="exampleUser" placeholder="İstifadəçi adını daxil edin" value="{{$user->user_name}}"/>
						<span class="text-danger error-text exampleUser_error"></span>
					</div>
					<div class="form-group">
						<label for="exampleEmail">Email</label>
						<input type="email" class="form-control" id="exampleEmail" name="exampleEmail" placeholder="Email ünvanınızı daxil edin" value="{{$user->user_email}}"/>
						<span class="text-danger error-text exampleEmail_error"></span>
					</div>
					<div class="form-group">
						<label for="exampleAddress">Ünvan</label>
						<input type="text" class="form-control" id="exampleAddress" name="exampleAddress" placeholder="Ünvanınızı daxil edin" value="{{$user->user_address}}"/>
						<span class="text-danger error-text exampleAddress_error"></span>
					</div>
					<div class="form-group">
						<label for="userPhone">Telefon</label>
						<input type="text" class="form-control" id="userPhone" name="userPhone" placeholder="Əlaqə nömrəsini daxil edin" value="{{$user->user_phone}}"  minlength=10 maxlength=10 />
						<span class="text-danger error-text userPhone_error"></span>
					</div>
					<div class="form-group">
						<label for="exampleTextArea">Özünüz haqqında</label>
						<textarea rows="8" class="form-control" id="exampleTextArea" name="exampleTextArea" placeholder="Özünüz haqqında ətraflı məlumat daxil edin">{{$user->user_description}}</textarea>
						<span class="text-danger error-text exampleTextArea_error"></span>
					</div>
					
					<button type="submit" class="btn btn-primary float-right">Məlumatları Yenilə</button>
				</form>
			</div>
			<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				<form enctype="multipart/form-data" action="{{route('profile.update.image')}}" method="POST" id="formProfileImage" class="mt-4">
					@method('PUT')
					@csrf
					<div class="form-inline">
						<input class="form-control" type="file" name="user_image" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">                                            
						<button type="submit" class="btn btn-primary ml-3">Şəkil Yerləşdir</button>
					</div>  
					<span class="text-danger error-text user_image_error"></span>                                                        
				</form>
				<img id="preview" alt="profile" width="100" height="100" class="mt-4" src="{{asset('front/')}}/img/icons/profile.svg" />
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<form autocomplete="off" action="{{route('profile.update.password')}}" method="POST" id="formProfilePassword" class="mt-4">
					@method('PUT')
					@csrf
					<div class="form-group">						
						<label for="oldPassword">Köhnə şifrə</label>
						<div class="position-relative">
							<input type="password" class="form-control settPassword" name="oldPassword" placeholder="Köhnə şifrənizi daxil edin"/>
							<i class="fa fa-eye position-absolute" id="setting_eye"></i>
						</div>
						<span class="text-danger error-text oldPassword_error"></span>											
					<div class="form-group">
						<label for="newpassword">Yeni şifrə</label>
						<input type="password" class="form-control settPassword" name="newpassword" placeholder="Yeni şifrənizi daxil edin"/>
						<span class="text-danger error-text newpassword_error"></span>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Təkrar şifrə</label>
						<input type="password" class="form-control settPassword" name="password_confirmation" placeholder="Yeni şifrənizi təkrarlayın"/>
						<span class="text-danger error-text password_confirmation_error"></span>
					</div>
					
					<button type="submit" class="btn btn-primary float-right">Məlumatları Yenilə</button>
				</form>
			</div>
		</div>
	</div>    
@endsection