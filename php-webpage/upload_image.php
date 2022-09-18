<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$description = strip_tags($_POST['description']);
$uniqueid = uniqid();
$target_dir = "images/" . $_SESSION['id'] . "/";
$target_file = $target_dir . $uniqueid . "_" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = TRUE;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = TRUE;
    } else {
		$_SESSION['error_msg'] = "File is not an image.";
		$_SESSION['redirect'] = "upload.php";
		header("location: error_handling.php");
		exit();
        $uploadOk = FALSE;
    }
}

if (file_exists($target_file)) {
	$_SESSION['error_msg'] = "Sorry, something went wrong. Please upload your image again.";
	$_SESSION['redirect'] = "upload.php";
	header("location: error_handling.php");
	exit();
    $uploadOk = FALSE;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
	$_SESSION['error_msg'] = "Sorry, your file is too large.";
	$_SESSION['redirect'] = "upload.php";
	header("location: error_handling.php");
	exit();
    $uploadOk = FALSE;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$_SESSION['error_msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$_SESSION['redirect'] = "upload.php";
	header("location: error_handling.php");
	exit();
    $uploadOk = FALSE;
}

if (!$uploadOk) {
	$_SESSION['error_msg'] = "Sorry, your file was not uploaded.";
	$_SESSION['redirect'] = "upload.php";
	header("location: error_handling.php");
	exit();
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		if ($stmt = mysqli_prepare($connection, 'INSERT INTO gallery (path, description, user_id) VALUES (?, ?, ?)')) {
			mysqli_stmt_bind_param($stmt, 'ssi', $target_file, $description, $_SESSION['id']);
			mysqli_stmt_execute($stmt);
		} else {
			$_SESSION['error_msg'] = "Could not prepare statement!";
			$_SESSION['redirect'] = "upload.php";
			header("location: error_handling.php");
			exit();
		}
		mysqli_stmt_close($stmt);
		header('Location: home.php');
		exit();
    } else {
		$_SESSION['error_msg'] = "Sorry, an error occured during uploading your file. Please try again.";
		$_SESSION['redirect'] = "upload.php";
		header("location: error_handling.php");
		exit();
    }
}
?>
