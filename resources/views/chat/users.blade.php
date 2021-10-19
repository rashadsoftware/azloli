@include('chat.layouts.header')
	<body>
		<div class="wrapper">
			<section class="users">
				<header>
					<div class="content">
						<img src="images/Rashad Alakbarov.png" alt="">
						<div class="details">
							<span>Rashad Alakbarov</span>
							<p>Active now</p>
						</div>
					</div>
					<a href="#" class="logout">Logout</a>
				</header>
				<div class="search">
					<span class="text">Select an user to start chat</span>
					<input type="text" placeholder="Enter name to search...">
					<button><i class="fas fa-search"></i></button>
				</div>
				<div class="users-list">
					<a href="#">
						<div class="content">
							<img src="images/Rashad Alakbarov.png" alt="">
							<div class="details">
								<span>Rashad Alakbarov</span>
								<p>Sizin mesajınız</p>
							</div>
						</div>
						<div class="status-dot online"><i class="fas fa-circle"></i></div>
					</a>
					
					<a href="#">
						<div class="content">
							<img src="images/Rashad Alakbarov.png" alt="">
							<div class="details">
								<span>Rashad Alakbarov</span>
								<p>Sizin mesajınız</p>
							</div>
						</div>
						<div class="status-dot offline"><i class="fas fa-circle"></i></div>
					</a>
				</div>
			</section>
		</div>

		<script src="js/users.js"></script>
	</body>
</html>
