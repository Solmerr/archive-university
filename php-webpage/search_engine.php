<?php
session_start();
require_once('connection.php');
require('checklogin.php');
check();

if(isset($_REQUEST["term"])) {
	
    $sql = "SELECT username FROM users WHERE username LIKE ?";
	
    if($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $term);
        
        $term = $_REQUEST["term"]."%";
        
        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<p>".$row["username"]."</p>";
                }
            } else {
                echo "<p>No matches found</p>";
            }
        } else {
            echo "Error, cannot execute statement!" . mysqli_error($connection);
        }
    } else {
		mysqli_stmt_close($stmt);
	}
} else {
	echo "Request error!";
}
?>