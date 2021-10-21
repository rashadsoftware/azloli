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
					<a href="{{route('chat.logout')}}" class="logout">Logout</a>
				</header>
				<div class="search">
					<span class="text">Select an user to start chat</span>
					<input type="text" placeholder="Enter name to search...">
					<button><i class="fas fa-search"></i></button>
				</div>
				<div class="users-list">
					@if($usersCount > 0)
						@foreach($users as $userItem)
						<a href="#" class="">
							<div class="content">
								<img src="{{asset('front/')}}/img/icons/profile.svg" alt="">
								<div class="details">
									<span>{{$userItem->getOwnerMerge->owner_username}}</span>
								</div>
							</div>
							@if($userItem->getOwnerMerge->owner_online == 'online')
							<div class="status-dot online"><i class="fas fa-circle"></i></div>
							@else 
							<div class="status-dot offline"><i class="fas fa-circle"></i></div>
							@endif
						</a>
						@endforeach
					@else 
						Söhbət etmək üçün heç bir istifadəçi yoxdur
					@endif
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
					<a href="{{route('chat.logout')}}" class="logout">Logout</a>
				</header>
				<div class="search">
					<span class="text">Söhbətə başlamaq üçün istifadəçi seçin</span>
					<input type="text" placeholder="İstifadəçi adı daxil edin...">
					<button><i class="fas fa-search"></i></button>
				</div>
				<div class="users-list">
					@if($usersCount > 0)
						@foreach($users as $userItem)
						<a href="#" class="">
							<div class="content">
								@if($userItem->getUserMerge->user_image == '')
								<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$userItem->getUserMerge->user_name}}">
								@else
								<img src="{{asset('front/')}}/img/user/{{$userItem->getUserMerge->user_image}}" alt="{{$userItem->getUserMerge->user_name}}">
								@endif
								<div class="details">
									<span>{{$userItem->getUserMerge->user_name}}</span>
								</div>
							</div>
							@if($userItem->getUserMerge->user_online == 'online')
							<div class="status-dot online"><i class="fas fa-circle"></i></div>
							@else 
							<div class="status-dot offline"><i class="fas fa-circle"></i></div>
							@endif
						</a>
						@endforeach
					@else 
						Söhbət etmək üçün heç bir istifadəçi yoxdur
					@endif
				</div>
				@endif
			</section>
		</div>

		<!-- Active js -->
        <script src="{{asset('chat/')}}/js/jquery.min.js"></script>
		<script src="{{asset('chat/')}}/js/bootstrap.min.js"></script>
		
		<script>
			$(function(){
				// toggle show hide search input
				const searchBar = document.querySelector(".search input"),
				searchIcon = document.querySelector(".search button"),
				usersList = document.querySelector(".users-list");

				searchIcon.onclick = ()=>{
				  searchBar.classList.toggle("show");
				  searchIcon.classList.toggle("active");
				  searchBar.focus();
				  if(searchBar.classList.contains("active")){
					searchBar.value = "";
					searchBar.classList.remove("active");
				  }
				}

				setInterval(function() {
					window.location.reload();
				}, 3000);
			});
		</script>
	</body>
</html>
