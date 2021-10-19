@include('chat.layouts.header')
	<body>
		<div class="wrapper">
			<section class="chat-area">
				<header>
					<a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
					<img src="images/Rashad Alakbarov.png" alt="">
					<div class="details">
						<span>Rashad Alakbarov</span>
						<p>Active now</p>
					</div>
				</header>
				<div class="chat-box">
					<div class="chat outgoing">
						<div class="details">
							<p>Burada sizin mesaj olacaq.</p>
						</div>
					</div>
					<div class="chat incoming">
						<img src="images/Rashad Alakbarov.png" alt="">
						<div class="details">
							<p>Burada isə digər şəxsin mesajı olacaq</p>
						</div>
					</div>
				</div>
				<form action="#" class="typing-area">
					<input type="text" class="incoming_id" name="incoming_id" value="2" hidden>
					<input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
					<button><i class="fab fa-telegram-plane"></i></button>
				</form>
			</section>
		</div>

		<script src="js/chat.js"></script>
	</body>
</html>
