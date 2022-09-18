<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (preg_match('/Yes/', $_POST['delete']) == 0) {
	die ('Wrong code!');
}

$delete = $_POST['delete'];
$userid = $_SESSION['admin_userid'];

if ($stmt = mysqli_prepare($connection, 'DELETE FROM users WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'i', $userid);
	mysqli_stmt_execute($stmt);
	header("location: admin_read.php");
	exit();
} else {
	echo 'Could not prepare statement!';
}
mysqli_stmt_close($stmt);
?>