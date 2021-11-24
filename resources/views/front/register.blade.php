@extends('front.layouts.master-profile')

@section('title', 'Qeydiyyat')

@section('content')
		<!-- ***** Login Area Start ***** -->
		<section class="position-relative" style="padding:120px 0">
			<div class="container">
				<div class="d-flex align-items-center justify-content-center" style="min-height:63vh">
					<div class="card box-shadow" style="max-width:400px">
						<div class="card-body">
							<h2 class="mb-4">Qeydiyyat</h2>
							<form action="{{route('register.post')}}" method="post" autocomplete="off">
								@csrf
								
								@if($message=Session::get('failRegister'))
								<div class="w-100 mt-1">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
								@endif
							
								<div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
											<input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="İstifadəçi adınız" value="{{old('username')}}">
											<span class="text-danger">@error('username') {{$message}} @enderror</span>
										</div>
                                    </div>
									<div class="col-lg-12">
										<div class="form-group">
											<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-poçt" value="{{old('email')}}">
											<span class="text-danger">@error('email') {{$message}} @enderror</span>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Şifrə">                                        
											<span class="text-danger">@error('password') {{$message}} @enderror</span>
										</div>
									</div>
                                    <div class="col-lg-12">
										<div class="form-group">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Təkrar Şifrə">                                        
											<span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
										</div>
									</div>
                                    
									<div class="col-12 d-flex align-items-center justify-content-between">
										<button class="btn uza-btn btn-3">Qeydiyyat</button>
                                        <a href="{{route('login')}}" class="text-muted mx-auto">Hesabınız var?</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ***** Login Area End ***** -->

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
        <!-- Main js -->
        <script src="{{asset('front/')}}/js/main.js"></script>
    </body>
</html>
@endsection