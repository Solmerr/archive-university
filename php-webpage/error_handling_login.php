<?php
session_start();
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body class="errorbackground">
			<div class="errorlogin">
				<div class="main_background">
					<div class="main_help"></div>
						<div class="main_title">
							<h2>Error!</h2>
							<h3><?=$_SESSION['error_msg']?></h3>
						</div>
							<div class="main_help"></div>
						<div class="aftererrorlogin">
							<button onclick="location.href='<?=$_SESSION['redirect']?>';">Back</button>
						</div>
				</div>
			</div>
	</body>
</html>

<?php
$_SESSION['error_msg'] = "";
$_SESSION['redirect'] = "home.php";
?>