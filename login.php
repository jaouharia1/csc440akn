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

<form method="POST" action="" name="login">
    Email or Username
<input type="text" name="emailusername"/></br>
    Password
<input type="password" name="password"/></br>
<input type="submit" value="Login"/>
</form>
<?php include 'footer.php';?>