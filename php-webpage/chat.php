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
		<title>Chat</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
		  refreshChat();
		});

		function refreshChat(){
			$('#chat').load('updatechat.php', function(){
			   setTimeout(refreshChat, 5000);
			});
		}
		</script>
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
						<h2>Chat</h2>
					</div>
				<div class="main_help"></div>
					<div class="content">
						<div class="chat" id="chat">
							<!-- chat -->
						</div>
						<div class="border"></div>
						<div class="writemessage">
							<form action="sendmessage.php" name="sendmessage" id="sendmessage" method="post">
								<textarea name="message" id="message" maxlength="200"></textarea><br><br>
								<input type="submit" value="Send message" name="submit" id="submit">
							</form>
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