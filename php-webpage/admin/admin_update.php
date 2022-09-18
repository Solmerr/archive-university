<?php
require('admin_update_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Admin Update</title>
	</head>
	<body>
		<div>
			<button onclick="window.location.href = 'admin_read.php';">Back to panel</button>
		</div>
		<div>		
			<h3>Update account</h3>
			<fieldset>
			
				<legend>Account data</legend>
					<form action="admin_update_status.php" method="post" autocomplete="off">
						<label for="isadmin">Admin</label><br>
						<input type="text" name="isadmin" id="isadmin" maxlength="1" value="<?php echo $admin; ?>"><br>
						<input type="submit" value="Update account status"><br><br>
					</form>
					
					<form action="admin_update_username.php" method="post" autocomplete="off">
						<label for="username">Username</label><br>
						<input type="text" name="username" id="username" maxlength="20" value="<?php echo $username; ?>"><br>
						<input type="submit" value="Update username"><br><br>
					</form>
					
					<form action="admin_update_password.php" method="post" autocomplete="off">						
						<label for="password">Password</label><br>
						<input type="text" name="password" id="password" maxlength="50"><br>
						<input type="submit" value="Update password"><br><br>
					</form>
			
					<form action="admin_update_email.php" method="post" autocomplete="off">
						<label for="email">Email</label><br>
						<input type="email" name="email" id="email" maxlength="50" value="<?php echo $email; ?>"><br>
						<input type="submit" value="Update email"><br><br>
					</form>	
					
			</fieldset>
		</div>
	</body>
</html>