<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	function __autoload($class) {
		include "$class.php";
    }

    function initialise_site(csite $site) {
    }
?> 