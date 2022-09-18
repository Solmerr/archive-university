<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if ($stmt = mysqli_prepare($connection, 'SELECT username, email, id FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $_SESSION['name']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $username, $email, $id);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "home.php";
	header("location: error_handling.php");
	exit();
}

$data = [];
if ($stmt = mysqli_prepare($connection, 'SELECT gallery.image_id, gallery.path, gallery.description, gallery.date_upload, users.username FROM gallery INNER JOIN users ON gallery.user_id = users.id WHERE user_id = ?')) {
	mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $image_id, $path, $description, $date_upload, $username);
	
	while(mysqli_stmt_fetch($stmt)) {
		$data[] = array(
						'image_id'=>$image_id,
						'path'=>$path,
						'description'=>$description,
						'date_upload'=>$date_upload,
						'username'=>$username
						); 
	}
	mysqli_stmt_close($stmt);
} else {
	$_SESSION['error_msg'] = "Could not prepare statement!";
	$_SESSION['redirect'] = "home.php";
	header("location: error_handling.php");
	exit();
}
?>