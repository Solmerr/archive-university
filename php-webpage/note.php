<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Create Note</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="all">
			<nav class="navigation">
				<div class="logo">
					<h1>PROJEKT V1</h1>
				</div>
				<div id="menu">
					<a href="mainpage.php">Main Page</a>
					<a href="search.php">Search</a>
					<a href="chat.php">Chat</a>
					<a href="note.php">Create Note</a>
					<a href="home.php">Home</a>
					<a href="profile.php"><?=$_SESSION['name']?></a>
					<a href="logout.php">Logout</a>
				</div>
			</nav>
			<div class="main_background">
				<div class="main_help"></div>
					<div class="main_title">
						<h2>Create PDF Note</h2>
					</div>
				<div class="main_help"></div>
					<div class="content">
						<fieldset class="fieldset">
							<legend>Note details</legend>
								<div class="pdf">
									<form action="generatepdf.php" method="post" autocomplete="off">
										<label for="title">Title:</label><br><br>
										<input type="text" name="title" id="title" maxlength="10"><br><br>
										<label for="note">Note:</label><br><br>
										<textarea name="note" id="note" maxlength="900"></textarea><br><br>
										<input type="submit" value="Download note as PDF file">
									</form>
								</div>
						</fieldset>
					</div>
			</div>
			<div class="main_help"></div>
			<div class="main_help"></div>
			<footer class="footer">
				<a href="admin_check.php">Definately not admin panel</a>
			</footer>
		</div>
	</body>
</html>
