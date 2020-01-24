<?php include("includes/check_auth.php"); ?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/zadol.css">
	<link rel="shortcut icon" href="../images/gre-logo.ico" type="image/x-icon">
	<title>Задолжености | Почта</title>
</head>
<body>
	<script src="scripts/show_sidebar.js"></script>
		<?php include("includes/sidebar.php"); ?>
		<div class="wrapper">
			<?php include("includes/navbar.php"); ?>
			<main>
        <?php include("includes/zadol.php"); ?>
			</main>
		</div>
</body>
</html>