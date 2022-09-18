<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$userid = "";
$messageid = $_GET['messageid'];

if (isset($_GET['messageid'])) {
	if ($stmt = mysqli_prepare($connection, 'SELECT user_id FROM messages WHERE message_id = ?')) {
		mysqli_stmt_bind_param($stmt, 'i', $messageid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user_id);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);
		if (($_SESSION['id'] == $user_id) or ($_SESSION['isadmin'] == 1)) {
			if ($stmt = mysqli_prepare($connection, 'DELETE FROM messages WHERE message_id = ?')) {
				mysqli_stmt_bind_param($stmt, 'i', $messageid);
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
		} else {
			$_SESSION['error_msg'] = "Cannot delete this message!";
			$_SESSION['redirect'] = "search.php";
			header("location: error_handling.php");
			exit();
		}
	} else {
		$_SESSION['error_msg'] = "Could not prepare statement!";
		$_SESSION['redirect'] = "search.php";
		header("location: error_handling.php");
		exit();
	}
}
?>