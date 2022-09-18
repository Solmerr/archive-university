<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}

$email = $_POST['email'];
$userid = $_SESSION['admin_userid'];

if ($stmt = mysqli_prepare($connection, 'UPDATE users SET email = ? WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'si', $email, $userid);
	mysqli_stmt_execute($stmt);
	header("location: admin_update.php?id=".$userid."");
	exit();
} else {
	echo 'Could not prepare statement!';
}
mysqli_stmt_close($stmt);
?>