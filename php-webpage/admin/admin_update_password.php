<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 5) {
	die ('Password must be between 5 and 50 characters long!');
}

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$userid = $_SESSION['admin_userid'];

if ($stmt = mysqli_prepare($connection, 'UPDATE users SET password = ? WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'si', $password, $userid);
	mysqli_stmt_execute($stmt);
	header("location: admin_update.php?id=".$userid."");
	exit();
} else {
	echo 'Could not prepare statement!';
}
mysqli_stmt_close($stmt);
?>