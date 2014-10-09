<?php 

	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
		
	$hostname = "172.31.35.123";
	$username = "kristi";
	$password = "password";
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
?>
