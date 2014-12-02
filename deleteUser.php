<?php
include 'header.php';
include 'functions.php';
    $user = new User();
    
	$uid = preg_replace('/[^0-9]/', '', $_GET['uid']);
    $toDelete = $user->get_fullname($uid);
    $query = "DELETE FROM users WHERE uid=". $uid;
    $result = mysqli_query($link, $query);
    echo $toDelete ." was successfully deleted";
    echo "<meta http-equiv=\"refresh\" content=\"3;url=home.php\" />";
echo "</table>"

?>