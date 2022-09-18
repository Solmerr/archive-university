<?php
require('edit_img_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Edit image description</title>
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
						<h2>Edit Image Description</h2>
					</div>
				<div class="main_help"></div>
					<div class="content">
						<form action="edit_img_desc.php?id=<?php echo $imageid; ?>" method="post" autocomplete="off">
							<label for="new_description">New description</label><br><br>
							<textarea name="new_description" id="new_description" maxlength="50"></textarea><br><br>
							<input type="submit" value="Edit Description" class="upsubmit">
						</form>
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