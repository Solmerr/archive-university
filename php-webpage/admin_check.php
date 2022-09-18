<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if ($_SESSION['isadmin'] == 1) {
	header("Location: admin/admin_panel.php");
} else {
	header("Location: home.php");
}
?>