<?php
session_start();
require_once('connection.php');

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	$_SESSION['error_msg'] = 'Please complete the registration form!';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	$_SESSION['error_msg'] = 'Please complete the registration form';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	$_SESSION['error_msg'] = 'Email is not valid!';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}
if (preg_match('/^[A-Za-z0-9]+$/', $_POST['username']) == 0) {
	$_SESSION['error_msg'] = 'Username is not valid!';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}
if (strlen($_POST['password']) > 50 || strlen($_POST['password']) < 5) {
	$_SESSION['error_msg'] = 'Password must be between 5 and 50 characters long!';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}

if ($stmt = mysqli_prepare($connection, 'SELECT id, password FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, 's', $_POST['username']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	if ($stmt->num_rows > 0) {
		$_SESSION['error_msg'] = 'Username exists, please choose another!';
		$_SESSION['redirect'] = "register.html";
		header("location: error_handling_login.php");
		exit();
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
				mkdir("images/".$newid, 0700);
			} else {
				$_SESSION['error_msg'] = 'Error - new gallery path cannot be created!';
				$_SESSION['redirect'] = "register.html";
				header("location: error_handling_login.php");
				exit();
			}
			header("location: index.php");
			exit();
			
		} else {
			$_SESSION['error_msg'] = 'Could not prepare statement!';
			$_SESSION['redirect'] = "register.html";
			header("location: error_handling_login.php");
			exit();
		}
	}
	mysqli_stmt_close($stmt);
} else {
	$_SESSION['error_msg'] = 'Could not prepare statement!';
	$_SESSION['redirect'] = "register.html";
	header("location: error_handling_login.php");
	exit();
}
mysqli_close($connection);
?>