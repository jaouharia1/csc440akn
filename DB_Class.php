<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include 'dbCon.php';
class DB_Class
{


    function __construct()
    {
        global $hostname;
        global $username;
        global $password;
        global $database;
        include_once 'dbCon.php';
        $connection = mysql_connect($hostname, $username, $password) or
        die('Oops connection error -> ' . mysql_error());
        mysql_select_db($database, $connection)
        or die('Database error -> ' . mysql_error());
    }
}
?>
