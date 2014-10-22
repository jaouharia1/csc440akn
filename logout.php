<?php
session_start();
include 'header.php';
session_destroy();
echo "You've been logged out!!";
echo "<a href='index.php'>Back to main page</a>";

?>