@extends('front.layouts.master-profile')

@section('title', 'Şifrəni Unutdum')

@section('content')
		<!-- ***** Login Area Start ***** -->
		<section class="position-relative" style="padding:120px 0">
			<div class="container">
				<div class="d-flex align-items-center justify-content-center" style="min-height:63vh">
					<div class="card box-shadow" style="max-width:400px">
						<div class="card-body">
							<h2 class="mb-4" style="font-size:26px">Şifrəni Unutdum</h2>
                            
							<form action="{{route('password.forgot.post')}}" method="post" autocomplete="off">
								@csrf
								
								@if($message=Session::get('failForgot'))
								<div class="w-100 mt-1 j_Alert">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
								@endif

                                @if($message=Session::get('successForgot'))
								<div class="w-100 mt-1 j_Alert">
									<div class="alert alert-success">
										{{ $message }}
									</div>
								</div>
								@endif
							
								<div class="row">
									<div class="col-lg-12 mb-3">
										<div class="form-group">
                                            <label for="emailForgot">E-poçt</label>
											<input type="email" id="emailForgot" class="form-control @error('email') is-invalid @enderror mb-1" name="email" placeholder="E-poçtunuzu daxil edin" value="{{old('email')}}">
											<span class="text-danger">@error('email') {{$message}} @enderror</span>
										</div>
									</div>
                                    
									<div class="col-12 d-flex align-items-center justify-content-between">
										<button class="btn uza-btn btn-3 mr-1">Şifrə Linkini Göndər</button>
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