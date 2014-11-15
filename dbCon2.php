<?php
class DB_Class
{

    function __construct()
    {
        /*$hostname = "172.31.17.39";
	   $username = "kristi";
	   $password = "password";
	   $database = "akndb";*/

        global $hostname;
        global $username;
        global $password;
        global $database;
        $connection = mysql_connect($hostname, $username, $password) or
        die('Oops connection error -> ' . mysql_error());
        mysql_select_db($database, $connection)
        or die('Database error -> ' . mysql_error());
    }
}
?>
