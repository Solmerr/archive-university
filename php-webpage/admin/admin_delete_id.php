<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

$id = $_GET['id'];
$_SESSION['admin_userid'] = $id;

if ($stmt = mysqli_prepare($connection, 'SELECT * FROM users WHERE id = ?')) {
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $admin, $username, $password, $email, $date_register);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
} else {
	echo "Could not prepare statement!";
	header('Location: admin_read.php');
}
?>