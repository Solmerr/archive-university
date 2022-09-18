<?php
require('admin_main_page_id.php');
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Admin gallery</title>
	</head>
	<body>
		<div>
			<button onclick="window.location.href = 'admin_panel.php';">Back to panel</button><br><br>
		</div>
		<div>
			<h3>Main Gallery Page</h3>
			<div class="images">
				<?php foreach ($data as $image): ?>
				<?php if (file_exists($image['path'])): ?>
				<a href="admin_img.php?imgid=<?=$image['image_id']?>">
					<img src="<?=$image['path']?>" alt="<?="Author: ".$image['username']."<br><br>".$image['description']?>" data-id="<?=$image['image_id']?>" width="300" height="200">
				</a>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</body>
</html>