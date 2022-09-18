<?php
if ($_SERVER['PHP_SELF'] == "/strona/checklogin.php") {
	die();
}

function check() {
	if (!isset($_SESSION['loggedin'])) {
		header('Location: index.php');
		exit();
	}
}
?>