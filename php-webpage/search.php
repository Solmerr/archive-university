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
		<title>Search user</title>
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script>
		$(document).ready(function(){
			$('.search_bar input[type="text"]').on("keyup input", function() {
				var inputVal = $(this).val();
				var resultList = $(this).siblings(".result");
				if(inputVal.length) {
					$.get("search_engine.php", {term: inputVal}).done(function(data) {
						resultList.html(data);
					});
				} else {
					resultList.empty();
				}
			});
			$(document).on("click", ".result p", function(){
				$(this).parents(".search_bar").find('input[type="text"]').val($(this).text());
				$(this).parent(".result").empty();
			});
		});
		</script>
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
						<h2>Search user</h2>
					</div>
				<div class="main_help"></div>
					<div class="content home">
						<div class="search_bar">
							<form method="get" name="form" action="user.php"> 
								<input type="text" autocomplete="off" placeholder="Search user..." name="username">
									<div class="hints">Hints:</div>
								<div class="result">
									<!-- podpowiedzi -->
								</div>
								<input type="submit" value="Search" class="searchsubmit"> 
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