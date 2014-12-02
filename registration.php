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
    $register = $user->register_user(mysql_real_escape_string($_POST['name']), mysql_real_escape_string($_POST['username']), mysql_real_escape_string($_POST['password']), mysql_real_escape_string($_POST['email']));
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
<table>
<form method="POST" action="registration.php" name='reg' >
    <tr>
        <td>Full Name</td>>
        <td><input type="text" name="name"/></td>>
    </tr>
    <tr>
        <td>Username</td>
        <td><input type="text" name="username"/></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password"/></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email"/></td>
    </tr>
    <tr>
        <td><input type="submit" value="Register"/></td>
    </tr>
</form>
</table>

<?php 
include 'footer.php';
?>

















