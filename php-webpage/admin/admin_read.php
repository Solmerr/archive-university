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
		<title>Admin Read</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
		$(document).ready(function() {
			$("#submit").click(function() {
				var username = $("input").val();
				$.post("admin_read_search.php", {username: username}, function(result) {
					$("#result").html(result);
				});
			});
		});
		</script>
	</head>
	<body>
		<div>
			<button onclick="window.location.href = 'admin_panel.php';">Back to panel</button>
		</div>
		<div>
			<h3>Search account</h3>
			<input type="text" autocomplete="off" placeholder="Search user..." name="username" id="username"> 
			<input type="submit" value="Search User" name="submit" id="submit"><br><br>
		</div>
		<div id="result"></div>
	</body>
</html>