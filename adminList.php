<?php
include "header.php";
echo "<h1>Administrators List</h1>";

session_start();
 
if(!$_SESSION['username']){
require('login.php');

}else{
    $username = $_SESSION['username'];
    $connect = mysql_connect("172.31.37.185", "kristi", "password");
	mysql_select_db("akndb");
    $query = mysql_query("SELECT * FROM users");
	$numrows = mysql_num_rows($query);
     echo"
     <a href='member.php'>Return to administrator panel</a>
        ";
    echo"
        <table width=\"80%\" alignment=\"left\">
            <tr>
                <td width=\"20%\">First Name </td>
                <td width=\"20%\">Last Name</td>
                <td width=\"20%\">Email</td>
                <td width=\"20%\">Registration Date</td>
                <td width=\"20%\">Status</td>
            </tr></table>";
	
    if($numrows != 0){
    
        while($row = mysql_fetch_assoc($query) ){
		$dbuserName = $row['username'];
		$dbFirstName = $row['first_name'];
        $dbLastName = $row['last_name'];
        $dbEmail = $row['email'];
        $dbDate = $row['date'];
		$dbActive = $row['active'];
            
        echo "
        <table width=\"80%\" alignment=\"left\">
                <tr>
                    <td width=\"20%\"> '$dbFirstName'</td>
                    <td width=\"20%\"> '$dbLastName'</td>
                    <td width=\"20%\"> '$dbEmail'</td>
                    <td width=\"20%\"> '$dbDate'</td>
                    <td width=\"20%\"> '$dbActive'</td>
                 </tr></br>
        </table>";
        
        
    }
     // echo "</br><a href ='deleteAdmin.php'>Delete Administrator<a/>"; 
        
    
    
    
    }else{
        echo 'There are no administrators registered on this system.';
    }
}

?>