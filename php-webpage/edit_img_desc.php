<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$newdescription = strip_tags($_POST['new_description']);
$imageid = $_GET['id'];

if (isset($_GET['id'])) {
	if ($stmt = mysqli_prepare($connection, 'SELECT user_id FROM gallery WHERE image_id = ?')) {
		mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user_id);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if ($_SESSION['id'] != $user_id) {	
			$_SESSION['error_msg'] = "Cannot edit image description!";
			$_SESSION['redirect'] = "home.php";
			header("location: error_handling.php");
			exit();		
		} else {
			if ($stmt = mysqli_prepare($connection, 'UPDATE gallery SET description = ? WHERE image_id = ?')) {
				mysqli_stmt_bind_param($stmt, 'si', $newdescription, $imageid);
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
		}
	} else {
		$_SESSION['error_msg'] = "Could not prepare statement!";
		$_SESSION['redirect'] = "home.php";
		header("location: error_handling.php");
		exit();
	}
}
?>