<?php

class DB_Class
{

    function __construct()
    {
        include_once 'dbCon.php';
        $connection = mysql_connect($hostname, $username, $password) or
        die('Oops connection error -> ' . mysql_error());
        mysql_select_db($database, $connection)
        or die('Database error -> ' . mysql_error());
    }
}
?>
