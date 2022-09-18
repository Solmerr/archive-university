<?php
session_start();
require_once('../connection.php');
require('checkstatus.php');
check_admin();

$username = $_POST['username'];

if ($stmt = mysqli_prepare($connection, 'SELECT * FROM users WHERE username = ?')) {
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $id, $admin, $username, $password, $email, $date_register);
	mysqli_stmt_fetch($stmt);
	if ($id != 0) {
		echo "ID: " . $id . "<br><br>";
		echo "ADMIN: " . $admin . "<br><br>";
		echo "USERNAME: " . $username . "<br><br>";
		echo "PASSWORD: " . $password . "<br><br>";
		echo "EMAIL: " . $email . "<br><br>";
		echo "DATE_REGISTER: " . $date_register . "<br><br>";	
		echo "<a href='admin_update.php?id=".$id."'>Update account</a><br><br>";
		echo "<a href='admin_delete.php?id=".$id."'>Delete account</a><br><br>";
	} else {
		echo "0 results found!";
	}
	mysqli_stmt_close($stmt);
} else {
	echo "Could not prepare statement!";
}
?>