<?php
include "header.php";
echo "<h1>Administrators List</h1>";

session_start();
 
if(!$_SESSION['username']){
require('login.php');

}else{
	if($submit){ 
		include "dbCon.php";
		$username=$_POST['username'];
		echo $username;
		$delUserQ = "delete from users Where username='$username'";
		echo $delUserQ;
		mysqli_query($link, $delUserQ);
	}
    $username = $_SESSION['username'];
    $connect = mysql_connect("172.31.37.185", "kristi", "password");
	mysql_select_db("akndb");
    $query = mysql_query("SELECT * FROM users");
	$numrows = mysql_num_rows($query);
     
    if($numrows != 0){
		echo"
			<table>
				<tr>
					<th align=\"left\">User Name </td>
					<th align=\"left\">First Name </td>
					<th align=\"left\">Last Name</td>
					<th align=\"left\">Email</td>
					<th align=\"left\">Registration Date</td>
					<th align=\"left\">Status</td>
			<th ></th>
				</tr>
		";
    
        while($row = mysql_fetch_assoc($query) ){
			$dbuserName = $row['username'];
			$dbFirstName = $row['first_name'];
			$dbLastName = $row['last_name'];
			$dbEmail = $row['email'];
			$dbDate = $row['date'];
			$dbActive = $row['active'];
			echo "
                <tr>
					<td>$dbuserName</td>
                    <td>$dbFirstName</td>
                    <td>$dbLastName</td>
                    <td>$dbEmail</td>
                    <td>$dbDate</td>
                    <td>$dbActive</td>
					<td>
						<form action=\"$_PHP_SELF\" method='POST'>
						<input type='text' name='username' value='$dbuserName'>
						<input type='submit' name='submit' value='Delete Admin'></p>
						</form>
					</td>
                 </tr>
			";
			$username=$_POST['username'];
		}
		echo "</table>";
     }
	else {
        echo 'There are no administrators registered on this system.';
    }

    echo "<a href='member.php'>Return to Administrator Panel</a>";
}

?>