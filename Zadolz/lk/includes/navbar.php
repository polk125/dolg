<header>
	<nav class="navbar">
		<div class="navbar-user">
			<?php
				include ('db.php');
				$result = mysqli_query($conn, "SELECT login FROM users WHERE id='$_COOKIE[user]'");
				$user_array = mysqli_fetch_assoc($result);
				$role = $user_array['login'];
				echo $role;
			?>
		</div>
		<div class="navbar-logout">
			<a href="../auth.php?logout=yes"><i class="fas fa-sign-out-alt"></i> <span>Выйти</span></a>
		</div>
	</nav>
</header>