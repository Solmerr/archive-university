<?php
require('admin_delete_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Admin Delete</title>
	</head>
	<body>
		<div>
			<button onclick="window.location.href = 'admin_read.php';">Back to panel</button>
		</div>
		<div>		
			<h3>Are you sure, you want to delete account:</h3>
			<h3><?php echo $username ?></h3>
			<h3>If so please write "Yes" and press "Delete account".</h3>
		</div>
		<div>
			<form action="admin_delete_delete.php" method="post" autocomplete="off">
				<label for="delete"></label><br>
				<input type="text" name="delete" id="delete" maxlength="3"><br>
				<input type="submit" value="Delete account">
			</form>
		</div>
	</body>
</html>