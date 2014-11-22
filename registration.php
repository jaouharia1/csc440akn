<?php
include 'header.php';
include_once 'functions.php';
$user = new User();
// Checking for user logged in or not
if ($user->get_session())
{
    header("location:home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $register = $user->register_user($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email']);
    if ($register) 
    {
    // Registration Success
        echo 'Registration successful ';
        echo "<meta http-equiv=\"refresh\" content=\"3;url=home.php\" />";
    }
    else 
    {
        // Registration Failed
        echo 'Registration failed. Email or Username already exits please try again';
    }
}
?>

<form method="POST" action="registration.php" name='reg' >
    Full Name
    <input type="text" name="name"/></br>
        Username
    <input type="text" name="username"/></br>
        Password
    <input type="password" name="password"/></br>
        Email
    <input type="text" name="email"/></br>
    <input type="submit" value="Register"/>
</form>
<?php 

include 'footer.php'


?>

















