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
<hr>
<h1> Hello <?php $user->get_fullname($uid); ?>!</h1>

<p><u>Administrator Functions</u><br><br></p>

<table width=100%><tr><td width=50% valign='top'>

<a href="registration.php">Add Administrator</a><br>
<a href="getFiles.php">Download Service Request and Vacant Property Files From ODC</a><br>
<a href="import-sr.php?year=2008">Import 2008 SRs From Downloaded File</a><br>
<a href="import-sr.php?year=2009">Import 2009 SRs From Downloaded File</a><br>
<a href="import-sr.php?year=2010">Import 2010 SRs From Downloaded File</a><br>
<a href="import-sr.php?year=2011">Import 2011 SRs From Downloaded File</a><br>
<a href="import-sr.php?year=2012">Import 2012 SRs From Downloaded File</a><br>
<a href="import-sr.php?year=2013">Import 2013 SRs From Downloaded File</a><br>
<a href="import-vp.php">Import Vacant Property Records From Downloaded File</a><br>
</td><td valign='top'>
<?php
$query = "SELECT * FROM users ";
$result = mysqli_query($link, $query);
echo "<table border=1><tr><th>Name</th><th>Username</th><th>E-mail</th><th>&nbsp</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
	echo "<tr><td>".$row['name']."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>";
	echo "<a href='deleteUser.php?uid=".$row['uid']."'>Delete User</a></td></tr>";
}
echo "</table>";

?>

<br><a href="?q=logout">LOGOUT</a>
</td></tr></table>

<?php include 'footer.php'?>
