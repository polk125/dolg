<?php
	if(!isset($_COOKIE['user'])) {
		header( 'Location: ../auth.php' );
	}
?>