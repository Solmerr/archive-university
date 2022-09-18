<?php
session_start();
require_once('connection.php');

if (!isset($_POST['username'], $_POST['password'])) {
	$_SESSION['error_msg'] = 'Please fill both the username and password field!';
	$_SESSION['redirect'] = "index.php";
	header("location: error_handling_login.php");
	exit();
}

if ($stmt = mysqli_prepare($connection, 'SELECT id, password, isadmin, email FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if ($stmt->num_rows > 0) {
		mysqli_stmt_bind_result($stmt, $id, $password, $isadmin, $email);
		mysqli_stmt_fetch($stmt);
		if (password_verify($_POST['password'], $password)) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['username'];
			$_SESSION['id'] = $id;
			$_SESSION['user_id'] = "";
			$_SESSION['isadmin'] = $isadmin;
			$_SESSION['email'] = $email;
			$_SESSION['error_msg'] = "";
			$_SESSION['redirect'] = "home.php";
			mysqli_stmt_close($stmt);
			header('Location: home.php');
			exit();
		} else {
			$_SESSION['error_msg'] = 'Incorrect username or password!';
			$_SESSION['redirect'] = "index.php";
			header("location: error_handling_login.php");
			exit();
		}
	} else {
		$_SESSION['error_msg'] = 'Incorrect username or password!';
		$_SESSION['redirect'] = "index.php";
		header("location: error_handling_login.php");
		exit();
	}
}
?>
