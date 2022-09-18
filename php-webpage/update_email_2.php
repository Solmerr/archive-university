<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$_SESSION['error_msg'] = "Email is not valid!";
	$_SESSION['redirect'] = "update_email.php";
	header("location: error_handling.php");
	exit();
}

$email = $_POST['email'];

if ($stmt = mysqli_prepare($connection, 'UPDATE users SET email = ? WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'si', $email, $_SESSION['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	$_SESSION['email'] = $email;
	header("location: profile.php");
	exit();
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "update_email.php";
	header("location: error_handling.php");
	exit();
}
?>