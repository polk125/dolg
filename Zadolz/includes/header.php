<script src="js/responsive_nav.js"></script>
<header class="header-wrapper">
	<div class="container header">
		 <!-- <div class="header-logo">
			<img src="img/logo.png"> 
		</div>  -->
		<!-- <div class="header-bars">
			<i class="fas fa-bars"></i>
		</div> -->
		<div class="header-navigation">
			<nav>
				<ul>
					<li><a href="index.php" class="link-secondary">Главная</a></li>
					<li><a href="contacts.php" class="link-secondary">Лекции</a></li>
					<li><a href="contacts.php" class="link-secondary">Контакты</a></li>
					<li><a href="auth.php" class="btn btn-outline-primary"><i class="fas fa-user"></i>
					<?php
					if(isset($_COOKIE[user])){
						include ('db.php');
						$result = mysqli_query($conn, "SELECT surname FROM users WHERE id='$_COOKIE[user]'");
						$user_array = mysqli_fetch_assoc($result);
						$surname = $user_array['surname'];
						echo $surname;
					}else{
					 	echo 'Личный кабинет';
					}
					?></a></li>
				</ul>
			</nav>
		</div>
	</div>			
</header>