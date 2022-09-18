<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if (preg_match('/^[A-Za-z0-9]+$/', $_POST['username']) == 0) {
	$_SESSION['error_msg'] = "Username is not valid!";
	$_SESSION['redirect'] = "update_username.php";
	header("location: error_handling.php");
	exit();
}

$username = $_POST['username'];

if ($stmt = mysqli_prepare($connection, 'SELECT id, password FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if ($stmt->num_rows > 0) {
		$_SESSION['error_msg'] = "Username exists, please choose another!";
		$_SESSION['redirect'] = "update_username.php";
		header("location: error_handling.php");
		exit();
	} else {
		if ($stmt = mysqli_prepare($connection, 'UPDATE users SET username = ? WHERE id = ?')) {
			mysqli_stmt_bind_param($stmt, 'si', $username, $_SESSION['id']);
			mysqli_stmt_execute($stmt);
			$_SESSION['name'] = $username;
			$_SESSION['error_msg'] = "";
			header("location: profile.php");
			exit();
		} else {
			$_SESSION['error_msg'] = "Could not prepare statement!";
			$_SESSION['redirect'] = "update_username.php";
			header("location: error_handling.php");
			exit();
		}
	}
	mysqli_stmt_close($stmt);
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "update_username.php";
	header("location: error_handling.php");
	exit();
}
?>
