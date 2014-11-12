<?php 
	/*$hostname = "172.31.17.39";
	$username = "kristi";
	$password = "password";
	$database = "akndb";
	
    
    define('hostname', 'localhost');
    define('username', 'root');
    define('password', '');
    define('database', 'akndb');*/

    $hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "akndb";
	
	$link = mysqli_init();
	if (!$link) {
		die('mysqli_init failed');
	}

	if (!mysqli_options($link, MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
		die('Setting MYSQLI_INIT_COMMAND failed');
	}

	if (!mysqli_options($link, MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
		die('Setting MYSQLI_OPT_CONNECT_TIMEOUT failed');
	}

	if (!mysqli_real_connect($link, $hostname, $username, $password, $database)) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	$con=mysqli_real_connect($link, $hostname, $username, $password, $database);

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
