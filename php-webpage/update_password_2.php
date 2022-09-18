<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 5) {
	$_SESSION['error_msg'] = "Password must be between 5 and 50 characters long!";
	$_SESSION['redirect'] = "update_password.php";
	header("location: error_handling.php");
	exit();
}

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($stmt = mysqli_prepare($connection, 'UPDATE users SET password = ? WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'si', $password, $_SESSION['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: profile.php");
	exit();
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "update_password.php";
	header("location: error_handling.php");
	exit();
}
?>