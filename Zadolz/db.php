<?php
	$host = 'localhost';
	$user = 'root';
	$pwsd = "";
	$db = 'zadolz'; 
	$conn = mysqli_connect($host, $user, $pwsd, $db);
	mysqli_query($conn, "SET NAMES utf8")
?>