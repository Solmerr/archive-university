<?php
if ($_SERVER['PHP_SELF'] == "/strona/admin/checkstatus.php") {
	die();
}

function check_admin() {
	if ((!isset($_SESSION['loggedin'])) or ($_SESSION['isadmin'] == 0)) {
		header('Location: ../index.php');
		exit();
	}
}
?>