<?php
include 'header.php';
include 'functions.php';
    $user = new User();
    
    $toDelete = $user->get_fullname($_GET['uid']);
    $query = "DELETE FROM users WHERE uid=". $_GET['uid'];
    $result = mysqli_query($link, $query);
    echo $toDelete ." was successfully deleted";
    echo "<meta http-equiv=\"refresh\" content=\"3;url=home.php\" />";
echo "</table>"

?>