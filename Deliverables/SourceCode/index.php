<?php
	//ini_set('display_errors',1);
	//ini_set('display_startup_errors',1);
	//error_reporting(-1);
	
	include 'stdlib.php';
    $site = new csite();

    // this is a function specific to this site!
    initialise_site($site);
	$pgNum = $_GET['pgNum'];
    $page = new cpage($pgNum);
    $site->setPage($page);
    $site->render();
?> 
