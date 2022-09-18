<?php
require('admin_img_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Admin gallery</title>
	</head>
	<body>
		<div>
			<h3>Main Page - Image to delete</h3>
			<div class="images">
				<?php foreach ($data as $image): ?>
				<?php if (file_exists($image['path'])): ?>
				<p>Author: <?=$image['username']?></p>
				<p>Description: <?=$image['description']?></p>
				<img src="<?=$image['path']?>" alt="<?="Author: ".$image['username']."<br><br>".$image['description']?>" data-id="<?=$image['image_id']?>" width="600" height="400">
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<button onclick="location.href ='admin_delete_image.php?imgid=<?=$image['image_id']?>';">Delete this image</button>
			<button onclick="location.href ='admin_main_page.php';">Back to main gallery</button>
		</div>
	</body>
</html>