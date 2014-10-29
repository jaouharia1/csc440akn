<?php
include 'header.php';
session_start();
if($_SESSION['username']){
	echo "Welcome " .$_SESSION['username']."<br>";
	echo "</br><a href ='adminList.php'>View Administrator List<a/>";
	echo "</br><a href = 'addAdmin.php'>Add Administrator</a>";
	echo "</br><a href ='deleteAdmin.php'>Delete Administrator<a/>";
	echo "<br>";
	echo "</br><a href='import-sr.php'>Import SRs<a/>";
	echo "</br><a href='import-vp.php'>Import VPs<a/>";
	
    echo "</br><br><a href ='logout.php'>Logout<a/>";
    
    
}else
	die("You must be logged in!!");
?>