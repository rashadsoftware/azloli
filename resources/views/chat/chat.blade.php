@include('chat.layouts.header')
	<body>
		<div class="wrapper">
			<section class="chat-area">
				@if(session()->has('LoggedUser'))
					<header>
						<div class="d-flex align-items-center">
							<a href="{{route('chat.users')}}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
							<img src="{{asset('chat/')}}/images/icons/profile.svg" alt="{{$user->getOwnerMerge->owner_username}}">
							<div class="details">
								<span>{{$user->getOwnerMerge->owner_username}}</span>
								<p class="mb-0">{{$user->getOwnerMerge->getOwnerOnlineAttrribute()}}</p>
							</div>
						</div>					
					</header>
					<div class="chat-box" style="background:url('{{asset('chat/')}}/images/chat_background.png'); background-repeat: no-repeat; background-size:cover">
						
					</div>
					<form action="{{route('chat.insert')}}" method="POST" class="typing-area" id="formInsertMessage">
						@csrf
						<input type="text" class="incoming_id" name="incoming_id" value="{{$user->getOwnerMerge->owner_id}}" hidden>
						<input type="text" name="message" class="input-field" placeholder="Mesajınızı daxil edin..." autocomplete="off">
						<button type="submit"><i class="fab fa-telegram-plane"></i></button>
					</form>				
				@else 
					<header>
						<div class="d-flex align-items-center">
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
						</div>					
					</header>
					<div class="chat-box" style="background:url('{{asset('chat/')}}/images/chat_background.png'); background-repeat: no-repeat; background-size:cover">
						
					</div>
					<form action="{{route('chat.insert')}}" method="POST" class="typing-area" id="formInsertMessage">
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
		
		<script>
			const form = document.querySelector(".typing-area"),
			incoming_id = form.querySelector(".incoming_id").value,
			inputField = form.querySelector(".input-field"),
			sendBtn = form.querySelector("button"),
			chatBox = document.querySelector(".chat-box");

			// form submit
			form.onsubmit = (e)=>{
				e.preventDefault();
			}

			// send button active when input field focus
			inputField.focus();
			inputField.onkeyup = ()=>{
				if(inputField.value != ""){
					sendBtn.classList.add("active");
				}else{
					sendBtn.classList.remove("active");
				}
			}

			// insert Message
			$(function(){
				$("#formInsertMessage").on("submit", function (e) {
					e.preventDefault();

					$.ajax({
						url: $(this).attr("action"),
						method: $(this).attr("method"),
						data: new FormData(this),
						processData: false,
						dataType: "json",
						contentType: false,
						success: function (data) {
							if(data.status == "ok"){
								inputField.value = "";
								scrollToBottom();
							}						
						},
					});
				});
			})
			

			// chatbox add active class when on mouseenter
			chatBox.onmouseenter = ()=>{
				chatBox.classList.add("active");
			}

			// chatbox remove active class when on mouseleave
			chatBox.onmouseleave = ()=>{
				chatBox.classList.remove("active");
			}

			// setInterval for get Data
			setInterval(() =>{
				let xhr = new XMLHttpRequest();
				token = document.querySelector('meta[name="csrf-token"]').content;
				xhr.open("POST", "get", true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				xhr.setRequestHeader('X-CSRF-TOKEN', token);
				xhr.onload = ()=>{
				if(xhr.readyState === XMLHttpRequest.DONE){
					if(xhr.status === 200){
						let data = xhr.response;
						chatBox.innerHTML = data;
						if(!chatBox.classList.contains("active")){
							scrollToBottom();
						}
					}
				}
				}
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send("incoming_id="+incoming_id);
			}, 500);

			// scrollbottom
			function scrollToBottom(){
				chatBox.scrollTop = chatBox.scrollHeight;
			}
		</script>
	</body>
</html>
