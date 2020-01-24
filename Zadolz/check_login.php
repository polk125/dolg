<?php
	include ('db.php');
	if (empty(trim($_POST['auth_login'])) || empty(trim($_POST['auth_password']))) {
		echo "Заполните все поля!";
	} else {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE login='".mb_strtolower($_POST['auth_login'], 'utf-8')."'");
		$user_array = mysqli_fetch_assoc($result);
		if (mb_strtolower($_POST['auth_login'], 'utf-8')==$user_array['login'] && md5($_POST['auth_password'])==$user_array['password']) {
			setcookie("user", $user_array['id']);
			setcookie("role", $user_array['role']);
			echo 'Ok';
		} else {
			echo 'Неверный логин или пароль!';
		}
	}
	mysqli_close($conn);
?>