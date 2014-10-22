<?php
include 'header.php';
session_start();
if($_SESSION['username']){
	echo "welcome " .$_SESSION['username'];
	echo "</br><a href ='adminList.php'>View Administrator List<a/>";
	echo "</br><a href = 'addAdmin.php'>Add Administrator</a>";
	echo "</br><a href ='logout.php'>logout<a/>";
}else
	die("You must be logged in!!");
?>