<?php
require('delete_img_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Delete Image</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="all">
			<header>
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
			</header>
			<div class="main_background">
				<div class="main_help"></div>
					<div class="main_title">
						<h2>Delete Image</h2>
					</div>
				<div class="main_help"></div>
					<div class="content delete">
						<h3>Are you sure you want to delete image?</h3>
						<div class="yesno">
							<a href="delete_img.php?id=<?=$_GET['id']?>&confirm=yes">Yes</a>
							<a href="delete_img.php?id=<?=$_GET['id']?>&confirm=no">No</a>
						</div>
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
