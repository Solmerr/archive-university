<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();


if ($stmt = mysqli_prepare($connection, 'DELETE FROM gallery WHERE image_id = ?')) {
	mysqli_stmt_bind_param($stmt, 'i', $_GET['imgid']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("Location: admin_main_page.php");
	exit();
} else {
	echo "Could not prepare statement!";
}
?>