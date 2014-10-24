<?php
include 'header.php';
session_start();

$submit  = empty($_POST['submit'])  ? null : $_POST['submit'];
$username = strtolower(strip_tags(@$_POST['username']));
$password = strtolower(strip_tags(@$_POST['password']));

 if ($username && $password){

	$connect = mysql_connect("localhost", "root", "") or die("Couldn't connect!!");
	mysql_select_db("akndb") or die("Couldn't find Database!");

	$query = mysql_query("SELECT * FROM users WHERE username = '$username'");
	$numrows = mysql_num_rows($query);
	if($numrows != 0){
	while($row = mysql_fetch_assoc($query) ){
		$dbusername = $row['username'];
		$dbpassword = $row['password'];
		
	}
	if($username==$dbusername && md5($password)==$dbpassword){
		
		$_SESSION['username']=$dbusername;
		header('Location: member.php'); 
	}else 
		echo "Incorrect Credentials!";

	}else die("That user doesn't exist!");


}else{
	die("Please enter your credentials");}


?>