<?php
session_start();
include 'header.php';
include_once 'functions.php';
$user = new User();
$uid = $_SESSION['uid'];
if (!$user->get_session())
{
    header("location:login.php");
}
if (@$_GET['q'] == 'logout') 
{   
    $user->user_logout();
    header("location:login.php");
}

//$user->getUsersTable();
?>

<h1> Hello <?php $user->get_fullname($uid); ?></h1>
<a href="?q=logout">LOGOUT</a></br>
<a href="registration.php">Add administrator</a>

<?php include 'footer.php'?>
