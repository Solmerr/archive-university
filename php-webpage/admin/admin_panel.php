<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Admin panel</title>
	</head>
	<body>
		<div>
			<h3>BACK TO SITE</h3>
			<button onclick="window.location.href = '../home.php';">Home Page</button>
		</div>
		<div>
			<h3>USERS ADMINISTRATION</h3>
			<button onclick="window.location.href = 'admin_create.php';">Create User</button><br><br>
			<button onclick="window.location.href = 'admin_read.php';">Read / Update / Delete User</button><br><br>
		</div>
		<div>
			<h3>MAIN PAGE GALLERY</h3>
			<button onclick="window.location.href = 'admin_main_page.php';">Gallery panel</button>
		</div>
	</body>
</html>