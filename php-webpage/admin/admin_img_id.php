<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

$imageid = $_GET['imgid'];

$data = [];
if ($stmt = mysqli_prepare($connection, 'SELECT gallery.image_id, gallery.path, gallery.description, gallery.date_upload, gallery.user_id, users.username FROM gallery INNER JOIN users ON gallery.user_id = users.id WHERE image_id = ?')) {
	mysqli_stmt_bind_param($stmt, "i", $imageid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $image_id, $path, $description, $date_upload, $user_id, $username);
	
	while(mysqli_stmt_fetch($stmt)) {
		$data[] = array(
						'image_id'=>$image_id,
						'path'=>"../".$path,
						'description'=>$description,
						'date_upload'=>$date_upload,
						'user_id'=>$user_id,
						'username'=>$username
						); 
	}
	mysqli_stmt_close($stmt);
} else {
	echo "Could not prepare statement!";
}
?>