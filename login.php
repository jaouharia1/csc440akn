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
    $user = $_POST['emailusername'];
    $pass = $_POST['password'];
    $login = $user->check_login(preg_replace('/[^A-Za-z0-9 ]/', '', $user), preg_replace('/[^A-Za-z0-9 ]/', '', $pass));
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

<form method="POST" action="" name="login">
    <table>
    <tr><td>  Email or Username</td>
    <td><input type="text" name="emailusername"/></td>
    </tr>
    <tr><td>
        Password</td>
      <td>
          <input type="password" name="password"/></td></tr>
    </table>
<input type="submit" value="Login"/>
</form>

<?php include 'footer.php';?>
