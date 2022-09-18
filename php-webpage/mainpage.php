<?php
require('mainpage_gallery.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Main Page</title>
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
						<h2>Main Gallery Page</h2>
					</div>
				<div class="main_help"></div>
					<div class="content home">
						<div class="images">
							<?php foreach ($data as $image): ?>
							<?php if (file_exists($image['path'])): ?>
							<a href="#">
								<img src="<?=$image['path']?>" alt="<?="Author: ".$image['username']."<br><br>".$image['description']?>" width="360" height="240">
							</a>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="image-popup"></div>
			</div>
			<div class="main_help"></div>
			<div class="main_help"></div>
			<footer class="footer">
				<a href="admin_check.php">Definately not admin panel</a>
			</footer>
		</div>
		
		<script>
		let image_popup = document.querySelector('.image-popup');
		document.querySelectorAll('.images a').forEach(img_link => {
			img_link.onclick = e => {
				e.preventDefault();
				let img_meta = img_link.querySelector('img');
				let img = new Image();
				img.onload = () => {
					image_popup.innerHTML = `
						<div class="con">
							<p>${img_meta.alt}</p>
							<img src="${img.src}" width="${img.width}" height="${img.height}">
						</div>
					`;
					image_popup.style.display = 'flex';
				};
				img.src = img_meta.src;
			};
		});
		image_popup.onclick = e => {
			if (e.target.className == 'image-popup') {
				image_popup.style.display = "none";
			}
		};
		</script>
	</body>
</html>