<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$data = [];
if ($stmt = mysqli_prepare($connection, 'SELECT gallery.image_id, gallery.path, gallery.description, gallery.date_upload, gallery.user_id, users.username FROM gallery INNER JOIN users ON gallery.user_id = users.id')) {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $image_id, $path, $description, $date_upload, $user_id, $username);
	
	while(mysqli_stmt_fetch($stmt)) {
		$data[] = array(
						'image_id'=>$image_id,
						'path'=>$path,
						'description'=>$description,
						'date_upload'=>$date_upload,
						'user_id'=>$user_id,
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