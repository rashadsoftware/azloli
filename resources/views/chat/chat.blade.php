@include('chat.layouts.header')
	<body>
		<div class="wrapper">
			<section class="chat-area">
				@if(session()->has('LoggedUser'))
				<header>
					<a href="{{route('chat.users')}}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
					<img src="{{asset('chat/')}}/images/icons/profile.svg" alt="{{$user->getOwnerMerge->owner_username}}">
					<div class="details">
						<span>{{$user->getOwnerMerge->owner_username}}</span>
						<p class="mb-0">{{$user->getOwnerMerge->getOwnerOnlineAttrribute()}}</p>
					</div>
				</header>
				<div class="chat-box">
					@if($sendsCount > 0)
						@foreach($sends as $send)
						<div class="chat incoming">
							<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$user->getUserMerge->user_name}}">
							<div class="details">
								<p>{{$send->message_text}}</p>
							</div>
						</div>
						@endforeach
					@endif

					@if($inboxsCount > 0)
						@foreach($inboxs as $inbox)
						<div class="chat outgoing">						
							<div class="details">
								<p>{{$inbox->message_text}}</p>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<form action="#" class="typing-area">
					@csrf
					<input type="text" class="incoming_id" name="incoming_id" value="{{$user->getOwnerMerge->owner_id}}" hidden>
					<input type="text" name="message" class="input-field" placeholder="Mesajınızı daxil edin..." autocomplete="off">
					<button><i class="fab fa-telegram-plane"></i></button>
				</form>				
				@else 
				<header>
					<a href="{{route('chat.users')}}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
					@if($user->getUserMerge->user_image == "")
						<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$user->getUserMerge->user_name}}">
					@else 
						<img src="{{asset('front/')}}/img/user/{{$user->getUserMerge->user_image}}" alt="{{$user->getUserMerge->user_name}}">
					@endif
					<div class="details">
						<span>{{$user->getUserMerge->user_name}}</span>
						<p class="mb-0">{{$user->getUserMerge->getUserOnlineAttrribute()}}</p>
					</div>
				</header>
				<div class="chat-box">
					@if($sendsCount > 0)
						@foreach($sends as $send)
						<div class="chat outgoing">
							<div class="details">
								<p>{{$send->message_text}}</p>
							</div>
						</div>
						@endforeach
					@endif

					@if($inboxsCount > 0)
						@foreach($inboxs as $inbox)
						<div class="chat incoming">
						@if($user->getUserMerge->user_image == "")
							<img src="{{asset('front/')}}/img/icons/profile.svg" alt="{{$user->getUserMerge->user_name}}">
						@else 
							<img src="{{asset('front/')}}/img/user/{{$user->getUserMerge->user_image}}" alt="{{$user->getUserMerge->user_name}}">
						@endif
							<div class="details">
								<p>{{$inbox->message_text}}</p>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<form action="{{route('chat.insert')}}" class="typing-area" method="post" id="chatForm">
					@csrf
					<input type="text" class="incoming_id" name="incoming_id" value="{{$user->getUserMerge->user_id}}" hidden>
					<input type="text" name="message" class="input-field" placeholder="Mesajınızı daxil edin..." autocomplete="off">
					<button type="submit"><i class="fab fa-telegram-plane"></i></button>
				</form>
				@endif
			</section>
		</div>

		<!-- Active js -->
        <script src="{{asset('chat/')}}/js/jquery.min.js"></script>
		<script src="{{asset('chat/')}}/js/bootstrap.min.js"></script>
		<script src="{{asset('chat/')}}/js/chat.js"></script>
	</body>
</html>
