<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$message = strip_tags($_POST['message']);

if (empty($message)) {
  header("Location: chat.php");
  exit();
} else {
	if ($stmt = mysqli_prepare($connection, 'INSERT INTO messages (content, user_id) VALUES (?, ?)')) {
		mysqli_stmt_bind_param($stmt, 'si', $message, $_SESSION['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("Location: chat.php");
		exit();
	} else {
		$_SESSION['error_msg'] = "Could not prepare statement!";
		$_SESSION['redirect'] = "search.php";
		header("location: error_handling.php");
		exit();
	}
}
?>