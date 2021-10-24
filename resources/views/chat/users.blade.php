@include('chat.layouts.header')	
	<body>
		<div class="wrapper">
			<section class="users">
				@if(session()->has('LoggedUser'))
				<header>
					<div class="content">
						@if($user->user_image == "")
							<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$user->user_name}}">
						@else
							<img src="{{asset('front/')}}/img/user/{{$user->user_image}}" alt="{{$user->user_name}}">
						@endif						
						<div class="details">
							<span>{{$user->user_name}}</span>
							<div class="status-dot online d-flex align-items-center pl-0">
								<i class="fas fa-circle mr-1"></i> 
								<span style="font-size:15px">{{$user->getUserOnlineAttrribute()}}</span> 
							</div>
						</div>
					</div>
					<div class="d-flex">
						<a href="{{route('profile.dashboard')}}" class="logout mr-1">Profilə keçid</a>
						<a href="{{route('chat.logout')}}" class="logout">Logout</a>
					</div>					
				</header>
				<div class="search">
					<span class="text">Söhbətə başlamaq üçün istifadəçi seçin</span>
					<input type="text" placeholder="İstifadəçi adı daxil edin..." id="search" name="search">
					<button><i class="fas fa-search"></i></button>
				</div>
				<div class="users-list">
					
				</div>
				@else
				<header>
					<div class="content">
						<img src="{{asset('chat/')}}/images/icons/profile.svg" alt="{{$user->owner_username}}">
						<div class="details">
							<span>{{$user->owner_username}}</span>
							<div class="status-dot online d-flex align-items-center pl-0">
								<i class="fas fa-circle mr-1"></i> 
								<span style="font-size:15px">{{$user->getOwnerOnlineAttrribute()}}</span> 
							</div>
						</div>
					</div>
					<div class="d-flex">
						<a href="{{route('index')}}" class="logout mr-1">Sayta keçid</a>
						<a href="{{route('chat.logout')}}" class="logout">Logout</a>
					</div>
				</header>
				<div class="search">
					<span class="text">Söhbətə başlamaq üçün istifadəçi seçin</span>
					<input type="text" placeholder="İstifadəçi adı daxil edin..." id="search" name="search">
					<button><i class="fas fa-search"></i></button>
				</div>
				<div class="users-list">
					
				</div>
				@endif
			</section>
		</div>

		<!-- Active js -->
        <script src="{{asset('chat/')}}/js/jquery.min.js"></script>
		<script src="{{asset('chat/')}}/js/bootstrap.min.js"></script>

		<script>
			const searchBar = document.querySelector(".search input"),
			searchIcon = document.querySelector(".search button"),
			usersList = document.querySelector(".users-list");

			// search icon click
			searchIcon.onclick = ()=>{
				searchBar.classList.toggle("show");
				searchIcon.classList.toggle("active");
				searchBar.focus();
				if(searchBar.classList.contains("active")){
					searchBar.value = "";
					searchBar.classList.remove("active");
				}
			}

			// setInterval for every 5 second
			setInterval(() =>{
				let xhr = new XMLHttpRequest();
				xhr.open("GET", "users/updateList", true);
				xhr.onload = ()=>{
					if(xhr.readyState === XMLHttpRequest.DONE){
						if(xhr.status === 200){
						let data = xhr.response;
						if(!searchBar.classList.contains("active")){
							usersList.innerHTML = data;
						}
						}
					}
				}
				xhr.send();
			}, 500);

			// search section 
			$(document).ready(function(){

				fetch_customer_data();

				function fetch_customer_data(query = '') {
					let searchTerm = searchBar.value;
					if(searchTerm != ""){
						searchBar.classList.add("active");
					} else{
						searchBar.classList.remove("active");
					}

					$.ajax({
						url:"{{ route('chat.users.action') }}",
						method:'GET',
						data:{query:query},
						dataType:'json',
						success:function(data){
							$('.users-list').html(data.table_data);
						}
					})
				}

				$(document).on('keyup', '#search', function(){
					var query = $(this).val();
					fetch_customer_data(query);
				});
			});
		</script>
	</body>
</html>
