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
		if ($_SESSION['id'] == $user_id) {
			if (isset($_GET['confirm'])) {
				if ($_GET['confirm'] == 'yes') {
					if ($stmt = mysqli_prepare($connection, 'DELETE FROM gallery WHERE image_id = ?')) {
						mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_close($stmt);
						header("Location: home.php");
						exit();
					} else {
						$_SESSION['error_msg'] = "Could not prepare statement!";
						$_SESSION['redirect'] = "home.php";
						header("location: error_handling.php");
						exit();
					}
				} else {
					header("Location: home.php");
					exit();
				}
			}
		} else {
			$_SESSION['error_msg'] = "Cannot delete image!";
			$_SESSION['redirect'] = "home.php";
			header("location: error_handling.php");
			exit();
		}
	} else {
		$_SESSION['error_msg'] = "Could not prepare statement!";
		$_SESSION['redirect'] = "home.php";
		header("location: error_handling.php");
		exit();
	}
}
?>