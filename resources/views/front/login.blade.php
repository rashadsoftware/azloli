@extends('front.layouts.master-profile')

@section('title', 'Giriş')

@section('css')
	<style>
		#forgot-password{
			color: #6c757d;
			font-size:14px
		}
		#forgot-password:hover{
			text-decoration:underline
		}
	</style>
@endsection

@section('content')
		<!-- ***** Login Area Start ***** -->
		<section class="position-relative" style="padding:120px 0">
			<div class="container">
				<div class="d-flex align-items-center justify-content-center" style="min-height:63vh">
					<div class="card box-shadow" style="max-width:400px">
						<div class="card-body">
							<h2 class="mb-4">Giriş</h2>
							@if(!session()->has('successRegister') && !session()->has('failLogin'))
							<div class="alert alert-info text-center">İş tapmaq üçün qeydiyyatdan keçməlisiniz</div>
							@endif							
							<form action="{{route('login.post')}}" method="post" autocomplete="off">
								@csrf
								
								@if($message=Session::get('failLogin'))
								<div class="w-100 mt-1">
									<div class="alert alert-danger">
										{{ $message }}
									</div>
								</div>
								@endif

                                @if($message=Session::get('successRegister'))
								<div class="w-100 mt-1">
									<div class="alert alert-success">
										{{ $message }}
									</div>
								</div>
								@endif
							
								<div class="row">
									<div class="col-lg-12 mb-3">
										<div class="form-group">
											<input type="email" class="form-control @error('email') is-invalid @enderror mb-1" name="email" placeholder="E-poçt" value="{{old('email')}}">
											<span class="text-danger">@error('email') {{$message}} @enderror</span>
											<a href="{{route('password.forgot')}}" class="float-right" id="forgot-password">Şifrəni Unutdum</a>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="position-relative">
												<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Şifrə" id="loginPassword" value="{{old('password')}}">
												<i class="fa fa-eye position-absolute" id="login_eye"></i>
											</div>                                        
											<span class="text-danger">@error('password') {{$message}} @enderror</span>
										</div>
									</div>
                                    
									<div class="col-12 d-flex align-items-center justify-content-between">
										<button class="btn uza-btn btn-3">Giriş</button>
                                        <a href="{{route('register')}}" class="text-muted mx-auto">Qeydiyyatdan keç</a>
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