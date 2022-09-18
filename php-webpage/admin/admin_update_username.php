<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (preg_match('/^[A-Za-z0-9]+$/', $_POST['username']) == 0) {
	die ('Username is not valid!');
}

$username = $_POST['username'];
$userid = $_SESSION['admin_userid'];

if ($stmt = mysqli_prepare($connection, 'SELECT id, password FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {
		if ($stmt = mysqli_prepare($connection, 'UPDATE users SET username = ? WHERE id = ?')) {
			mysqli_stmt_bind_param($stmt, 'si', $username, $userid);
			mysqli_stmt_execute($stmt);
			header("location: admin_update.php?id=".$userid."");
			exit();
		} else {
			echo 'Could not prepare statement!';
		}
	}
	mysqli_stmt_close($stmt);
} else {
	echo 'Could not prepare statement!';
}
?>