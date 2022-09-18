<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

$userid = $_GET['id'];
$_SESSION['admin_userid'] = $userid;

if ($stmt = mysqli_prepare($connection, 'SELECT * FROM users WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, 'i', $userid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $admin, $username, $password, $email, $date_register);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
} else {
	echo 'Could not prepare statement!';
}
?>