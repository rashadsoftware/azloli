@extends('front.layouts.header')

@section('title', 'İşçi Axtarma')

		<!-- ***** Login Area Start ***** -->
		<section class="position-relative" style="padding:120px 0">
			<!-- Background Curve -->
			<div class="background-curve">
				<img src="{{asset('front/')}}/img/core/curve-5.png" alt="curve header">
			</div>
			<div class="container">
				<div class="d-flex align-items-center justify-content-center" style="min-height:63vh">
					<div class="card box-shadow w-50">
						<div class="card-body">
							<h2 class="mb-4">İşçi Axtarma</h2>
							<form autocomplete="off" action="{{route('profile.update.password')}}" method="POST" id="formProfilePassword" class="mt-4 w-100">
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword">Kateqoriya</label>
                                <select class="form-control " name="exampleCategory" id="exampleCategory">
                                    <option value="">Kateqoriya seçin</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->category_id}}">{{$category->category_title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text oldPassword_error"></span>
                            </div>
                            
                            <button type="submit" class="btn btn-primary float-right mt-4">İşçi Axtar</button>        
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