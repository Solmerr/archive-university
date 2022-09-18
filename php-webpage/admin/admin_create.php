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
		<title>Admin Create</title>
	</head>
	<body>
		<div>
			<button onclick="window.location.href = 'admin_panel.php';">Back to panel</button>
		</div>
		<div>
			<h3>Create new account</h3>
			<form action="admin_create_2.php" method="post" autocomplete="off">
				<input type="text" name="username" placeholder="Username" id="username" required>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" value="Create new account"><br><br>
			</form>
		</div>
	</body>
</html>