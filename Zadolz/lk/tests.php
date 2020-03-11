<?php include("includes/check_auth.php");
if($_COOKIE['role']==4||$_COOKIE['role']==5){
	header('Location: index.php');
}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/test.css">
	<link rel="stylesheet" href="css/journ.css">
	<link rel="shortcut icon" href="../images/gre-logo.ico" type="image/x-icon">
	<title>Задолжености | Тесты</title>
</head>
<body>
	<script src="scripts/show_sidebar.js"></script>
		<?php include("includes/sidebar.php"); ?>
		<div class="wrapper">
			<?php include("includes/navbar.php"); ?>
			<main>
			<?php if($_COOKIE['role']==3){ ?>	
			<a class="typejourn" href=tests.php>Все тесты</a>
			<a class="typejourn" href=tests.php?tests=new>Создать новый тест</a>
			<?php } ?>
			<?php
			if(!isset($_GET['tests'])){
			echo '<h1>Все тесты</h1>';
			include("includes/renderTests.php");;
			}else{
			echo '<h1>Создать новый тест</h1>';
			include("includes/addTest.php");
			}
			 ?>
			</main>
		</div>
</body>
</html>