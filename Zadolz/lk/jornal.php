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
	<link rel="stylesheet" href="css/journ.css">
	<title>Задолжености | Журнал</title>
</head>
<body>
		<?php include("includes/sidebar.php"); ?>
		<div class="wrapper main">
			<?php include("includes/navbar.php"); ?>
			<main>
			<?php if($_COOKIE['role']==3){ ?>	
			<a class="typejourn" href=jornal.php?type=class>Таблица по классам</a>
			
			<a class="typejourn" href=jornal.php?type=object>Таблица по предметам</a>
			<?php } ?>
			<form method="post" class="journ_month" id="MyForm">
				Месяц 
				<select name="journ_month" onchange="document.getElementById('MyForm').submit()">
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='9'){echo"selected";}}elseif(date("m")==9){echo 'selected';}?> value="9">Сентябрь</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='10'){echo"selected";}}elseif(date("m")==10){echo 'selected';}?> value="10">Октябрь</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='11'){echo"selected";}}elseif(date("m")==11){echo 'selected';}?> value="11">Ноябрь</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='12'){echo"selected";}}elseif(date("m")==12){echo 'selected';}?> value="12">Декабрь</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='1'){echo"selected";}}elseif(date("m")==1){echo 'selected';}?> value="1">Январь</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='2'){echo"selected class=selected";}}elseif(date("m")==2){echo 'selected';}?> value="2">Февраль</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='3'){echo"selected";}}elseif(date("m")==3){echo 'selected';}?> value="3">Март</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='4'){echo"selected";}}elseif(date("m")==4){echo 'selected';}?> value="4">Апрель</option>
				<option <?php if(isset($_POST['journ_month'])){if($_POST['journ_month']==='5'){echo"selected";}}elseif(date("m")==5){echo 'selected';}?> value="5">Май</option>
				</select>
				</form>
				<p>Доступные для ввода: 2, 3, 4, 5, Н - отсутствовал</p>
				<?php
			if(!isset($_GET[type])||$_GET['type']=='class'){

				echo '<h1>Таблица по вашим классам</h1>';
				include("includes/get_journ_classes.php");
		}else{
			echo '<h1>Таблица по предметам</h1>';
			include("includes/get_journ_obj.php");
		?>


			</main>
			
		</div>
		<?php 
			include("includes/modal.php");
		}
			?>
</body>
</html>