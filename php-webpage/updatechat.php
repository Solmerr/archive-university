<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

$result = mysqli_query($connection, 'SELECT messages.message_id AS messageid, messages.content AS content, messages.date_send AS date, users.username AS username, users.id AS userid FROM messages INNER JOIN users ON messages.user_id = users.id');
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<p>";
		echo $row['date']."<br>";
		echo "  <a href='user.php?username=".$row['username']."'>".$row['username']."</a>: ".$row['content']."<br>";
		if (($_SESSION['id'] == $row['userid']) or ($_SESSION['isadmin'] == 1)) {
			echo "<a href='delete_message.php?messageid=".$row['messageid']."'>delete</a>";
		}
		echo "<p>";
	}
} else {
	echo "There are no comments!";
}
?>