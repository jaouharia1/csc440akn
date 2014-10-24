<?php
include 'header.php';
echo"<h1>Registration Panel</h1>";
$submit  = empty($_POST['submit'])  ? null : $_POST['submit'];
$username = strtolower(strip_tags(@$_POST['username']));
$firstname = strtolower(strip_tags(@$_POST['firstname']));
$lastname = strtolower(strip_tags(@$_POST['lastname']));
$email = strtolower(strip_tags(@$_POST['email']));
$password = strip_tags(@$_POST['password']);
$repeatpassword = strip_tags(@$_POST['repeatpassword']);
//$date = date("Y-m-d");
if($submit){ 
	$connect = mysql_connect("localhost", "root", "") ;
	mysql_select_db("akndb");
	$namecheck = mysql_query("SELECT username FROM users Where username='.$username.'");
	$count = mysql_num_rows($namecheck);
	
	if($count!=0){
		die("Username already exists, please choose another username");
	}
	if($username && $firstname && $lastname && $email && $password &&$repeatpassword){
		
		if($password == $repeatpassword){
			if(strlen($username)>25){
				echo"Your username length should be less than 25 characters long";
			}elseif(strlen($firstname)>25){
				echo"Your first name length should be less than 25 characters long";
			}elseif(strlen($lastname)>25){
				echo"Your last name length should be less than 25 characters long";
			}else{
				if(strlen($password)<6 || strlen($password)>25 ){
					echo"Your password must be between 6 and 25 characters!!";
				}else{
						
						$password = md5($password);
						$repeatpassword = md5($repeatpassword);
						
						$queryreg = mysql_query("INSERT INTO users VALUES('','$username','$password','$firstname','$lastname','$email','','NOW()')");
						echo "Aministrator added successfully!!";
						}
			}
		}else{
			echo"Your Passwords don't match!!";
		}
	}else
		echo "Please enter all fields!!" ;	
}
?>

<html>
	<br>
	<form action='addAdmin.php' method='POST'>
		<table>
			<tr>
			<td>
			Username :
			</td>
			<td>
			<input type='text' name='username' value='<?php echo $username;?>'>
			</td>
			</tr>
			<tr>
			<td>
			First Name :
			</td>
			<td>
			<input type='text' name='firstname' value='<?php echo $firstname;?>'>
			</td>
			</tr>
			<tr>
			<td>
			Last Name :
			</td>
			<td>
			<input type='text' name='lastname' value='<?php echo $lastname;?>'>
			</td>
			</tr>
			<tr>
			<td>
			Password :
			</td>
			<td>
			<input type='password' name='password'>
			</td>
			</tr>
			<tr>
			<td>
			Retype Password :
			</td>
			<td>
			<input type='password' name='repeatpassword'>
			</td>
			</tr>
			<tr>
			<td>
			email :
			</td>
			<td>
			<input type='text' name='email' value='<?php echo $email?>'>
			</td>
			</tr>
		</table>
		<p><input type='submit' name='submit' value='Add Administrator'></p>
	</form>
	<a href='member.php'>Return to administrator panel</a>
</html>
