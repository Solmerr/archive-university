<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (preg_match('/[0-1]/', $_POST['isadmin']) == 0) {
	die ('Only 0 and 1 are valid!');
}

$admin = $_POST['isadmin'];
$userid = $_SESSION['admin_userid'];

if ($stmt = mysqli_prepare($connection, 'UPDATE users SET isadmin = ? WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'si', $admin, $userid);
	mysqli_stmt_execute($stmt);
	header("location: admin_update.php?id=".$userid."");
	exit();
} else {
	echo 'Could not prepare statement!';
}
mysqli_stmt_close($stmt);
?>