<?php
require('user_gallery.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
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
					<h2>Home Page & Gallery</h2>
					<h3>Welcome back, <?=$_SESSION['name']?>!</h3>
				</div>
			<div class="main_help"></div>
				<div class="content home">
					<a href="upload.php" class="upload-image">Upload New Image</a>
					<div class="images">
						<?php foreach ($data as $image): ?>
						<?php if (file_exists($image['path'])): ?>
						<a href="#">
							<img src="<?=$image['path']?>" alt="<?="Author: ".$image['username']."<br><br>".$image['description'] ?>" data-id="<?=$image['image_id']?>" width="360" height="240">
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
							<div class="buttonsimg">
								<a class="redirectedit" href="edit_img.php?id=${img_meta.dataset.id}" title="Edit description">Edit Description</a>
								<a class="redirectdelete" href="delete_img.php?id=${img_meta.dataset.id}" title="Delete Image">Delete Image</a>
							</div>
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