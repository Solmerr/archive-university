<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: home.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link href="css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<div class="data">
					<label for="username">
					</label>
					<input type="text" name="username" placeholder="Username" id="username" required>
					<label for="password">
					</label>
					<input type="password" name="password" placeholder="Password" id="password" required>
					<input type="submit" value="Login">
					<button onclick="window.location.href='register.html'">Create account</button>
				</div>
			</form>
		</div>
	</body>
</html>