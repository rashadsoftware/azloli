@include('chat.layouts.header')
	<body>
		<div class="wrapper">
			<section class="form login">
				<header>Online Söhbət</header>
				<form action="{{route('chat.login.post')}}" method="POST" autocomplete="off" id="formLoginChat">
					@csrf

					<div class="error-noti"></div>
					
					<div class="field input">
						<label>E-poçt</label>
						<input type="text" name="email" placeholder="E-poçt ünvanınızı daxil edin">
						<span class="text-danger error-text email_error"></span>
					</div>
					<div class="field input">
						<label>Şifrə</label>
						<input type="password" name="password" placeholder="Şifrənizi daxil edin">
						<span class="text-danger error-text password_error"></span>
					</div>
					<div class="field button">
						<button type="submit">Söhbətə Başla</button>
						@if(Session::has('LoggedUser'))
						<a href="{{route('profile.dashboard')}}"class="btn btn-success mt-2" style="height:45px; font-size:18px; line-height:31px">Profilə keçid</a>
						@else
						<a href="{{route('index')}}"class="btn btn-success mt-2" style="height:45px; font-size:18px; line-height:31px">Sayta keçid</a>
						@endif
					</div>
				</form>
				@if(!Session::has('LoggedUser'))
				<div class="link">Qeydiyyatınız yoxdur? <a href="{{route('chat.index')}}">Qeydiyyatdan keç</a></div>
				@endif
			</section>
		</div>
	  
		<!-- Active js -->
        <script src="{{asset('chat/')}}/js/jquery.min.js"></script>
		<script src="{{asset('chat/')}}/js/bootstrap.min.js"></script>

		<script>
			$(function(){
				// login chat
				$("#formLoginChat").on("submit", function (e) {
					e.preventDefault();

					// login chat
					$.ajax({
						url: $(this).attr("action"),
						method: $(this).attr("method"),
						data: new FormData(this),
						processData: false,
						dataType: "json",
						contentType: false,
						beforeSend: function () {
							$(document).find("span.error-text").text("");
						},
						success: function (data) {
							if (data.status == 0) {
								$.each(data.error, function (prefix, val) {
									$("span." + prefix + "_error").text(val[0]);
								});
							} else if(data.status == 1) {
								$(".error-noti").css("display", "block");
								$(".error-noti").css("background", "#dc3545");
								$(".error-noti").css("border", "1px solid #dc3545");
								$(".error-noti").text(data.msg);
							} else {
								window.location = "{{ url('chat/users')}}";
							}
						},
					});
				});
			});
		</script>
	</body>
</html>