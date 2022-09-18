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
		<title>Admin Create Success</title>
	</head>
	<body>
		<div>
			<h3>New account created!</h3>
			<button onclick="window.location.href = 'admin_panel.php';">Back to panel</button>
		</div>
	</body>
</html>