<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	die ('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	die ('Please complete the registration form');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	die ('Email is not valid!');
}
if (preg_match('/^[A-Za-z0-9]+$/', $_POST['username']) == 0) {
	die ('Username is not valid!');
}
if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 5) {
	die ('Password must be between 5 and 50 characters long!');
}

if ($stmt = mysqli_prepare($connection, 'SELECT id, password FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if ($stmt->num_rows > 0) {
		echo 'Username exists, please choose another!';
	} else {
		if ($stmt = mysqli_prepare($connection, 'INSERT INTO users (username, password, email) VALUES (?, ?, ?)')) {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt, 'sss', $_POST['username'], $password, $_POST['email']);
			mysqli_stmt_execute($stmt);
			$username = $_POST['username'];
			if ($stmt2 = mysqli_prepare($connection, 'SELECT id FROM users WHERE username=?')) {
				mysqli_stmt_bind_param($stmt2, 's', $_POST['username']);
				mysqli_stmt_execute($stmt2);
				mysqli_stmt_bind_result($stmt2, $newid);
				mysqli_stmt_fetch($stmt2);
				mysqli_stmt_close($stmt2);
				mkdir("../images/".$newid, 0700);
			} else {
				echo 'Error - new gallery path cannot be created!';
			}
			header("location: admin_create_success.php");
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