<?php
echo "<h1>Delete Administrator</h1>";

session_start();
 
if(!$_SESSION['username']){
require('login.php');

}else{

include "adminList.php";
    

}


?>