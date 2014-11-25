<?php

session_start();
include 'header.php';
include_once 'functions.php';
$user = new User();
if ($user->get_session())
{
    header("location:home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
    $login = $user->check_login($_POST['emailusername'], $_POST['password']);
    if ($login) 
    {
        // Login Success
        header("location:login.php");
    } 
    else 
    {
        // Login Failed
        $msg= 'Username / password wrong';
    }
}
?>
<table>
<form method="POST" action="" name="login">
    <tr><td>  Email or Username</td>
    <td><input type="text" name="emailusername"/></td>
    </tr>
    <tr><td>
        Password</td>
      <td>
          <input type="password" name="password"/></td></tr>
<input type="submit" value="Login"/>
</form>
</table>
<?php include 'footer.php';?>
