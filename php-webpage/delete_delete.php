<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if (preg_match('/Yes/', $_POST['delete']) == 0) {
	$_SESSION['error_msg'] = "Wrong code!";
	$_SESSION['redirect'] = "delete.php";
	header("location: error_handling.php");
	exit();
}

if ($stmt = mysqli_prepare($connection, 'DELETE FROM users WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	$_SESSION['loggedin'] = "";
	$_SESSION['name'] = "";
	$_SESSION['id'] = "";
	$_SESSION['user_id'] = "";
	$_SESSION['isadmin'] = "";
	session_destroy();
	header("location: goodbye.html");
	exit();
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "delete.php";
	header("location: error_handling.php");
	exit();
}
?>