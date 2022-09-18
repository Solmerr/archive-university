<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if (isset($_GET['id'])) {
	if ($stmt = mysqli_prepare($connection, 'SELECT user_id FROM gallery WHERE image_id = ?')) {
		mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user_id);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if ($_SESSION['id'] != $user_id) {			
			echo "Cannot edit image description!";
			header("Location: home.php");
			exit();
		} else {
			$imageid = $_GET['id'];
		}
	} else {
		$_SESSION['error_msg'] = "Could not prepare statement!";
		$_SESSION['redirect'] = "home.php";
		header("location: error_handling.php");
		exit();
	}
}
?>